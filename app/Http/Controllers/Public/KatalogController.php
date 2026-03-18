<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class KatalogController extends Controller
{
    public function index()
    {
        $produk = Produk::with('bahanBaku')->latest()->get();
        return view('katalog.index', compact('produk'));
    }
}