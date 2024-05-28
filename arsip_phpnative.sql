-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 02:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_phpnative`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
)

--
-- Dumping data for table `tb_instansi`
--

INSERT INTO `tb_instansi` (`id`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'PT Krakatau Global Trading', 'Jakarta', '08123456789', '2024-05-19 17:04:42', '2024-05-19 17:21:16'),
(2, 'PT Juhdi Sakti Engineering', 'Serang', '025457951001', '2024-05-20 06:29:28', '2024-05-20 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
)

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Keuangan', '2024-05-19 15:00:23', '2024-05-19 15:00:23'),
(3, 'Perpajakan', '2024-05-20 06:29:02', '2024-05-20 06:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instansi_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tipe_surat` enum('1','2') NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
)

--
-- Dumping data for table `tb_surat`
--

INSERT INTO `tb_surat` (`id`, `kategori_id`, `user_id`, `instansi_id`, `nama`, `nomor`, `tanggal`, `deskripsi`, `file`, `tipe_surat`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 'Invoice', '001/TJK-KGT/X/23', '2024-05-20', 'TESTESTTEST', 'surat-masuk/2024-05-20-664ae4243d4aa.pdf', '1', '1', '2024-05-20 05:48:20', '2024-05-22 13:06:57'),
(3, 3, 1, 2, 'SP2DK', '002/TJK-KGT/X/23', '2024-05-19', 'TESTESTTEST', 'surat-keluar/2024-05-19-664aedea0e097.pdf', '2', '3', '2024-05-20 06:30:02', '2024-05-20 15:02:15'),
(5, 3, 2, 1, 'SP2DK', '003/TJK-KGT/X/23', '2024-05-20', 'TESTESTTEST', 'surat-masuk/2024-05-20-664b6cb814f3e.pdf', '1', '2', '2024-05-20 15:31:04', '2024-05-22 13:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
)

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `nama`, `email`, `password`, `level`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Afrian', 'admin@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', '6617d9327e9d3.png', '2024-02-15 06:38:58', '2024-05-19 17:31:39'),
(2, 'user', 'User', 'user@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'User', 'default.png', '2024-05-19 16:00:06', '2024-05-19 16:07:27'),
(4, 'validator', 'Validator', 'validator@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Validator', 'default.png', '2024-05-20 15:06:52', '2024-05-20 15:06:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`),
  ADD KEY `FK_tb_surat_tb_kategori` (`kategori_id`),
  ADD KEY `FK_tb_surat_tb_users` (`user_id`),
  ADD KEY `FK_tb_surat_tb_instansi` (`instansi_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD CONSTRAINT `FK_tb_surat_tb_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `tb_instansi` (`id`),
  ADD CONSTRAINT `FK_tb_surat_tb_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`id`),
  ADD CONSTRAINT `FK_tb_surat_tb_users` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
