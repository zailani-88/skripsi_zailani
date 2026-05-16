<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BahanBaku;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  public function run(): void
{
    // 1. Buat Super Admin (Akses Penuh)
    \App\Models\User::create([
        'name' => 'Zailani Super Admin',
        'email' => 'superadmin@orbit.com',
        'password' => Hash::make('password'),
        'role' => 'super_admin',
        'telepon' => '08110000001',
        'alamat' => 'Kantor Pusat Orbit Print',
    ]);

    // 2. Buat Admin Kantor (Manajemen Stok & Laporan)
    \App\Models\User::create([
        'name' => 'Zailani Admin Kantor',
        'email' => 'admin@orbit.com',
        'password' => Hash::make('password'),
        'role' => 'admin_kantor',
        'telepon' => '08110000002',
        'alamat' => 'Orbit Print Banjarmasin',
    ]);

    // 3. Buat Kasir (Proses Pembayaran & Antrean)
    \App\Models\User::create([
        'name' => 'Kasir Orbit',
        'email' => 'kasir@orbit.com',
        'password' => Hash::make('password'),
        'role' => 'kasir',
        'telepon' => '08110000003',
        'alamat' => 'Area Kasir Orbit',
    ]);

    // 4. Buat Contoh Pelanggan
    \App\Models\User::create([
        'name' => 'Budi Pelanggan',
        'email' => 'budi@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'pelanggan',
        'telepon' => '08110000004',
        'alamat' => 'Jl. Sultan Adam Banjarmasin',
    ]);

        // 2. Data Bahan Baku (Pondasi untuk Harga Dinamis)
        $bahanFlexi = BahanBaku::create(['nama_bahan' => 'Flexi Standar', 'stok' => 500, 'satuan' => 'm2']);
        $bahanKertas = BahanBaku::create(['nama_bahan' => 'Art Paper / Chrome', 'stok' => 1000, 'satuan' => 'lembar']);
        $bahanSticker = BahanBaku::create(['nama_bahan' => 'Vinyl/Sticker', 'stok' => 200, 'satuan' => 'm2']);
        $bahanLain = BahanBaku::create(['nama_bahan' => 'Material Custom', 'stok' => 100, 'satuan' => 'pcs']);

        // 3. Data Produk (Migrasi dari pkl_zailani.sql)
        $dataProduk = [
            ['nama' => 'Cetak Banner/Cetak Spanduk/Cetak Baliho', 'harga' => 60000, 'bahan' => $bahanFlexi->id],
            ['nama' => 'Umbul Umbul Custom/Bendera Custom', 'harga' => 70000, 'bahan' => $bahanFlexi->id],
            ['nama' => 'Cetak Custom Backdrop', 'harga' => 60000, 'bahan' => $bahanFlexi->id],
            ['nama' => 'X/Y Banner Custom', 'harga' => 120000, 'bahan' => $bahanLain->id],
            ['nama' => 'Undangan Custom', 'harga' => 10000, 'bahan' => $bahanKertas->id],
            ['nama' => 'Stempel Custom/Stempel Flash', 'harga' => 120000, 'bahan' => $bahanLain->id],
            ['nama' => 'Id Card & Lanyard Custom', 'harga' => 70000, 'bahan' => $bahanLain->id],
            ['nama' => 'Cetak Sticker Custom', 'harga' => 40000, 'bahan' => $bahanSticker->id],
            ['nama' => 'Cetak Brosur A4', 'harga' => 16500, 'bahan' => $bahanKertas->id],
            ['nama' => 'MUG Custom', 'harga' => 65000, 'bahan' => $bahanLain->id],
            ['nama' => 'Kaos Sablon Custom', 'harga' => 120000, 'bahan' => $bahanLain->id],
        ];

        foreach ($dataProduk as $item) {
            Produk::create([
                'bahan_baku_id' => $item['bahan'],
                'nama_produk' => $item['nama'],
                'harga_dasar' => $item['harga'],
                'deskripsi' => 'Produk cetak berkualitas dari Orbit Print.',
            ]);
        }
    }
}