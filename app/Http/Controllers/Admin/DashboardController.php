<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\BahanBaku;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $stats = [];

        // 1. Data Universal (Semua petugas butuh tahu antrean)
        $stats['pesanan_baru'] = Pesanan::where('status', 'Verifikasi')->count();
        $stats['pesanan_proses'] = Pesanan::whereIn('status', ['Antrean Cetak', 'Produksi'])->count();

        // 2. Data Khusus Admin Kantor & Super Admin
        if (in_array($role, ['super_admin', 'admin_kantor'])) {
            $stats['omzet_bulan_ini'] = Pesanan::where('status', 'Selesai')
                ->whereMonth('created_at', date('m'))
                ->sum('total_bayar');
            $stats['stok_kritis'] = BahanBaku::whereColumn('stok', '<=', 'minimum_stok')->count();
        }

        // 3. Data Khusus Kasir & Super Admin
        if (in_array($role, ['super_admin', 'kasir'])) {
            $stats['transaksi_hari_ini'] = Pesanan::whereDate('created_at', date('Y-m-d'))->count();
        }

        // 4. Data Eksklusif Super Admin
        if ($role === 'super_admin') {
            $stats['total_pelanggan'] = User::where('role', 'pelanggan')->count();
            $stats['total_karyawan'] = User::whereIn('role', ['admin_kantor', 'kasir'])->count();
        }

        return view('admin.dashboard', compact('stats', 'role'));
    }
}