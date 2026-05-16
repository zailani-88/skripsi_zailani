<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan_baku', function (Blueprint $table) {
            // Tambahan fitur Gudang & Barcode
            $table->string('kode_barcode')->nullable()->after('nama_bahan');
            $table->integer('minimum_stok')->default(10)->after('stok');
            $table->string('supplier')->nullable()->after('minimum_stok');
        });
    }

    public function down(): void
    {
        Schema::table('bahan_baku', function (Blueprint $table) {
            $table->dropColumn(['kode_barcode', 'minimum_stok', 'supplier']);
        });
    }
};