<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model {
    protected $table = 'bahan_baku';
    protected $fillable = ['nama_bahan', 'stok', 'satuan'];

    // Satu bahan baku bisa digunakan oleh banyak produk
    public function produk() {
        return $this->hasMany(Produk::class);
    }
}
