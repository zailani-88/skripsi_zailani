<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahan = BahanBaku::all();
        return view('admin.bahan.index', compact('bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'stok' => 'required|numeric',
            'satuan' => 'required'
        ]);

        BahanBaku::create($request->all());
        return back()->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function update(Request $request, BahanBaku $bahanBaku)
    {
        $bahanBaku->update($request->all());
        return back()->with('success', 'Stok bahan berhasil diperbarui.');
    }

    public function destroy(BahanBaku $bahanBaku)
    {
        $bahanBaku->delete();
        return back()->with('success', 'Bahan baku berhasil dihapus.');
    }
}