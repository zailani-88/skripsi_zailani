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
        // 1. Akun Admin & User Test
        User::create([
            'name' => 'Zailani Admin',
            'email' => 'admin@orbit.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'telepon' => '08123456789',
            'alamat' => 'Kantor Orbit Print Banjarmasin',
        ]);

        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'user@orbit.com',
            'password' => Hash::make('321'),
            'role' => 'pengguna',
            'telepon' => '08987654321',
            'alamat' => 'Jl. Kayu Tangi, Banjarmasin',
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