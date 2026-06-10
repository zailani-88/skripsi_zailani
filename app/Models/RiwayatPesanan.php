<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPesanan extends Model
{
    protected $table = 'riwayat_pesanan';

    protected $fillable = [
        'pesanan_id',
        'status_log',
        'catatan',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
