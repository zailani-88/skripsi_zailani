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
    Schema::create('detail_keranjangs', function (Blueprint $table) {
 $table->id();
    $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('cascade');
    $table->foreignId('produk_id')->constrained('produk');
    $table->double('panjang');
    $table->double('lebar');
    $table->integer('jumlah');
    $table->double('subtotal');
    $table->string('file_desain')->nullable(); // Tambahkan nullable() biar gak wajib upload pas testing
    $table->text('catatan')->nullable();
    $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_keranjang');
    }
};
