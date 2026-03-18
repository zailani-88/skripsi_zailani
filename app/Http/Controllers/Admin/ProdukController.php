<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index() {
        $produk = Produk::with('bahanBaku')->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create() {
        $bahan = BahanBaku::all();
        return view('admin.produk.create', compact('bahan'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'bahan_baku_id' => 'required',
            'harga_dasar' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambah');
    }

    public function edit(Produk $produk) {
        $bahan = BahanBaku::all();
        return view('admin.produk.edit', compact('produk', 'bahan'));
    }

    public function update(Request $request, Produk $produk) {
        $data = $request->all();
        if ($request->hasFile('gambar')) {
            if ($produk->gambar) Storage::disk('public')->delete($produk->gambar);
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }
        $produk->update($data);
        return redirect()->route('admin.produk.index');
    }

    public function destroy(Produk $produk) {
        if ($produk->gambar) Storage::disk('public')->delete($produk->gambar);
        $produk->delete();
        return back();
    }
}