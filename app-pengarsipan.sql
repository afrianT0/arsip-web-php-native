-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table arsip_phpnative.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arsip_phpnative.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `picture`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', '6617d9327e9d3.png', '2024-02-15 06:38:58', '2024-04-11 12:36:02'),
	(2, 'user', 'user@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'User', '6617d5644b873.png', '2024-04-06 06:11:35', '2024-04-11 12:19:48');

-- Dumping structure for table arsip_phpnative.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arsip_phpnative.categories: ~3 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Keuangan', '2024-02-15 13:50:40', '2024-02-17 13:00:48'),
	(9, 'Perizinan', '2024-02-23 08:09:16', '2024-02-23 08:09:16'),
	(10, 'Perpajakan', '2024-02-23 17:00:35', '2024-04-04 14:41:14');

-- Dumping structure for table arsip_phpnative.instansi
DROP TABLE IF EXISTS `instansi`;
CREATE TABLE IF NOT EXISTS `instansi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arsip_phpnative.instansi: ~2 rows (approximately)
INSERT INTO `instansi` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
	(1, 'PT. Juhdi Sakti Engineering', 'Serang', '025457951001', '2024-04-07 07:03:39', '2024-04-07 07:03:39');

-- Dumping structure for table arsip_phpnative.archives
DROP TABLE IF EXISTS `archives`;
CREATE TABLE IF NOT EXISTS `archives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `instansi_id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tipe_surat` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor` (`nomor`),
  KEY `FK_archives_categories` (`category_id`),
  KEY `FK_archives_users` (`user_id`),
  KEY `FK_archives_instansi` (`instansi_id`),
  CONSTRAINT `FK_archives_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_archives_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`),
  CONSTRAINT `FK_archives_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table arsip_phpnative.archives: ~2 rows (approximately)
INSERT INTO `archives` (`id`, `category_id`, `user_id`, `instansi_id`, `nama`, `nomor`, `tanggal`, `deskripsi`, `file`, `tipe_surat`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 3, 'Invoice', '0047/TJK-KPP/X/23', '2024-04-01', 'TESTESTTEST', '2024-04-01-6612510e6f19a.pdf', '1', '2024-04-07 07:53:50', '2024-04-07 07:53:50'),
	(2, 9, 1, 2, 'Invoice', '0048/TJK-KPP/X/23', '2024-04-07', 'TESTESTTEST', '2024-04-07-6612512206118.pdf', '2', '2024-04-07 07:54:10', '2024-04-07 07:54:10'),
	(3, 10, 39, 2, 'Invoice', '0040/TJK-KPP/X/23', '2024-04-07', 'TESTESTTEST', '2024-04-07-66129867b95df.pdf', '1', '2024-04-07 12:58:15', '2024-04-07 12:58:15');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
