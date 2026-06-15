-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 04:46 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_zailani`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` decimal(15,2) NOT NULL,
  `minimum_stok` int NOT NULL DEFAULT '10',
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama_bahan`, `kode_barcode`, `stok`, `minimum_stok`, `supplier`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Flexi Standar', NULL, 500.00, 10, NULL, 'm2', '2026-05-08 02:21:13', '2026-05-08 02:21:13'),
(2, 'Art Paper / Chrome', NULL, 1000.00, 10, NULL, 'lembar', '2026-05-08 02:21:13', '2026-05-08 02:21:13'),
(3, 'Vinyl/Sticker', NULL, 200.00, 10, NULL, 'm2', '2026-05-08 02:21:13', '2026-05-08 02:21:13'),
(4, 'Material Custom', NULL, 100.00, 10, NULL, 'pcs', '2026-05-08 02:21:13', '2026-05-08 02:21:13'),
(5, 'dasda', '2', 2.00, 10, 'fdsf', '1', '2026-05-08 03:01:43', '2026-05-08 03:01:43'),
(6, 'fsdf', '1', 16.00, 6, 'vcxv', '3', '2026-05-08 04:06:29', '2026-05-08 04:06:29'),
(7, 'pulpen', '8', 18.00, 15, 'test', '2', '2026-06-09 20:23:45', '2026-06-09 20:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_keranjangs`
--

CREATE TABLE `detail_keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `keranjang_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `panjang` double NOT NULL,
  `lebar` double NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` double NOT NULL,
  `file_desain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_keranjangs`
--

INSERT INTO `detail_keranjangs` (`id`, `keranjang_id`, `produk_id`, `panjang`, `lebar`, `jumlah`, `subtotal`, `file_desain`, `catatan`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 3, 4, 3, 2160000, NULL, NULL, '2026-05-08 04:04:16', '2026-05-08 04:04:16'),
(4, 4, 1, 2, 2, 1, 240000, NULL, 'da', '2026-06-07 06:23:59', '2026-06-07 06:23:59'),
(5, 5, 6, 1, 2, 1, 240000, NULL, 'ok', '2026-06-07 06:35:46', '2026-06-07 06:35:46'),
(6, 6, 2, 2, 1, 1, 140000, NULL, 'c', '2026-06-07 06:42:53', '2026-06-07 06:42:53'),
(7, 7, 2, 2, 1, 1, 140000, NULL, NULL, '2026-06-07 06:47:38', '2026-06-07 06:47:38'),
(8, 8, 5, 3, 1, 1, 30000, NULL, 'gjhcncncn', '2026-06-09 20:20:38', '2026-06-09 20:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `panjang` decimal(8,2) NOT NULL,
  `lebar` decimal(8,2) NOT NULL,
  `jumlah` int NOT NULL,
  `finishing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_desain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `pesanan_id`, `produk_id`, `panjang`, `lebar`, `jumlah`, `finishing`, `file_desain`, `subtotal`, `created_at`, `updated_at`) VALUES
(7, 7, 2, 2.00, 1.00, 1, NULL, '-', 140000.00, '2026-06-07 06:47:46', '2026-06-07 06:47:46'),
(8, 8, 5, 3.00, 1.00, 1, 'gjhcncncn', '-', 30000.00, '2026-06-09 20:21:55', '2026-06-09 20:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 'selesai', '2026-05-08 04:04:16', '2026-05-08 04:04:49'),
(4, 4, 'selesai', '2026-06-07 06:23:59', '2026-06-07 06:24:20'),
(5, 4, 'selesai', '2026-06-07 06:35:46', '2026-06-07 06:35:59'),
(6, 3, 'selesai', '2026-06-07 06:42:53', '2026-06-07 06:43:08'),
(7, 4, 'selesai', '2026-06-07 06:47:38', '2026-06-07 06:47:46'),
(8, 4, 'selesai', '2026-06-09 20:20:38', '2026-06-09 20:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_18_072402_create_bahan_baku_table', 1),
(5, '2026_03_18_072417_create_produk_table', 1),
(6, '2026_03_18_072431_create_voucher_table', 1),
(7, '2026_03_18_072440_create_pesanan_table', 1),
(8, '2026_03_18_072455_create_detail_pesanan_table', 1),
(9, '2026_03_18_072504_create_riwayat_pesanan_table', 1),
(10, '2026_03_18_073904_create_keranjang_table', 1),
(11, '2026_03_18_073914_create_detail_keranjang_table', 1),
(12, '2026_03_18_073922_create_ulasan_table', 1),
(13, '2026_05_08_105413_add_gudang_columns_to_bahan_baku_table', 2),
(14, '2026_05_08_105421_create_riwayat_stoks_table', 2),
(15, '2026_05_08_110357_create_produk_bahan_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `voucher_id` bigint UNSIGNED DEFAULT NULL,
  `nomor_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `potongan_diskon` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_bayar` decimal(15,2) NOT NULL,
  `metode_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Verifikasi','Antrean Cetak','Produksi','Siap Ambil / Dikirim','Selesai','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Pembayaran',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `voucher_id`, `nomor_invoice`, `total_harga`, `potongan_diskon`, `total_bayar`, `metode_pengiriman`, `bukti_bayar`, `status`, `created_at`, `updated_at`) VALUES
(7, 4, NULL, 'INV-20260607-C2LRL', 140000.00, 0.00, 140000.00, 'Ambil di Toko | Bayar via: Mandiri', 'bukti_pembayaran/EhUC9v1WgiVkBC0uABImrXSxa6q7mKqkZqjQjaoQ.png', 'Produksi', '2026-06-07 06:47:46', '2026-06-07 06:48:23'),
(8, 4, NULL, 'INV-20260610-YNENQ', 30000.00, 0.00, 30000.00, 'Ambil di Toko | Bayar via: Mandiri', 'bukti_pembayaran/1MbobTSt05vKe5j3GZavlG5trUOfJ3M3Xba3jnov.png', 'Selesai', '2026-06-09 20:21:55', '2026-06-09 20:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint UNSIGNED NOT NULL,
  `bahan_baku_id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga_dasar` decimal(15,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `bahan_baku_id`, `nama_produk`, `deskripsi`, `harga_dasar`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cetak Banner/Cetak Spanduk/Cetak Baliho', 'Produk cetak berkualitas dari Orbit Print.', 60000.00, 'produk/NwKVPuo5WjuxGUME82SFvfCdEFW0VOIiLgo0ze2Y.png', '2026-05-08 02:21:13', '2026-06-07 06:29:29'),
(2, 1, 'Umbul Umbul Custom/Bendera Custom', 'Produk cetak berkualitas dari Orbit Print.', 70000.00, 'produk/U4DVVK98seY0SCPd56or08PkJ2Y1h4Z1HKlFsrUx.png', '2026-05-08 02:21:13', '2026-06-07 06:29:47'),
(3, 1, 'Cetak Custom Backdrop', 'Produk cetak berkualitas dari Orbit Print.', 60000.00, 'produk/4LKRDn5F80A4SKfULM93yU5C54r2vwwWWvY5SgoV.png', '2026-05-08 02:21:13', '2026-06-07 06:30:01'),
(4, 4, 'X/Y Banner Custom', 'Produk cetak berkualitas dari Orbit Print.', 120000.00, 'produk/4Cxxfqpc4dXQBnZ1hCwBMBLAhWdnEGf6Si8LRXeR.png', '2026-05-08 02:21:13', '2026-06-07 06:30:18'),
(5, 2, 'Undangan Custom', 'Produk cetak berkualitas dari Orbit Print.', 10000.00, 'produk/pLuOi4YIGIzciqtKbHVQTWaSc4Lam0sZG6Al3luR.png', '2026-05-08 02:21:13', '2026-06-07 06:30:33'),
(6, 4, 'Stempel Custom/Stempel Flash', 'Produk cetak berkualitas dari Orbit Print.', 120000.00, 'produk/ypAxo3VaxvgtHOrq6pm1b3Flpwkr27TtIUSfNLdU.png', '2026-05-08 02:21:13', '2026-06-07 06:30:52'),
(7, 4, 'Id Card & Lanyard Custom', 'Produk cetak berkualitas dari Orbit Print.', 70000.00, 'produk/G8cHq8GKlMB6EQFBcMx9e8ijVh6ci2do2mKvjrfJ.png', '2026-05-08 02:21:13', '2026-06-07 06:31:05'),
(10, 4, 'MUG Custom', 'Produk cetak berkualitas dari Orbit Print.', 65000.00, 'produk/mt91wYobR7F0CajD83Iw5APfysbBk3JnjY9RRcwn.png', '2026-05-08 02:21:13', '2026-06-07 06:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `produk_bahan`
--

CREATE TABLE `produk_bahan` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `bahan_baku_id` bigint UNSIGNED NOT NULL,
  `jumlah_digunakan` decimal(10,2) NOT NULL,
  `tipe_pengurangan` enum('per_meter','per_pcs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_meter',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `status_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_pesanan`
--

INSERT INTO `riwayat_pesanan` (`id`, `pesanan_id`, `status_log`, `catatan`, `created_at`, `updated_at`) VALUES
(6, 7, 'Produksi', 'Status diubah oleh Kasir Orbit', '2026-06-07 06:48:23', '2026-06-07 06:48:23'),
(7, 7, 'Produksi', 'Status diubah oleh Kasir Orbit', '2026-06-07 06:48:29', '2026-06-07 06:48:29'),
(8, 8, 'Produksi', 'Status diubah oleh Kasir Orbit', '2026-06-09 20:30:25', '2026-06-09 20:30:25'),
(9, 8, 'Selesai', 'Status diubah oleh Kasir Orbit', '2026-06-09 20:30:59', '2026-06-09 20:30:59'),
(10, 8, 'Produksi', 'Status diubah oleh Kasir Orbit', '2026-06-09 20:32:59', '2026-06-09 20:32:59'),
(11, 8, 'Selesai', 'Status diubah oleh Kasir Orbit', '2026-06-09 20:35:05', '2026-06-09 20:35:05'),
(12, 8, 'Antrean Cetak', 'Status diubah oleh Kasir Orbit', '2026-06-09 20:35:41', '2026-06-09 20:35:41'),
(13, 8, 'Selesai', 'Status diubah oleh Zailani Super Admin', '2026-06-09 20:38:46', '2026-06-09 20:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_stoks`
--

CREATE TABLE `riwayat_stoks` (
  `id` bigint UNSIGNED NOT NULL,
  `bahan_baku_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis` enum('masuk','keluar','penyesuaian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `stok_sebelum` int NOT NULL,
  `stok_sesudah` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_stoks`
--

INSERT INTO `riwayat_stoks` (`id`, `bahan_baku_id`, `user_id`, `jenis`, `jumlah`, `stok_sebelum`, `stok_sesudah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'masuk', 2, 0, 2, 'Input Stok Awal Sistem', '2026-05-08 03:01:43', '2026-05-08 03:01:43'),
(2, 6, 2, 'masuk', 16, 0, 16, 'Input Stok Awal Sistem', '2026-05-08 04:06:29', '2026-05-08 04:06:29'),
(3, 7, 2, 'masuk', 6, 0, 6, 'Input Stok Awal Sistem', '2026-06-09 20:23:45', '2026-06-09 20:23:45'),
(4, 7, 2, 'masuk', 12, 6, 18, 'yaa', '2026-06-09 20:24:05', '2026-06-09 20:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('B8UbngggRI5xbfojhYlf85HXg1YX5JiyiUZcpARU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIzUXdvZ3lQWkZ3U2VGWHRybURvWmZnTGl4TzZEUzdjT1Z1b1ZHWVVkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1781064658),
('sIO86hdATccHZ4s3Se1nkOIMNl7esyF4f8yrgmOn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJoQjExOGpsRnVKYkxKRTZNejJjVmFaeHNjaG5uRW91UlNPTnpuTzd3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9sYXBvcmFuXC9wZW5qdWFsYW4iLCJyb3V0ZSI6ImFkbWluLmxhcG9yYW4ucGVuanVhbGFuIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1781066336),
('VTzYwaes4Ignoi1hmarG1szWABQo0RNtAKLV2V1C', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ2eGNsMnJDcjZxR25vdUloOTEzRXJjeTlqbVhiQkNNS1BMOTZYdklaIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9wZXNhbmFuXC83Iiwicm91dGUiOiJhZG1pbi5wZXNhbmFuLnNob3cifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9', 1780843711);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('super_admin','admin_kantor','kasir','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan',
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `alamat`, `telepon`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zailani Super Admin', 'superadmin@orbit.com', NULL, '$2y$12$5wziZ8tI4iR/pthlpeXzJ.sMeiNIiNId0X5kS3CpnzUHzTbSKZ1Da', 'super_admin', 'Kantor Pusat Orbit Print', '082148567766', NULL, '2026-05-08 02:21:12', '2026-05-08 02:21:12'),
(2, 'Zailani Admin Kantor', 'admin@orbit.com', NULL, '$2y$12$yGbPJeo1uAIZ2SKDWvVwauFRitk2wmyz8KDca6MjTGDuWtjP9EXAy', 'admin_kantor', 'Orbit Print Banjarmasin', '082148567766', NULL, '2026-05-08 02:21:12', '2026-05-08 02:21:12'),
(3, 'Kasir Orbit', 'kasir@orbit.com', NULL, '$2y$12$t93YcVj.FEcktC9QWcVLbua7z3VRdbbutRvf5FsPL8tglTD7yo3AK', 'kasir', 'Area Kasir Orbit', '082148567766', NULL, '2026-05-08 02:21:13', '2026-05-08 02:21:13'),
(4, 'Budi Pelanggan', 'budi@gmail.com', NULL, '$2y$12$CbX7SCAaKwOT3zq9zHCw3./HhGEO8igTnsDcmTym0v7WTtp1seuXC', 'pelanggan', 'Jl. Sultan Adam Banjarmasin', '082148567766', NULL, '2026-05-08 02:21:13', '2026-05-08 02:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_voucher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potongan` decimal(15,2) NOT NULL,
  `kuota` int NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_keranjangs_keranjang_id_foreign` (`keranjang_id`),
  ADD KEY `detail_keranjangs_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pesanan_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `detail_pesanan_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesanan_nomor_invoice_unique` (`nomor_invoice`),
  ADD KEY `pesanan_user_id_foreign` (`user_id`),
  ADD KEY `pesanan_voucher_id_foreign` (`voucher_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_bahan_baku_id_foreign` (`bahan_baku_id`);

--
-- Indexes for table `produk_bahan`
--
ALTER TABLE `produk_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_bahan_produk_id_foreign` (`produk_id`),
  ADD KEY `produk_bahan_bahan_baku_id_foreign` (`bahan_baku_id`);

--
-- Indexes for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_pesanan_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `riwayat_stoks`
--
ALTER TABLE `riwayat_stoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_stoks_bahan_baku_id_foreign` (`bahan_baku_id`),
  ADD KEY `riwayat_stoks_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasan_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `ulasan_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_kode_voucher_unique` (`kode_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk_bahan`
--
ALTER TABLE `produk_bahan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `riwayat_stoks`
--
ALTER TABLE `riwayat_stoks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  ADD CONSTRAINT `detail_keranjangs_keranjang_id_foreign` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_keranjangs_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk_bahan`
--
ALTER TABLE `produk_bahan`
  ADD CONSTRAINT `produk_bahan_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_bahan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD CONSTRAINT `riwayat_pesanan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_stoks`
--
ALTER TABLE `riwayat_stoks`
  ADD CONSTRAINT `riwayat_stoks_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_stoks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
