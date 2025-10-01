-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Okt 2025 pada 06.44
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suksesbelajar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `materi_ajars`
--

CREATE TABLE `materi_ajars` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_materi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2025_09_24_003047_create_roles_table', 1),
(16, '2025_09_24_003048_create_pakets_table', 1),
(17, '2025_09_24_003048_create_soals_table', 1),
(18, '2025_09_24_003049_create_paket_soals_table', 1),
(19, '2025_09_24_003049_create_ujians_table', 1),
(20, '2025_09_24_003050_create_ujian_jawabans_table', 1),
(21, '2025_09_24_003051_add_role_to_users_table', 1),
(22, '2025_09_24_060748_add_birth_date_to_users_table', 1),
(23, '2025_09_28_011957_create_paket_user_table_migration', 1),
(24, '2025_10_01_090842_create_materi_ajars_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `jumlah_soal_twk` int NOT NULL DEFAULT '30',
  `jumlah_soal_tiu` int NOT NULL DEFAULT '35',
  `jumlah_soal_tkp` int NOT NULL DEFAULT '45',
  `waktu_ujian` int NOT NULL DEFAULT '90',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakets`
--

INSERT INTO `pakets` (`id`, `nama_paket`, `deskripsi`, `jumlah_soal_twk`, `jumlah_soal_tiu`, `jumlah_soal_tkp`, `waktu_ujian`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Paket 1', NULL, 35, 30, 45, 100, 1, '2025-09-30 13:14:48', '2025-09-30 13:14:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_soals`
--

CREATE TABLE `paket_soals` (
  `id` bigint UNSIGNED NOT NULL,
  `paket_id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED NOT NULL,
  `urutan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `paket_soals`
--

INSERT INTO `paket_soals` (`id`, `paket_id`, `soal_id`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_user`
--

CREATE TABLE `paket_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `paket_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `paket_user`
--

INSERT INTO `paket_user` (`id`, `user_id`, `paket_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'siswa', 'Siswa', '2025-09-30 12:26:50', '2025-09-30 12:26:50'),
(2, 'admin', 'Administrator', '2025-09-30 12:26:50', '2025-09-30 12:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soals`
--

CREATE TABLE `soals` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` enum('TWK','TIU','TKP') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_a` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_b` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_c` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_d` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_e` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kunci_jawaban` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor_a` int NOT NULL DEFAULT '0',
  `skor_b` int NOT NULL DEFAULT '0',
  `skor_c` int NOT NULL DEFAULT '0',
  `skor_d` int NOT NULL DEFAULT '0',
  `skor_e` int NOT NULL DEFAULT '0',
  `pembahasan` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soals`
--

INSERT INTO `soals` (`id`, `kategori`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `kunci_jawaban`, `skor_a`, `skor_b`, `skor_c`, `skor_d`, `skor_e`, `pembahasan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'TWK', 'Pancasila sebagai dasar negara Indonesia ditetapkan pada tanggal?', '17 Agustus 1945', '18 Agustus 1945', '1 Juni 1945', '22 Juni 1945', '29 Mei 1945', 'B', 0, 0, 0, 0, 0, 'Pancasila ditetapkan sebagai dasar negara pada tanggal 18 Agustus 1945.', 1, '2025-09-30 12:26:50', '2025-09-30 12:26:50'),
(2, 'TIU', 'Jika 2x + 3 = 11, maka nilai x adalah?', '3', '4', '5', '6', '7', 'B', 0, 0, 0, 0, 0, '2x + 3 = 11, maka 2x = 8, sehingga x = 4', 1, '2025-09-30 12:26:50', '2025-09-30 12:26:50'),
(3, 'TKP', 'Ketika menghadapi tugas yang sulit, sikap yang sebaiknya Anda lakukan adalah?', 'Menyerah dan meminta bantuan orang lain', 'Mengerjakan dengan asal-asalan', 'Berusaha keras dan mencari solusi', 'Menunda sampai ada yang membantu', 'Mengeluh kepada atasan', 'C', 1, 2, 5, 3, 1, NULL, 1, '2025-09-30 12:26:50', '2025-09-30 12:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujians`
--

CREATE TABLE `ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `paket_id` bigint UNSIGNED NOT NULL,
  `mulai_ujian` timestamp NOT NULL,
  `selesai_ujian` timestamp NULL DEFAULT NULL,
  `skor_twk` int NOT NULL DEFAULT '0',
  `skor_tiu` int NOT NULL DEFAULT '0',
  `skor_tkp` int NOT NULL DEFAULT '0',
  `total_skor` int NOT NULL DEFAULT '0',
  `status` enum('ongoing','finished','timeout') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujians`
--

INSERT INTO `ujians` (`id`, `user_id`, `paket_id`, `mulai_ujian`, `selesai_ujian`, `skor_twk`, `skor_tiu`, `skor_tkp`, `total_skor`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-09-30 13:16:48', '2025-09-30 13:17:10', 0, 5, 5, 10, 'finished', '2025-09-30 13:16:48', '2025-09-30 13:17:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_jawabans`
--

CREATE TABLE `ujian_jawabans` (
  `id` bigint UNSIGNED NOT NULL,
  `ujian_id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED NOT NULL,
  `jawaban` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `skor` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian_jawabans`
--

INSERT INTO `ujian_jawabans` (`id`, `ujian_id`, `soal_id`, `jawaban`, `is_correct`, `skor`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'C', 0, 0, '2025-09-30 13:16:48', '2025-09-30 13:16:57'),
(2, 1, 2, 'B', 1, 5, '2025-09-30 13:16:48', '2025-09-30 13:17:03'),
(3, 1, 3, 'C', 0, 5, '2025-09-30 13:16:48', '2025-09-30 13:17:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `phone`, `birth_date`, `email`, `birthdate`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'Administrator', NULL, NULL, 'admin@bimbel.com', NULL, NULL, '$2y$12$hsU4F./El664/T3BH7lApe5VY75/4CUk5DdSZx6aqtnqzcJ2UBeUS', NULL, '2025-09-30 12:26:50', '2025-09-30 12:26:50'),
(2, 1, 'Siswa Test', NULL, NULL, 'siswa@test.com', NULL, NULL, '$2y$12$fYygh2TSn6hA9aV6MVbisOpP1VvRnROrB3p32joOVhala2bS60hS.', NULL, '2025-09-30 12:26:50', '2025-09-30 12:26:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `materi_ajars`
--
ALTER TABLE `materi_ajars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket_soals`
--
ALTER TABLE `paket_soals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_soals_paket_id_foreign` (`paket_id`),
  ADD KEY `paket_soals_soal_id_foreign` (`soal_id`);

--
-- Indeks untuk tabel `paket_user`
--
ALTER TABLE `paket_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paket_user_user_id_paket_id_unique` (`user_id`,`paket_id`),
  ADD KEY `paket_user_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_display_name_unique` (`display_name`);

--
-- Indeks untuk tabel `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujians`
--
ALTER TABLE `ujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujians_user_id_foreign` (`user_id`),
  ADD KEY `ujians_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `ujian_jawabans`
--
ALTER TABLE `ujian_jawabans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_jawabans_ujian_id_foreign` (`ujian_id`),
  ADD KEY `ujian_jawabans_soal_id_foreign` (`soal_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `materi_ajars`
--
ALTER TABLE `materi_ajars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `paket_soals`
--
ALTER TABLE `paket_soals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `paket_user`
--
ALTER TABLE `paket_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ujians`
--
ALTER TABLE `ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ujian_jawabans`
--
ALTER TABLE `ujian_jawabans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `paket_soals`
--
ALTER TABLE `paket_soals`
  ADD CONSTRAINT `paket_soals_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paket_soals_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `paket_user`
--
ALTER TABLE `paket_user`
  ADD CONSTRAINT `paket_user_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paket_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ujians`
--
ALTER TABLE `ujians`
  ADD CONSTRAINT `ujians_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ujians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ujian_jawabans`
--
ALTER TABLE `ujian_jawabans`
  ADD CONSTRAINT `ujian_jawabans_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ujian_jawabans_ujian_id_foreign` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
