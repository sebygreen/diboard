-- MariaDB dump 10.19  Distrib 10.11.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: diboard_db
-- ------------------------------------------------------
-- Server version	10.11.2-MariaDB-1:10.11.2+maria~ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `diboard_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `diboard_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `diboard_db`;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post''s ID',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT 'Optional thumbnail',
  `title` varchar(255) NOT NULL COMMENT 'Post''s title',
  `content` text NOT NULL COMMENT 'Post''s content',
  `pub_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Post''s publication timestamp',
  `edited` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL COMMENT 'User''s foreign key',
  PRIMARY KEY (`id`),
  KEY `Post Author` (`user_id`) USING BTREE,
  CONSTRAINT `Post author` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(1,NULL,'First post on diboard!','heard from some friends that this new platform was gonna pop off soon\r\n\r\ngood stuff!\r\n\r\n😁\r\n\r\nEDIT: now with cool but out of order masonry\r\n\r\nEDIT 2: edits working nicely tho','2023-02-25 11:48:55',1,1),
(2,'storage/thumbnails/649897screenshot 2019-12-01 18.14.49.png','MathLab exercise','https://mlm.pearson.com/northamerica/mymathlab/','2023-02-25 11:53:22',0,2),
(3,NULL,'new masonry for the dashboard','read more here: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout/Masonry_Layout','2023-02-25 12:25:19',0,2),
(4,'storage/thumbnails/917031corex.jpg','Razer Core X for sale','don&#039;t need it any more\r\n\r\noriginal packaging,\r\nextra USBC 5m cable because the included one is stupid small,\r\ncleaned and dust free\r\n\r\n500$, slightly negotiable\r\nciao!','2023-02-25 12:30:46',0,1),
(6,'../storage/thumbnails/4692189d3b3960-198f-4a09-9090-3d12812ccf5e_1_201_a.jpeg','strike over!','wooooo','2023-02-26 11:50:00',0,1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s ID',
  `username` varchar(255) NOT NULL COMMENT 'User''s username',
  `email` varchar(255) DEFAULT NULL COMMENT 'User''s email',
  `password` varchar(255) NOT NULL COMMENT 'User''s hashed password',
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Account registration timestamp',
  `avatar` varchar(255) NOT NULL COMMENT 'User''s avatar',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='users table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Dyrsin','sebygreen@gmail.com','$2y$10$ExcmEfA/DLpN2/BuykGDr..hCGEQd.0SfzVHEGYZe97i6sh6r.2Gm','2023-02-25 11:41:28','storage/avatars/310244blini cat.jpg'),
(2,'thedarkstorm','storm@gmail.com','$2y$10$gAJHmGlgLftwoW2V7PJMcurp45EEJ/q9OoZCZ4P4fdVUX91CCdlM.','2023-02-25 11:52:24','storage/avatars/365172logo_discord_text.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-26 17:57:57
