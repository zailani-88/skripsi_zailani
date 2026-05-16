<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        // Ambil data produk beserta formula bahannya
        $produk = Produk::with('bahanBaku')->latest()->get();
        // Ambil semua daftar bahan baku untuk ditampilkan di form setting
        $semuaBahan = BahanBaku::all(); 
        
        return view('admin.produk.index', compact('produk', 'semuaBahan'));
    }

    // ... (fungsi store, update, destroy biarkan seperti yang sudah ada) ...

    // FUNGSI BARU: MENYIMPAN FORMULA BAHAN
    public function updateFormula(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        
        $syncData = [];
        
        // Jika ada bahan yang diceklis
        if($request->has('is_used')) {
            foreach($request->is_used as $bahanId => $value) {
                $syncData[$bahanId] = [
                    'jumlah_digunakan' => $request->jumlah_digunakan[$bahanId] ?? 1,
                    'tipe_pengurangan' => $request->tipe_pengurangan[$bahanId] ?? 'per_meter'
                ];
            }
        }
        
        // Simpan ke tabel pivot (produk_bahan) secara otomatis
        $produk->bahanBaku()->sync($syncData);
        
        return back()->with('success', 'Formula Bahan Baku untuk produk ini berhasil diatur!');
    }
}