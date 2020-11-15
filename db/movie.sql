-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5980
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for movie
CREATE DATABASE IF NOT EXISTS `movie` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `movie`;

-- Dumping structure for table movie.tb_movie_save
CREATE TABLE IF NOT EXISTS `tb_movie_save` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imdbID` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Actors` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Genre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Plot` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Poster` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Released` date DEFAULT NULL,
  `Runtime` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Writer` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Year` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_save` timestamp NULL DEFAULT current_timestamp(),
  `date_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table movie.tb_movie_save: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_movie_save` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_movie_save` ENABLE KEYS */;

-- Dumping structure for table movie.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table movie.tb_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
