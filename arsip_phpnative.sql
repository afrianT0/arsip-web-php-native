-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2024 at 05:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.10

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
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `instansi_id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tipe_surat` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `category_id`, `user_id`, `instansi_id`, `nama`, `nomor`, `tanggal`, `deskripsi`, `file`, `tipe_surat`, `created_at`, `updated_at`) VALUES
(72, 1, 1, 3, 'Invoice', '0047/TJK-KPP/X/23', '2024-04-01', 'TESTESTTEST', '2024-04-01-6612510e6f19a.pdf', '1', '2024-04-07 07:53:50', '2024-04-07 07:53:50'),
(73, 9, 1, 2, 'Invoice', '0048/TJK-KPP/X/23', '2024-04-07', 'TESTESTTEST', '2024-04-07-6612512206118.pdf', '2', '2024-04-07 07:54:10', '2024-04-07 07:54:10'),
(74, 10, 39, 2, 'Invoice', '0040/TJK-KPP/X/23', '2024-04-07', 'TESTESTTEST', '2024-04-07-66129867b95df.pdf', '1', '2024-04-07 12:58:15', '2024-04-07 12:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Keuangan', '2024-02-15 13:50:40', '2024-02-17 13:00:48'),
(9, 'Perizinan', '2024-02-23 08:09:16', '2024-02-23 08:09:16'),
(10, 'Perpajakan', '2024-02-23 17:00:35', '2024-04-04 14:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'PT. Juhdi Sakti Engineering', 'Serang', '025457951001', '2024-04-07 07:03:39', '2024-04-07 07:03:39'),
(3, 'PT. Krakatau Global Trading', 'Cilegon', '081381029077', '2024-04-07 07:26:50', '2024-04-07 07:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', '6617d9327e9d3.png', '2024-02-15 06:38:58', '2024-04-11 12:36:02'),
(39, 'user', 'user@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'User', '6617d5644b873.png', '2024-04-06 06:11:35', '2024-04-11 12:19:48'),
(40, 'user1', 'user2@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'User', '6617d88d6ba49.png', '2024-04-07 14:03:24', '2024-04-11 12:33:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`),
  ADD KEY `FK_archives_categories` (`category_id`),
  ADD KEY `FK_archives_users` (`user_id`),
  ADD KEY `FK_archives_instansi` (`instansi_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `FK_archives_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_archives_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`),
  ADD CONSTRAINT `FK_archives_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
