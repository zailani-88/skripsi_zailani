<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'panjang',
        'lebar',
        'jumlah',
        'finishing',
        'file_desain',
        'subtotal',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}