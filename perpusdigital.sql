-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2024 at 12:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusdigital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `admin_name`, `password`) VALUES
(8, 'admin', '$2y$10$QjSB5PWGxuatwpRIwAGOee63j7ORGAEYyg0/YU8kpTTDxuck4zDFK');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `publisher` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_tersedia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `gambar`, `nama_buku`, `publisher`, `kategori`, `deskripsi`, `jumlah_tersedia`) VALUES
(3, 'nihongo.jpg', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 'contoh', 'Bahasa', 'contoh', 12),
(6, 'informatika_kelas_7.png', 'Informatika Kelas 7 kurikulum merdeka', 'contoh', 'Teknologi', 'contoh', 10);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `id_peminjaman` int NOT NULL,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `jumlah_dipinjam` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman_buku`
--

INSERT INTO `peminjaman_buku` (`id_peminjaman`, `id_user`, `id_buku`, `username`, `nama_buku`, `jumlah_dipinjam`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(4, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 1, '2024-11-07', '2024-11-14'),
(5, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 1, '2024-11-07', '2024-11-14'),
(6, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 3, '2024-11-08', '2024-11-11'),
(7, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 5, '2024-11-08', '2024-11-09'),
(8, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 9, '2024-11-08', '2024-11-10'),
(9, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 9, '2024-11-08', '2024-11-10'),
(10, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 9, '2024-11-08', '2024-11-10'),
(11, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 9, '2024-11-08', '2024-11-10'),
(12, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 9, '2024-11-08', '2024-11-10'),
(13, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 5, '2024-11-08', '2024-11-15'),
(14, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 5, '2024-11-08', '2024-11-15'),
(15, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 5, '2024-11-08', '2024-11-15'),
(16, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 2, '2024-11-08', '2024-11-11'),
(17, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 2, '2024-11-08', '2024-11-11'),
(18, 2, 3, 'rizky', 'Nihongo RakuRaku (Bahasa Jepang untuk SMK kurikulum Tahun 2013)', 6, '2024-11-08', '2024-11-09'),
(19, 2, 6, 'rizky', 'Informatika Kelas 7 kurikulum merdeka', 3, '2024-11-08', '2024-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(2, 'rizky', '$2y$10$brlY4MpbkrireOWIsotmBeDkdRp9qawrqW.dIINugAnQIWbUGxW/.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
