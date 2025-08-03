-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2024 at 05:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adscampaign`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(139, '0001_01_01_000000_create_users_table', 1),
(140, '0001_01_01_000001_create_cache_table', 1),
(141, '0001_01_01_000002_create_jobs_table', 1),
(142, '2024_05_29_121856_create_tasks_table', 1),
(143, '2024_05_29_121901_create_submissions_table', 1),
(144, '2024_05_29_121905_create_redeems_table', 1);

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
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `owner_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` enum('approve','pending','reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `redeems`
--

INSERT INTO `redeems` (`id`, `user_id`, `owner_name`, `bank_name`, `account_number`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'BRI', '2112692483', '52.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(2, 1, 'Admin', 'SHOPEEPAY', '6032023444', '54.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(3, 1, 'Admin', 'BNI', '8243537545', '56.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(4, 2, 'Budi Budiman', 'BCA', '4691610620', '56.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(5, 2, 'Budi Budiman', 'SHOPEEPAY', '1745781642', '66.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(6, 2, 'Budi Budiman', 'BRI', '8797692745', '53.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(7, 3, 'Ani Septiani', 'GOPAY', '1617082348', '57.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(8, 3, 'Ani Septiani', 'SHOPEEPAY', '6955012531', '68.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(9, 3, 'Ani Septiani', 'BRI', '8840825946', '70.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(10, 4, 'Agus Sofian', 'BRI', '4418258168', '62.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(11, 4, 'Agus Sofian', 'MANDIRI', '8126555969', '54.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(12, 4, 'Agus Sofian', 'BRI', '5211215454', '70.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(13, 5, 'Aklanul Huda', 'GOPAY', '5759055138', '55.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(14, 5, 'Aklanul Huda', 'BNI', '3665789225', '51.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(15, 5, 'Aklanul Huda', 'GOPAY', '1108472161', '60.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(16, 6, 'Guntur Pamungkas', 'GOPAY', '3984563259', '52.00', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(17, 6, 'Guntur Pamungkas', 'GOPAY', '5841905414', '62.00', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(18, 6, 'Guntur Pamungkas', 'BRI', '3740786279', '56.00', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14');

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
('euqnn9PmMhpYgf8UaPhSVgklSGHA3tnLI7I9QLEz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDlTMFNEM0kwdU4za1hUd3h2bXdMZUJPb1MwQUNUSUhIelVUMk9rWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2Fkc2NhbXBhaWduLnRlc3Q6ODA4MC90YXNrcyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vYWRzY2FtcGFpZ24udGVzdDo4MDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1731562569),
('F7QMHFLGlVHvPowVyOPHJPEPF71ICSI4TSiLYy2n', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT21ma2ppT0ZDeFV6RmJubDVlekZvczRvb21MUTlqQlJ2Tm9pa3NvcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9hZHNjYW1wYWlnbi50ZXN0OjgwODAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1731477829),
('JDxQfRXuxXkbOOKnizFjObkbuy6dY0jsEi38FALy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaGJ3Vnl3bHBxa3hFaXREc2RLSjBFRUIxT01MYXk2SzFZUG5GUWxhYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9hZHNjYW1wYWlnbi50ZXN0OjgwODAvcHJvZmlsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1731398648);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `submission_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('approve','pending','reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `task_id`, `submission_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'https://example.com/submission21', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(2, 2, 2, 'https://example.com/submission22', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(3, 2, 3, 'https://example.com/submission23', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(4, 3, 1, 'https://example.com/submission31', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(5, 3, 2, 'https://example.com/submission32', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(6, 3, 3, 'https://example.com/submission33', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(7, 4, 1, 'https://example.com/submission41', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(8, 4, 2, 'https://example.com/submission42', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(9, 4, 3, 'https://example.com/submission43', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(10, 5, 1, 'https://example.com/submission51', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(11, 5, 2, 'https://example.com/submission52', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(12, 5, 3, 'https://example.com/submission53', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(13, 6, 1, 'https://example.com/submission61', 'pending', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(14, 6, 2, 'https://example.com/submission62', 'approve', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(15, 6, 3, 'https://example.com/submission63', 'reject', '2024-11-08 11:12:14', '2024-11-08 11:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `points`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'Unggah Foto Produk di Instagram', 'Posting foto kreatif Anda bersama produk di Instagram dan tag akun resmi kami @AkunBrand. Gunakan hashtag #BrandKami untuk kesempatan memenangkan hadiah!', 20, '2024-12-08 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(2, 'Lomba Kreativitas Kemerdekaan', 'Ikuti lomba kreativitas dengan tema kemerdekaan: menggambar, membuat poster, atau menulis puisi yang mengungkapkan cinta pada Indonesia. Posting karya Anda di media sosial, tag akun Kemendikbud, dan gunakan hashtag #KreativitasKemerdekaan.', 15, '2024-11-20 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(3, 'Review Produk di Facebook', 'Bagikan pengalaman Anda menggunakan produk kami di Facebook. Mention akun kami dan gunakan hashtag #ReviewBrandKami. Setiap postingan akan mendapatkan poin tambahan.', 20, '2024-12-08 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(4, 'Dukung Gerakan Cinta Lingkungan', 'Posting foto atau video aksi peduli lingkungan, seperti menanam pohon atau membersihkan sampah di sekitar Anda. Tag akun resmi kami dan gunakan hashtag #CintaLingkungan. Setiap postingan akan memberikan poin tambahan.', 25, '2024-11-28 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(5, 'Ulasan Produk di Twitter', 'Tweet ulasan singkat tentang produk kami di Twitter dan tag akun kami @AkunBrandOfficial. Gunakan hashtag #ProdukKerenKami untuk mendapatkan poin.', 20, '2024-11-23 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(6, 'Bagikan Cerita Tentang Pahlawan Indonesia', 'Posting tentang pahlawan Indonesia yang menginspirasi di media sosial. Tuliskan kisah atau pesan yang berkesan dari perjuangan pahlawan tersebut, tag akun Kemendikbud, dan gunakan hashtag #PahlawanIndonesia. Dapatkan poin dengan setiap cerita yang diposting.', 30, '2024-11-15 18:12:14', '2024-11-08 11:12:14', '2024-11-08 11:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL DEFAULT '0',
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `points`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$.M8ETOo4oRevd/RuyMGPye9iZQkRFcfMtkTbde1bmBKAYH32uiQ/G', 0, 'admin', NULL, '2024-11-08 11:12:13', '2024-11-08 11:12:13'),
(2, 'Budi Budiman', 'budi@gmail.com', NULL, '$2y$12$kANTJgvA5IlZwCRSTccxMuKHFhCtOQRnbZ.gcsHxKbkgBhP4wLBuG', 100, 'user', NULL, '2024-11-08 11:12:13', '2024-11-08 11:12:13'),
(3, 'Ani Septiani', 'ani@gmail.com', NULL, '$2y$12$KMf2Vx58evHbNyHeeTKRX.lFA3NSkSCncN8JsIz/8lSOHKQYPJJuC', 120, 'user', NULL, '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(4, 'Agus Sofian', 'agus@gmail.com', NULL, '$2y$12$4vdXZHP5Qz5Y/ws0xb3MJ.RC2WfdRiJz4AQQV5acDFyvd.HCBlh7S', 80, 'user', NULL, '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(5, 'Aklanul Huda', 'aklanul@gmail.com', NULL, '$2y$12$7eriaTc.WO2vkwcXMOoa4esygA5K2r0ox3eplAsMSQ975.9jqNkSW', 150, 'user', NULL, '2024-11-08 11:12:14', '2024-11-08 11:12:14'),
(6, 'Guntur Pamungkas', 'guntur@gmail.com', NULL, '$2y$12$NIWWTv2ODErR5o94bJi2dOIXdSfm4UPkjL9r16aaQ.i0Ix0D1IlH2', 70, 'user', NULL, '2024-11-08 11:12:14', '2024-11-08 11:12:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `redeems_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_user_id_foreign` (`user_id`),
  ADD KEY `submissions_task_id_foreign` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `redeems`
--
ALTER TABLE `redeems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `redeems`
--
ALTER TABLE `redeems`
  ADD CONSTRAINT `redeems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
