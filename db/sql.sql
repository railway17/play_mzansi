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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_song` */

insert  into `m_song`(`id`,`title`,`author`,`duration`,`path`,`createdAt`,`updatedAt`,`deleted`) values (1,'test','test','12','C:\\xampp\\htdocs\\mzansi\\uploads\\test','2021-04-26 10:26:34','2021-04-26 10:26:34',0),(2,'test1','test1','1','C:\\xampp\\htdocs\\mzansi\\uploads\\test1','2021-04-26 10:33:00','2021-04-26 10:33:00',0),(3,'test3','test3','12','C:\\xampp\\htdocs\\mzansi\\uploads\\test3','2021-04-26 10:34:47','2021-04-26 10:34:47',0),(6,'test4','updated test 4','3333','C:\\xampp\\htdocs\\mzansi\\uploads\\test4','2021-04-26 10:41:50','2021-04-26 10:41:50',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `m_user` */

insert  into `m_user`(`id`,`username`,`password`,`first_name`,`last_name`,`photo`,`status`,`level`,`createdAt`,`updatedAt`) values (1,'admin','admin',NULL,NULL,NULL,1,1,'2021-03-01 00:00:00','2021-03-01 00:00:00'),(2,'dodi','ca26331c6bfbf9487a7cde0f1f95644449e83baa','Dodi','Bank',NULL,1,2,'2021-03-10 00:00:00','2021-03-10 00:00:00'),(3,'hanmingyun1212@gmail.com','19b58543c85b97c5498edfd89c11c3aa8cb5fe51',NULL,NULL,NULL,1,1,'2021-04-10 00:00:00','2021-04-10 00:00:00'),(5,'testinguser','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','Tester','KKC',NULL,1,2,'2021-04-27 11:56:05','2021-04-27 11:56:05'),(6,'userwithtoken','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','KAB','BBA',NULL,1,2,'2021-04-27 16:46:56','2021-04-27 16:46:56'),(7,'responseUser','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','KAB1','BEF',NULL,1,2,'2021-04-27 16:47:52','2021-04-27 16:47:52'),(8,'tokenUser','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','TTA','BAT',NULL,1,2,'2021-04-27 16:53:00','2021-04-27 16:53:00'),(9,'tokenUserWithId','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','TTAa','BATTA',NULL,1,2,'2021-04-27 16:53:55','2021-04-27 16:53:55'),(10,'tokenTester','19b58543c85b97c5498edfd89c11c3aa8cb5fe51','ABA','TAT',NULL,1,2,'2021-04-27 16:54:58','2021-04-27 16:54:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
