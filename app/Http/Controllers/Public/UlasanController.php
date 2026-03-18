<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request, $pesananId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        $pesanan = Pesanan::where('id', $pesananId)->where('user_id', Auth::id())->firstOrFail();

        Ulasan::create([
            'pesanan_id' => $pesanan->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan bintang ' . $request->rating . ' Anda!');
    }
}