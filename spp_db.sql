-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Apr 2017 pada 02.43
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spp_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswas`
--

CREATE TABLE IF NOT EXISTS `kelas_siswas` (
  `id` int(10) unsigned NOT NULL,
  `kelas` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kelas` enum('A','B','C','D','E') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kelas_siswas`
--

INSERT INTO `kelas_siswas` (`id`, `kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'VII', 'A', NULL, '2017-03-12 18:03:25'),
(2, 'VII', 'B', '2017-02-01 07:39:44', '2017-03-12 18:01:09'),
(4, 'VIII', 'C', '2017-02-01 07:41:21', '2017-03-12 17:58:36'),
(6, 'VII', 'D', '2017-02-01 08:32:24', '2017-02-16 07:49:04'),
(7, 'VII', 'E', '2017-02-16 07:49:38', '2017-03-12 17:58:11'),
(10, 'VIII', 'A', '2017-03-20 05:42:33', '2017-03-20 07:16:44'),
(11, 'IX', 'B', '2017-03-20 18:00:24', '2017-03-22 20:13:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lunas_bayars`
--

CREATE TABLE IF NOT EXISTS `lunas_bayars` (
  `id` int(10) unsigned NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `lunas_semester_ganjil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lunas_semester_genap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_12_26_055601_membuat_tabel_siswa', 2),
('2016_12_26_060223_membuat_tabel_kelas', 2),
('2016_12_26_060635_membuat_tabel_pembayaran', 2),
('2017_01_18_025950_membuat_table_status', 2),
('2017_02_05_003956_bua_tabel_user_level', 3),
('2017_03_20_100813_membuat_tabel_paket', 4),
('2017_03_29_014615_create_status_lunas_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE IF NOT EXISTS `pakets` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `tipe` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `semester` enum('ganjil','genap','keduanya') COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pakets`
--

INSERT INTO `pakets` (`id`, `nama`, `nominal`, `tipe`, `semester`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'UTS I', 20000, 'sekali', 'ganjil', 'semua', NULL, NULL),
(2, 'UTS II', 20000, 'sekali', 'genap', 'semua', NULL, NULL),
(3, 'UAS I', 50000, 'sekali', 'ganjil', 'semua', NULL, NULL),
(4, 'UAS II', 50000, 'sekali', 'genap', 'semua', NULL, NULL),
(6, 'Qurban', 30000, 'sekali', 'genap', 'semua', NULL, NULL),
(7, 'Foto KTA', 7000, 'sekali', 'ganjil', 'khusus kelas 7', NULL, NULL),
(8, 'Extrakulikuler', 15000, 'perbulan', 'keduanya', 'khusus kelas 8', NULL, NULL),
(9, 'Les', 30000, 'perbulan', 'keduanya', 'khusus kelas 9', NULL, NULL),
(10, 'SPP 7', 100000, 'perbulan', 'keduanya', 'khusus kelas 7', NULL, NULL),
(11, 'SPP 8', 75000, 'perbulan', 'keduanya', 'khusus kelas 8', NULL, NULL),
(12, 'SPP 9', 75000, 'perbulan', 'keduanya', 'khusus kelas 9', NULL, NULL),
(13, 'Buku paket 7', 295000, 'sekali', 'ganjil', 'khusus kelas 7', NULL, NULL),
(14, 'Buku paket 8', 277000, 'sekali', 'ganjil', 'khusus kelas 8', NULL, NULL),
(15, 'Buku paket 9', 267000, 'sekali', 'ganjil', 'khusus kelas 9', NULL, NULL),
(16, 'Studi Tour', 550000, 'sekali', 'ganjil', 'khusus kelas 8', NULL, NULL),
(17, 'Buku UN', 152000, 'sekali', 'ganjil', 'khusus kelas 9', NULL, NULL),
(18, 'UN', 680000, 'sekali', 'genap', 'khusus kelas 9', NULL, NULL),
(20, 'Alat-alat Kelas', 10, 'perbulan', 'ganjil', 'khusus kelas 7', '2017-03-22 19:56:14', '2017-03-22 20:32:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '6e2451336d3423f4e7c4fa49d982ff5eb38727d3f9a90edaaeb0d8bd02625221', '2017-03-12 08:21:04'),
('admin@gmail.com', 'cd43fc520e071f78c5d3711adfece3502a92d8a0e837f0330bedbe4b6f9fcd9d', '2017-03-12 08:21:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE IF NOT EXISTS `pembayarans` (
  `id` int(10) unsigned NOT NULL,
  `siswa_id` int(10) unsigned NOT NULL,
  `kelas_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `paket_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `siswa_id`, `kelas_id`, `user_id`, `paket_id`, `created_at`, `updated_at`) VALUES
(1, 10, 10, 5, 1, '2017-03-21 21:08:07', '2017-03-21 21:08:07'),
(2, 10, 10, 5, 10, '2017-03-21 22:15:18', '2017-03-21 22:15:18'),
(3, 3, 11, 5, 1, '2017-03-21 22:48:18', '2017-03-21 22:48:18'),
(5, 3, 11, 5, 2, '2017-03-21 22:58:18', '2017-03-21 22:58:18'),
(7, 3, 11, 5, 15, '2017-03-21 22:58:33', '2017-03-21 22:58:33'),
(9, 3, 11, 5, 12, '2017-03-21 23:18:24', '2017-03-21 23:18:24'),
(10, 3, 11, 5, 12, '2017-03-22 00:08:13', '2017-03-22 00:08:13'),
(11, 3, 11, 5, 9, '2017-03-24 00:06:48', '2017-03-24 00:06:48'),
(12, 3, 11, 5, 3, '2017-03-28 18:11:20', '2017-03-28 18:11:20'),
(13, 3, 11, 5, 9, '2017-03-28 18:21:06', '2017-03-28 18:21:06'),
(14, 3, 11, 5, 12, '2017-03-28 18:26:07', '2017-03-28 18:26:07'),
(15, 3, 11, 5, 12, '2017-03-28 18:26:13', '2017-03-28 18:26:13'),
(16, 3, 11, 5, 12, '2017-03-28 18:26:17', '2017-03-28 18:26:17'),
(17, 3, 11, 5, 12, '2017-03-28 18:26:22', '2017-03-28 18:26:22'),
(18, 3, 11, 5, 12, '2017-03-28 18:26:25', '2017-03-28 18:26:25'),
(19, 3, 11, 5, 12, '2017-03-28 18:26:31', '2017-03-28 18:26:31'),
(20, 3, 11, 5, 12, '2017-03-28 18:26:35', '2017-03-28 18:26:35'),
(21, 3, 11, 5, 12, '2017-03-28 18:26:38', '2017-03-28 18:26:38'),
(22, 3, 11, 5, 12, '2017-03-28 18:26:42', '2017-03-28 18:26:42'),
(23, 3, 11, 5, 12, '2017-03-28 18:26:46', '2017-03-28 18:26:46'),
(24, 3, 11, 5, 6, '2017-03-28 18:28:41', '2017-03-28 18:28:41'),
(25, 3, 11, 5, 17, '2017-03-29 18:07:42', '2017-03-29 18:07:42'),
(26, 3, 11, 5, 18, '2017-03-29 18:07:46', '2017-03-29 18:07:46'),
(27, 3, 11, 5, 4, '2017-03-29 18:07:53', '2017-03-29 18:07:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE IF NOT EXISTS `siswas` (
  `id` int(10) unsigned NOT NULL,
  `kelas_id` int(10) unsigned NOT NULL,
  `NISN` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `RT` int(10) NOT NULL,
  `RW` int(10) NOT NULL,
  `dusun` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `KPS` int(45) DEFAULT NULL,
  `data_ayah` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `data_ibu` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `angkatan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `kelas_id`, `NISN`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `RT`, `RW`, `dusun`, `KPS`, `data_ayah`, `data_ibu`, `angkatan`, `created_at`, `updated_at`) VALUES
(1, 1, '11112222', 'Vani Agung Dwi Saputro', 'L', 'grobogan', '2017-02-13', 'purwodadi', 1, 2, 'godan', 10102, 'murs', 'eny', '2016-2017', '2017-02-01 07:20:42', '2017-02-15 05:25:19'),
(2, 2, '11113333', 'Aditya Nemo', 'L', 'solo', '2017-02-13', 'solo', 3, 2, 'gonilan', NULL, 'suanto', 'susanti', '2016-2017', '2017-02-01 08:16:56', '2017-02-03 08:47:55'),
(3, 11, '11114444', 'Jesica Veranda', 'P', 'Jakarta', '2017-02-13', 'Jakarta', 2, 4, 'Blok M', 0, 'Bambang', 'Firda', '2016-2017', '2017-02-01 08:59:34', '2017-03-21 22:45:12'),
(4, 1, '11115555', 'Handa Sei', 'L', 'japan', '2017-01-29', 'tokyo', 1, 3, 'hokaido', NULL, 'kenji', 'rei', '2016-2017', '2017-02-01 09:00:18', '2017-02-03 08:48:03'),
(5, 4, '11116666', 'bangkit sanyoto', 'L', 'grobogan', '2017-01-29', 'solo', 5, 2, 'klewer', NULL, 'subang', 'kity', '2016-2017', '2017-02-01 20:02:15', '2017-02-01 20:02:15'),
(7, 6, '11117777', 'Albert Septiawan', 'L', 'lampung', '2017-02-05', 'solo', 1, 2, 'mojosongo', NULL, 'aldi', 'raisa', '2016-2017', '2017-02-01 20:05:01', '2017-02-01 20:05:01'),
(8, 4, '11118888', 'ayana sahab', 'P', 'Jakarta', '2017-02-19', 'jakarta', 1, 1, 'pasar senin', NULL, 'sahab', 'ibu sahanb', '2016-2017', '2017-02-01 20:29:15', '2017-02-01 20:29:15'),
(10, 10, '9999', 'Kim So Hyun', 'P', 'Seoul', '2017-02-26', 'Seoul', 1, 1, 'Dewnde', 0, 'Kim Jin', 'Hyun Byul', '2016-2017', '2017-03-21 07:31:06', '2017-03-21 16:47:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `user_level_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_level_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 1, 'Vani S.Com', 'admin@gmail.com', '$2y$10$zV83Gmbgv8g6RREhYyHLnOTxUH1ChXfWjIyb6Ecft1McYzhGvBOHK', 'HoGn5knLUnr5FZOY6cdF5Qzo68AOHQXtqM9iGuIlDtSuyKsbPgyjilkqmKoI', '2017-02-04 18:09:57', '2017-03-20 09:32:25'),
(6, 2, 'Bangkit Sp.d', 'kepsek@gmail.com', '$2y$10$.WTp5MJueqpzj0JlG9q3g.I4IoY4N8REVYlU9YKkF1HO0spUYJxmS', 'JyxS4LSi95uU2uNXEDAyDdqIqY47E50gSAKpTderhekKTqLuPq4JYNyyD5Ef', '2017-02-04 18:10:28', '2017-02-05 09:20:43'),
(7, 3, 'Ayu Sp.d', 'tu@gmail.com', '$2y$10$mwyavBvBYCYiT4bxxZqo.OP8kvKD.IFa3pVw5FVGp0YOKD993bxL.', 'wNFEpLSa1D8nUuyq9NJ9c78dqbrJzFWI6Cn805ARlCw8xfhS7sHSrma5EXgD', '2017-02-04 18:11:07', '2017-03-12 17:42:32'),
(8, 4, 'mun coba', 'mun@gmail.com', '$2y$10$9zqiD63KNjpXn4c6Rx0N1OP8sVrNlfZ1kBdIppCesXfCKycXlvyTG', 'Cg8FuJajhlzjapypJw1w3va28JduztOWbB2Z3DCBPM1qe6Gni6OWF2XB4x5n', '2017-02-04 18:12:17', '2017-02-04 18:29:15'),
(9, 3, 'Veranda', 've@gmail.com', '$2y$10$jGj8RFm4hZypvDhOhZceH.hVBMrQEqEu5zP8cyDkCXYv8mn1GZ5b2', 'u3N0ry1AHO3lCEKGcPOE99FbimqvLNU3SWOy9ksaOntQQckjD60mMcXVLYYh', '2017-02-16 08:12:33', '2017-02-16 08:18:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_levels`
--

CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user_levels`
--

INSERT INTO `user_levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Tata Usaha', NULL, NULL),
(3, 'Kepala Sekolah', NULL, NULL),
(4, 'Belum Aktif', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas_siswas`
--
ALTER TABLE `kelas_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lunas_bayars`
--
ALTER TABLE `lunas_bayars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`), ADD KEY `siswa_id` (`siswa_id`), ADD KEY `kelas_id` (`kelas_id`), ADD KEY `name_id` (`user_id`), ADD KEY `user_id` (`user_id`), ADD KEY `paket_id` (`paket_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`), ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `user_level_id` (`user_level_id`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas_siswas`
--
ALTER TABLE `kelas_siswas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `lunas_bayars`
--
ALTER TABLE `lunas_bayars`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
ADD CONSTRAINT `pembayaran_kelas_id` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_siswas` (`id`),
ADD CONSTRAINT `pembayaran_paket_id` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`),
ADD CONSTRAINT `pembayaran_siswa_id` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`),
ADD CONSTRAINT `pembayaran_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
ADD CONSTRAINT `siswa_kelas_id` FOREIGN KEY (`kelas_id`) REFERENCES `kelas_siswas` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `user_user_level_id` FOREIGN KEY (`user_level_id`) REFERENCES `user_levels` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
