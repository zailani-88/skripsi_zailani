<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('user')
                ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
                ->latest()
                ->get();
    return view('admin.pesanan.index', compact('pesanan'));
    }


public function selesai()
{
    // Khusus arsip yang sudah beres
    $pesanan = Pesanan::with('user')
                ->whereIn('status', ['Selesai', 'Dibatalkan'])
                ->latest()
                ->get();
    return view('admin.pesanan.selesai', compact('pesanan'));
}
    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan.produk'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

  public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $pesanan = Pesanan::with('detailPesanan.produk.bahanBaku')->findOrFail($id);
        
        // LOGIKA PENGURANGAN STOK OTOMATIS
        // Jika status diubah menjadi 'Produksi' dan sebelumnya bukan 'Produksi'
        if ($request->status == 'Produksi' && $pesanan->status != 'Produksi') {
            foreach ($pesanan->detailPesanan as $detail) {
                $bahanBaku = $detail->produk->bahanBaku;
                
                if ($bahanBaku) {
                    // Jika satuan meter persegi (m2), kurangi berdasarkan luas
                    if (strtolower($bahanBaku->satuan) == 'm2') {
                        $pengurangan = $detail->panjang * $detail->lebar * $detail->jumlah;
                    } else {
                        // Jika satuan lembar/pcs, kurangi berdasarkan jumlah saja
                        $pengurangan = $detail->jumlah;
                    }
                    
                    // Kurangi stok di database
                    $bahanBaku->decrement('stok', $pengurangan);
                }
            }
        }

        $pesanan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui menjadi: ' . $request->status);
    }

    public function cetakLabel($id)
{
    $pesanan = Pesanan::with('user')->findOrFail($id);
    // Generate resi otomatis jika belum ada (Bisa pakai Invoice ID)
    $resi = 'REG-' . strtoupper(substr($pesanan->nomor_invoice, -5));

    $pdf = Pdf::loadView('admin.pesanan.pdf_label', compact('pesanan', 'resi'))
              ->setPaper([0, 0, 283, 420], 'portrait'); // Ukuran A6 (stiker)
              
    return $pdf->stream('Label-' . $pesanan->nomor_invoice . '.pdf');
}

public function cetakSPK($id)
{
    $pesanan = Pesanan::with(['user', 'detailPesanan.produk'])->findOrFail($id);
    
    $pdf = Pdf::loadView('admin.pesanan.pdf_spk', compact('pesanan'))
              ->setPaper('a4', 'portrait');
              
    return $pdf->stream('SPK-' . $pesanan->nomor_invoice . '.pdf');
}
    public function laporanPenjualan()
{
    // Mengambil semua pesanan sukses di bulan ini
    $pesanan = Pesanan::with('user')
                ->where('status', 'Selesai')
                ->whereMonth('created_at', date('m'))
                ->latest()
                ->get();

    $totalOmzet = $pesanan->sum('total_bayar');

    $pdf = Pdf::loadView('admin.laporan.penjualan_pdf', compact('pesanan', 'totalOmzet'))
              ->setPaper('a4', 'landscape'); // Landscape agar kolom muat banyak
              
    return $pdf->stream('Laporan-Penjualan-'.date('M-Y').'.pdf');
}

public function laporanBahan()
{
    // Pastikan nama tabel sesuai (pesanan, produk, bahan_baku, detail_pesanan)
    $rekapBahan = \DB::table('detail_pesanan')
        ->join('pesanan', 'detail_pesanan.pesanan_id', '=', 'pesanan.id')
        ->join('produk', 'detail_pesanan.produk_id', '=', 'produk.id')
        ->join('bahan_baku', 'produk.bahan_baku_id', '=', 'bahan_baku.id')
        ->where('pesanan.status', 'Selesai')
        ->selectRaw('bahan_baku.nama_bahan, SUM(detail_pesanan.panjang * detail_pesanan.lebar * detail_pesanan.jumlah) as total_luas')
        ->groupBy('bahan_baku.nama_bahan')
        ->get();

    $pdf = Pdf::loadView('admin.laporan.bahan_pdf', compact('rekapBahan'))
              ->setPaper('a4', 'portrait');
              
    return $pdf->stream('Laporan-Pemakaian-Bahan.pdf');
}
// 6. Laporan Produk Terlaris
public function laporanTerlaris()
{
    $produkTerlaris = \DB::table('detail_pesanan')
        ->join('pesanan', 'detail_pesanan.pesanan_id', '=', 'pesanan.id')
        ->join('produk', 'detail_pesanan.produk_id', '=', 'produk.id')
        ->where('pesanan.status', 'Selesai')
        ->selectRaw('produk.nama_produk, SUM(detail_pesanan.jumlah) as total_qty')
        ->groupBy('produk.nama_produk')
        ->orderBy('total_qty', 'DESC')
        ->get();

    $pdf = Pdf::loadView('admin.laporan.terlaris_pdf', compact('produkTerlaris'));
    return $pdf->stream('Laporan-Produk-Terlaris.pdf');
}

// 7. Laporan Top Spenders (Demografi Pelanggan)
public function laporanTopPelanggan()
{
    // Tambahkan where role != admin agar data bersih
    $topUsers = \App\Models\User::where('role', '!=', 'admin')
        ->withCount(['pesanan' => function($q) {
            $q->where('status', 'Selesai');
        }])
        ->withSum(['pesanan' => function($q) {
            $q->where('status', 'Selesai');
        }], 'total_bayar')
        ->having('pesanan_count', '>', 0) // Hanya tampilkan yang pernah belanja
        ->orderBy('pesanan_sum_total_bayar', 'DESC')
        ->take(10)
        ->get();

    $pdf = Pdf::loadView('admin.laporan.top_pelanggan_pdf', compact('topUsers'));
    return $pdf->stream('Laporan-Top-Pelanggan.pdf');
}

// 8. Laporan Log Pembatalan
public function laporanPembatalan()
{
    $pembatalan = \App\Models\Pesanan::with('user')
        ->where('status', 'Dibatalkan')
        ->latest()
        ->get();

    $pdf = Pdf::loadView('admin.laporan.pembatalan_pdf', compact('pembatalan'));
    return $pdf->stream('Laporan-Pembatalan.pdf');
}
public function laporanStok()
    {
        $bahan = \App\Models\BahanBaku::all();
        $pdf = Pdf::loadView('admin.laporan.stok_pdf', compact('bahan'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan-Stok-Orbit.pdf');
    }

    // 7. Laporan Log Retur & Pembatalan
    public function laporanRetur()
    {
        // Mengambil pesanan yang dibatalkan untuk audit retur
        $retur = Pesanan::with('user')
                ->where('status', 'Dibatalkan')
                ->latest()
                ->get();
                
        $pdf = Pdf::loadView('admin.laporan.retur_pdf', compact('retur'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan-Retur-Orbit.pdf');
    }
}