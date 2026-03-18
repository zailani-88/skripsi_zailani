<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    use HasFactory;

    protected $table = 'detail_keranjangs';

    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'panjang',
        'lebar',
        'jumlah',
        'subtotal',
        'file_desain',
        'catatan',
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }

    // NAMA FUNGSI INI HARUS PERSIS: produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}