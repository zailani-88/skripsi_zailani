<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function isStaff(): bool
    {
        return in_array(auth()->user()->role, ['super_admin', 'admin_kantor', 'kasir']);
    }

    private function buildStats(): array
    {
        if ($this->isStaff()) {
            $pesananAktif = Pesanan::whereNotIn('status', ['Selesai', 'Dibatalkan'])->count();
            $totalSelesai = Pesanan::where('status', 'Selesai')->count();
            $pesananBaru = Pesanan::where('status', 'Verifikasi')->count();
            $pesananTerbaru = Pesanan::with(['user', 'detailPesanan.produk'])
                ->latest()
                ->take(3)
                ->get();
        } else {
            $pesananAktif = Pesanan::where('user_id', auth()->id())
                ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
                ->count();
            $totalSelesai = Pesanan::where('user_id', auth()->id())
                ->where('status', 'Selesai')
                ->count();
            $pesananBaru = 0;
            $pesananTerbaru = Pesanan::with('detailPesanan.produk')
                ->where('user_id', auth()->id())
                ->latest()
                ->take(3)
                ->get();
        }

        return compact('pesananAktif', 'totalSelesai', 'pesananBaru', 'pesananTerbaru');
    }

    private function buildSalesChart(): array
    {
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $labels = [];
        $omzet = [];
        $transaksi = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $bulanLabels[$date->month - 1] . ' ' . $date->year;
            $omzet[] = (int) Pesanan::where('status', 'Selesai')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_bayar');
            $transaksi[] = Pesanan::where('status', 'Selesai')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return compact('labels', 'omzet', 'transaksi');
    }

    public function index()
    {
        $data = $this->buildStats();
        $data['isStaff'] = $this->isStaff();

        if ($data['isStaff']) {
            $data = array_merge($data, $this->buildSalesChart());
        }

        return view('dashboard', $data);
    }

    public function stats(Request $request): JsonResponse
    {
        if (!$this->isStaff()) {
            abort(403);
        }

        $stats = $this->buildStats();

        return response()->json([
            'pesanan_aktif' => $stats['pesananAktif'],
            'pesanan_selesai' => $stats['totalSelesai'],
            'pesanan_baru' => $stats['pesananBaru'],
        ]);
    }
}
