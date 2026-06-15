<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("UPDATE pesanan SET status = 'Siap Ambil' WHERE status = 'Siap Ambil / Dikirim'");

        DB::statement("ALTER TABLE pesanan MODIFY COLUMN status ENUM('Menunggu Pembayaran', 'Verifikasi', 'Antrean Cetak', 'Produksi', 'Siap Ambil', 'Sedang Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Pembayaran'");
    }

    public function down(): void
    {
        DB::statement("UPDATE pesanan SET status = 'Siap Ambil / Dikirim' WHERE status IN ('Siap Ambil', 'Sedang Dikirim')");

        DB::statement("ALTER TABLE pesanan MODIFY COLUMN status ENUM('Menunggu Pembayaran', 'Verifikasi', 'Antrean Cetak', 'Produksi', 'Siap Ambil / Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Pembayaran'");
    }
};
