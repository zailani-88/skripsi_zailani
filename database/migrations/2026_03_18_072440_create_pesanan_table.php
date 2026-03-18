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
    Schema::create('pesanan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('voucher_id')->nullable()->constrained('voucher')->onDelete('set null');
        $table->string('nomor_invoice')->unique(); // Contoh: INV-20260318-001
        $table->decimal('total_harga', 15, 2);
        $table->decimal('potongan_diskon', 15, 2)->default(0);
        $table->decimal('total_bayar', 15, 2);
        $table->string('metode_pengiriman');
        $table->string('bukti_bayar')->nullable();
        $table->enum('status', [
            'Menunggu Pembayaran', 
            'Verifikasi', 
            'Antrean Cetak', 
            'Produksi', 
            'Siap Ambil / Dikirim', 
            'Selesai', 
            'Dibatalkan'
        ])->default('Menunggu Pembayaran');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
