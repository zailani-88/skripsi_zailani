<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model {
    protected $table = 'produk';
    protected $fillable = ['bahan_baku_id', 'nama_produk', 'deskripsi', 'harga_dasar', 'gambar'];

    // Produk terikat ke satu jenis bahan baku utama
   public function bahanBaku()
{
    return $this->belongsToMany(BahanBaku::class, 'produk_bahan')
                ->withPivot('jumlah_digunakan', 'tipe_pengurangan');
}
}
