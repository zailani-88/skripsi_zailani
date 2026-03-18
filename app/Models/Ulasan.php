<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $fillable = ['pesanan_id', 'user_id', 'rating', 'komentar'];

    // Relasi: Ulasan ini merujuk ke satu pesanan tertentu
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    // Relasi: Ulasan ini ditulis oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}