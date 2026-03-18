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
    Schema::create('detail_pesanan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
        $table->foreignId('produk_id')->constrained('produk');
        $table->decimal('panjang', 8, 2); // dalam meter
        $table->decimal('lebar', 8, 2);   // dalam meter
        $table->integer('jumlah');        // kuantitas cetak
        $table->string('finishing')->nullable(); // misal: Mata ayam, Laminasi
        $table->string('file_desain');    // path ke file yang diupload user
        $table->decimal('subtotal', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
