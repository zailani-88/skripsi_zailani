<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik untuk Dashboard
        $pesananBaru = Pesanan::where('status', 'Verifikasi')->count();
        $pesananDiproses = Pesanan::whereIn('status', ['Antrean Cetak', 'Produksi'])->count();
        
        // Pendapatan bulan ini dari pesanan yang sudah selesai
        $pendapatanBulanIni = Pesanan::where('status', 'Selesai')
                                     ->whereMonth('created_at', date('m'))
                                     ->whereYear('created_at', date('Y'))
                                     ->sum('total_bayar');

        // Peringatan jika ada stok bahan baku yang di bawah 50
        $stokMenipis = BahanBaku::where('stok', '<', 50)->get();

        // Mengambil 5 pesanan terbaru untuk tabel mini
        $pesananTerbaru = Pesanan::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'pesananBaru', 
            'pesananDiproses', 
            'pendapatanBulanIni', 
            'stokMenipis',
            'pesananTerbaru'
        ));
    }
}