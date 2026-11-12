-- phpMyAdmin SQL Dump for Perpusda Purwakarta
-- Database: `projek_perpusda`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `projek_perpusda` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `projek_perpusda`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
-- Password default: admin123 ($2y$12$K1dJt65tNn6dY4Z2i0xGleS7jK/K3rK9BwK8Q6/6v6vI9h6r7sCey)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Perpusda', 'admin@perpusda.purwakarta.go.id', NOW(), '$2y$12$eAnp4xZ0s9LSmwU4oV8Q4.j3jV0o0Qy2z2mZfR8u6g.f2B/8F1V42', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `kategoris`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoris_nama_unique` (`nama_kategori`),
  UNIQUE KEY `kategoris_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `kategoris`
INSERT INTO `kategoris` (`id`, `nama_kategori`, `slug`, `icon`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', 'pendidikan', '📚', 'Buku teks akademik, ilmu pengetahuan, dan kurikulum pembelajaran.', NOW(), NOW()),
(2, 'Novel', 'novel', '📖', 'Karya sastra naratif fiksi, petualangan, dan cerita inspiratif.', NOW(), NOW()),
(3, 'Fiksi', 'fiksi', '✨', 'Koleksi fiksi remaja, fantasi, dan dongeng nusantara.', NOW(), NOW()),
(4, 'Agama', 'agama', '🕌', 'Buku keagamaan, akhlak, sejarah islam, dan spiritualitas.', NOW(), NOW()),
(5, 'Sejarah', 'sejarah', '🏛️', 'Sejarah peradaban dunia, kemerdekaan RI, dan kearifan Purwakarta.', NOW(), NOW()),
(6, 'Sains', 'sains', '🔬', 'Fisika, biologi, kimia, eksplorasi antariksa, dan ensiklopedia alam.', NOW(), NOW()),
(7, 'Teknologi', 'teknologi', '💻', 'Komputer, pemrograman, kecerdasan buatan, dan inovasi digital.', NOW(), NOW()),
(8, 'Biografi', 'biografi', '👤', 'Kisah inspiratif tokoh nasional, pemimpin bangsa, dan cendekiawan.', NOW(), NOW()),
(9, 'Sastra', 'sastra', '✍️', 'Puisi, pantun, naskah drama, dan kumpulan esai budaya.', NOW(), NOW()),
(10, 'Umum', 'umum', '🌏', 'Buku wawasan umum, panduan keterampilan hidup, dan referensi umum.', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `katalogs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `katalogs`;
CREATE TABLE `katalogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `katalogs`
INSERT INTO `katalogs` (`id`, `judul`, `penulis`, `penerbit`, `tahun`, `kategori`, `gambar`, `created_at`, `updated_at`) VALUES
(1, '3726 MDPL', 'Nurwina Sari', 'Romancious', '2024', 'Novel', NULL, NOW(), NOW()),
(2, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2005', 'Pendidikan', NULL, NOW(), NOW()),
(3, 'Bumi', 'Tere Liye', 'Gramedia Pustaka Utama', '2014', 'Novel', NULL, NOW(), NOW()),
(4, 'Filosofi Teras', 'Henry Manampiring', 'Kompas', '2018', 'Sejarah', NULL, NOW(), NOW()),
(5, 'Atomic Habits', 'James Clear', 'Gramedia Pustaka Utama', '2019', 'Umum', NULL, NOW(), NOW()),
(6, 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Grasindo', '2018', 'Umum', NULL, NOW(), NOW()),
(7, 'Pulang - Pergi', 'Tere Liye', 'Sabak Grip', '2021', 'Novel', NULL, NOW(), NOW()),
(8, 'Sejarah Purwakarta: Jejak Peradaban dan Budaya', 'Tim Sejarah Purwakarta', 'Disarpusda Purwakarta', '2022', 'Sejarah', NULL, NOW(), NOW()),
(9, 'Dasar-Dasar Pemrograman Web Modern', 'Achmad Solichin', 'Informatika', '2023', 'Teknologi', NULL, NOW(), NOW()),
(10, 'Sains Menjelajah Alam Semesta', 'Bambang Ruwanto', 'Yudhistira', '2020', 'Sains', NULL, NOW(), NOW()),
(11, 'Biografi B.J. Habibie: Sang Guru Bangsa', 'A. Makmur Makka', 'Republika Penerbit', '2020', 'Biografi', NULL, NOW(), NOW()),
(12, 'Menyelami Makna Ibadah dan Spiritualitas', 'Prof. Dr. M. Quraish Shihab', 'Lentera Hati', '2021', 'Agama', NULL, NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `aktivitas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `aktivitas`;
CREATE TABLE `aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'katalog',
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `aktivitas`
INSERT INTO `aktivitas` (`id`, `judul`, `deskripsi`, `tipe`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Admin menambahkan koleksi buku baru: 3726 MDPL', 'Buku kategori Novel karya Nurwina Sari berhasil ditambahkan ke katalog', 'katalog', 'plus', NOW() - INTERVAL 2 HOUR, NOW() - INTERVAL 2 HOUR),
(2, 'Pembaruan data katalog buku Perpusda Purwakarta', 'Sinkronisasi kategori buku dan penambahan koleksi literasi', 'katalog', 'edit', NOW() - INTERVAL 4 HOUR, NOW() - INTERVAL 4 HOUR),
(3, 'Admin menambahkan buku baru: Sejarah Purwakarta', 'Buku muatan lokal Sejarah Purwakarta berhasil ditambahkan', 'katalog', 'plus', NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY),
(4, 'Sistem Informasi Perpusda Purwakarta aktif', 'Inisialisasi sistem perpustakaan dan basis data berhasil', 'system', 'check', NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY);
