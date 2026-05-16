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
    Schema::create('produk_bahan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
        $table->foreignId('bahan_baku_id')->constrained('bahan_baku')->cascadeOnDelete();
        $table->decimal('jumlah_digunakan', 10, 2); // Contoh: 1.00
        // Tipe: 'per_meter' (untuk banner) atau 'per_pcs' (untuk kartu nama/stiker)
        $table->enum('tipe_pengurangan', ['per_meter', 'per_pcs'])->default('per_meter'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_bahan');
    }
};
