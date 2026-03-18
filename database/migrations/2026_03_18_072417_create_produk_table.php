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
    Schema::create('produk', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bahan_baku_id')->constrained('bahan_baku')->onDelete('cascade');
        $table->string('nama_produk');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga_dasar', 15, 2); // Harga per m2 atau per pcs
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
