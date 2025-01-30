-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 08.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangaverse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manga`
--

INSERT INTO `manga` (`id`, `title`, `image`, `price`, `description`) VALUES
(1, 'Alya Hides Her Feelings in Russian', 'images/mc1.png', 250000, 'Cerita ini berfokus pada Masachika Kuze, seorang siswa SMA yang agak malas tetapi jeli, dan teman sebangkunya yang cantik dan cerdas, Alisa Mikhailovna Kujo (Alya), seorang gadis berdarah campuran Rusia dan Jepang.'),
(2, 'My Girlfriend Cheated on Me', 'images/mc2.png', 250000, 'Yuu Isshiki, seorang mahasiswa tahun pertama, mengetahui bahwa pacarnya Karen berselingkuh dengan seniornya, Kamokura.'),
(3, 'Hell\'s Paradise', 'images/mc3.png', 250000, 'Hell’s Paradise: Jigokuraku bercerita tentang seorang ninja dari Desa Iwagakure yang bernama Gabimaru.'),
(4, 'Blue Lock', 'images/mc4.png', 250000, 'Blue Lock bercerita tentang perjalanan Asosiasi Sepak Bola Jepang (JFA) yang mencari sosok striker (penyerang) bola terbaik.'),
(5, 'Blue Box', 'images/mc5.png', 250000, 'Berlatar di Akademi Eimei, sebuah sekolah yang memiliki keunggulan dalam menciptakan atlet-atlet berbakat.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `subscription_level` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `subscription_level`, `created_at`) VALUES
(4, '1', 'lvl1', '2025-01-29 12:10:59'),
(5, '2', 'lvl1', '2025-01-29 12:11:40'),
(6, '123312', 'lvl1', '2025-01-30 04:30:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
