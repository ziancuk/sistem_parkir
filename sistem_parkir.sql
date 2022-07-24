-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 23, 2022 at 03:05 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `faults`
--

CREATE TABLE `faults` (
  `fault_id` bigint(20) UNSIGNED NOT NULL,
  `role_pelanggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faults`
--

INSERT INTO `faults` (`fault_id`, `role_pelanggaran`, `nama_pelanggaran`, `denda`, `created_at`, `updated_at`) VALUES
(1, '1', 'Kunci Motor Hilang', '20000', '2022-07-22 18:59:27', '2022-07-22 18:59:27'),
(2, '2', 'Tiket Parkir Hilang', '20000', '2022-07-22 18:59:35', '2022-07-22 18:59:35'),
(3, '3', 'Kunci motor hilang + Tidak membawa STNK', '50000', '2022-07-22 18:59:49', '2022-07-22 18:59:49'),
(4, '4', 'Tiket Parkir Hilang + Tidak Membawa STNK', '50000', '2022-07-22 19:00:01', '2022-07-22 19:00:01'),
(6, '5', 'Tiket Parkir Hilang + Kunci Motor Hilang + Tidak Membawa STNK', '100000', '2022-07-22 19:00:53', '2022-07-22 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2022_05_02_344905_create_guests_table', 1),
(31, '2014_10_12_000000_create_users_table', 2),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(33, '2022_05_03_000712_create_vehicles_table', 2),
(34, '2022_05_03_001638_create_faults_table', 2),
(35, '2022_05_03_004001_create_parkings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parkings`
--

CREATE TABLE `parkings` (
  `kode_parkir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `fault_id` bigint(20) UNSIGNED DEFAULT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `biaya` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petugas_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkings`
--

INSERT INTO `parkings` (`kode_parkir`, `user_id`, `vehicle_id`, `fault_id`, `waktu_masuk`, `waktu_keluar`, `biaya`, `petugas_out`, `status`, `created_at`, `updated_at`) VALUES
('S23072200001', 1, 1, NULL, '2022-07-23 09:58:44', '2022-07-23 10:02:16', '3000', '1', 'Keluar', '2022-07-22 19:58:44', '2022-07-22 20:02:16'),
('S23072200002', 1, 2, NULL, '2022-07-23 09:58:50', '2022-07-23 10:02:21', '3000', '1', 'Keluar', '2022-07-22 19:58:50', '2022-07-22 20:02:21'),
('S23072200003', 1, 3, 2, '2022-07-23 09:58:57', '2022-07-23 10:03:07', '23000', 'Admin Super', 'Keluar', '2022-07-22 19:58:57', '2022-07-22 20:03:07'),
('S23072200004', 1, 4, NULL, '2022-07-23 09:59:05', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 19:59:05', '2022-07-22 19:59:05'),
('S23072200005', 1, 5, NULL, '2022-07-23 09:59:38', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 19:59:39', '2022-07-22 19:59:39'),
('S23072200006', 1, 6, NULL, '2022-07-23 09:59:52', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 19:59:52', '2022-07-22 19:59:52'),
('S23072200007', 1, 7, NULL, '2022-07-23 10:00:03', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:00:03', '2022-07-22 20:00:03'),
('S23072200008', 1, 8, NULL, '2022-07-23 10:00:18', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:00:18', '2022-07-22 20:00:18'),
('S23072200009', 1, 9, NULL, '2022-07-23 10:00:45', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:00:45', '2022-07-22 20:00:45'),
('S23072200010', 1, 10, NULL, '2022-07-23 10:01:03', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:01:03', '2022-07-22 20:01:03'),
('S23072200011', 1, 11, 6, '2022-07-23 10:01:08', '2022-07-23 10:02:44', '103000', 'Admin Super', 'Keluar', '2022-07-22 20:01:08', '2022-07-22 20:02:44'),
('S23072200012', 1, 12, NULL, '2022-07-23 10:01:16', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:01:16', '2022-07-22 20:01:16'),
('S23072200013', 1, 13, 4, '2022-07-23 10:01:40', '2022-07-23 10:02:55', '53000', 'Admin Super', 'Keluar', '2022-07-22 20:01:40', '2022-07-22 20:02:55'),
('S23072200014', 1, 14, NULL, '2022-07-23 10:01:45', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:01:45', '2022-07-22 20:01:45'),
('S23072200015', 1, 15, NULL, '2022-07-23 10:02:08', NULL, '3000', 'Belum Keluar', 'Masuk', '2022-07-22 20:02:08', '2022-07-22 20:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(1) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `username`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'adminsuper', 'Admin Super', '$2y$10$BfKZ2JsrZY36c4WrttVZxu/2g2dZFv4IYV/R4IGlVSGRzBcrfsurG', '2022-07-22 18:56:07', '2022-07-22 18:56:07'),
(2, 2, 'userstandar', 'User Standar', '$2y$10$6PHPBWz82iVTSPC4hPimFePa3Dbz938cqEH16gbIsuB73E3Vy.ycK', '2022-07-22 18:57:12', '2022-07-22 18:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `no_polisi` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kendaraan` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `no_polisi`, `jenis_kendaraan`, `created_at`, `updated_at`) VALUES
(1, 'F1212FDX', 'Mobil', '2022-07-22 19:58:44', '2022-07-22 19:58:44'),
(2, 'F1212FDU', 'Mobil', '2022-07-22 19:58:50', '2022-07-22 19:58:50'),
(3, 'F6541RZ', 'Mobil', '2022-07-22 19:58:57', '2022-07-22 19:58:57'),
(4, 'F3224FDX', 'Motor', '2022-07-22 19:59:05', '2022-07-22 19:59:05'),
(5, 'F6393RU', 'Motor', '2022-07-22 19:59:38', '2022-07-22 19:59:38'),
(6, 'F1212FAX', 'Mobil', '2022-07-22 19:59:52', '2022-07-22 19:59:52'),
(7, 'F1212FAU', 'Mobil', '2022-07-22 20:00:03', '2022-07-22 20:00:03'),
(8, 'F1234ASU', 'Mobil', '2022-07-22 20:00:18', '2022-07-22 20:00:18'),
(9, 'F4567ABC', 'Motor', '2022-07-22 20:00:45', '2022-07-22 20:00:45'),
(10, 'B3901HH', 'Mobil', '2022-07-22 20:01:03', '2022-07-22 20:01:03'),
(11, 'B6161AU', 'Mobil', '2022-07-22 20:01:08', '2022-07-22 20:01:08'),
(12, 'B1234AA', 'Motor', '2022-07-22 20:01:16', '2022-07-22 20:01:16'),
(13, 'D1111AA', 'Motor', '2022-07-22 20:01:40', '2022-07-22 20:01:40'),
(14, 'D1111BBB', 'Motor', '2022-07-22 20:01:45', '2022-07-22 20:01:45'),
(15, 'AA1212AU', 'Motor', '2022-07-22 20:02:08', '2022-07-22 20:02:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`fault_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkings`
--
ALTER TABLE `parkings`
  ADD KEY `parkings_user_id_foreign` (`user_id`),
  ADD KEY `parkings_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `parkings_fault_id_foreign` (`fault_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faults`
--
ALTER TABLE `faults`
  MODIFY `fault_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parkings`
--
ALTER TABLE `parkings`
  ADD CONSTRAINT `parkings_fault_id_foreign` FOREIGN KEY (`fault_id`) REFERENCES `faults` (`fault_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parkings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parkings_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
