<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model {
    protected $table = 'bahan_baku';
protected $fillable = ['nama_bahan', 'kode_barcode', 'stok', 'minimum_stok', 'satuan', 'supplier'];

// Tambahkan relasi ke histori stok
public function riwayatStok()
{
    return $this->hasMany(RiwayatStok::class);
}
}
