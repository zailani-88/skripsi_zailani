<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs'; 

    protected $fillable = [
        'user_id',
        'status',
    ];

    // NAMA FUNGSI INI HARUS PERSIS: detailKeranjang (d huruf kecil, K huruf besar)
    public function detailKeranjang()
    {
        return $this->hasMany(DetailKeranjang::class, 'keranjang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}