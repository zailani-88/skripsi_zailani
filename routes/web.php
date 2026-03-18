<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\BahanBakuController;
use App\Http\Controllers\Public\KatalogController; // Import ini
use App\Http\Controllers\Public\PesananController; // Import ini
use Illuminate\Support\Facades\Route;
use App\Models\Produk;

// 1. Rute Halaman Publik (Landing Page)
Route::get('/', function () {
    $produk = Produk::with('bahanBaku')->take(4)->get();
    return view('welcome', compact('produk'));
});

// 2. Rute Katalog Khusus
Route::get('/katalog-layanan', [KatalogController::class, 'index'])->name('katalog.index');

// 3. Rute Khusus User / Pengguna Biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 4. Rute Transaksi (Wajib Login)
Route::middleware('auth')->group(function () {
    Route::get('/pesan/{produk}', [PesananController::class, 'show'])->name('pesan.show');
    Route::post('/pesan/{produk}/keranjang', [PesananController::class, 'addToCart'])->name('pesan.cart');
    Route::get('/keranjang', [PesananController::class, 'cartIndex'])->name('keranjang.index');
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('pesan.checkout');
    Route::post('/checkout/proses', [PesananController::class, 'storeCheckout'])->name('pesan.storeCheckout');
    Route::get('/riwayat-pesanan', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/riwayat-pesanan/{id}', [App\Http\Controllers\Public\PesananController::class, 'showRiwayat'])->name('pesanan.detail');
    Route::get('/riwayat-pesanan/{id}/cetak', [App\Http\Controllers\Public\PesananController::class, 'cetakInvoice'])->name('pesanan.cetak');
      Route::post('/pesanan/{id}/ulasan', [App\Http\Controllers\Public\UlasanController::class, 'store'])->name('ulasan.store');
});

// 5. Rute Khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::resource('bahan', BahanBakuController::class);
    Route::get('/pesanan', [App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [App\Http\Controllers\Admin\PesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{id}/status', [App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::get('/pesanan-selesai', [App\Http\Controllers\Admin\PesananController::class, 'selesai'])->name('pesanan.selesai');
    Route::get('/pesanan/{id}/cetak-label', [App\Http\Controllers\Admin\PesananController::class, 'cetakLabel'])->name('pesanan.cetakLabel');
Route::get('/pesanan/{id}/cetak-spk', [App\Http\Controllers\Admin\PesananController::class, 'cetakSPK'])->name('pesanan.cetakSPK');
Route::get('/laporan/penjualan', [App\Http\Controllers\Admin\PesananController::class, 'laporanPenjualan'])->name('laporan.penjualan');
Route::get('/laporan/bahan', [App\Http\Controllers\Admin\PesananController::class, 'laporanBahan'])->name('laporan.bahan');
Route::get('/laporan/terlaris', [App\Http\Controllers\Admin\PesananController::class, 'laporanTerlaris'])->name('laporan.terlaris');
Route::get('/laporan/top-pelanggan', [App\Http\Controllers\Admin\PesananController::class, 'laporanTopPelanggan'])->name('laporan.topPelanggan');
Route::get('/laporan/pembatalan', [App\Http\Controllers\Admin\PesananController::class, 'laporanPembatalan'])->name('laporan.pembatalan');
Route::get('/laporan/stok', [App\Http\Controllers\Admin\PesananController::class, 'laporanStok'])->name('laporan.stok');
Route::get('/laporan/retur', [App\Http\Controllers\Admin\PesananController::class, 'laporanRetur'])->name('laporan.retur');
});

// 6. Rute Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';