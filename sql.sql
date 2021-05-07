/*
SQLyog Ultimate v9.10 
MySQL - 5.5.5-10.4.13-MariaDB : Database - mzansi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `m_song` */

DROP TABLE IF EXISTS `m_song`;

CREATE TABLE `m_song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `author` varchar(128) DEFAULT NULL,
  `duration` decimal(10,0) DEFAULT NULL,
  `path` varchar(1024) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `photo` varchar(512) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `level` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
