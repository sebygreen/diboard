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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Post''s index',
  `uuid` binary(16) NOT NULL COMMENT 'Posts''s unique identifier',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT 'Optional thumbnail',
  `title` varchar(255) NOT NULL COMMENT 'Post''s title',
  `content` text NOT NULL COMMENT 'Post''s content',
  `pub_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Post''s publication timestamp',
  `edit_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Time of edit',
  `edited` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'If post is edited',
  `author` binary(16) NOT NULL COMMENT 'Post''s author uuid',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`) USING BTREE,
  CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `users` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s index',
  `uuid` binary(16) NOT NULL COMMENT 'User''s unique identifier',
  `username` varchar(255) DEFAULT NULL COMMENT 'User''s username',
  `email` varchar(255) DEFAULT NULL COMMENT 'User''s email',
  `password` varchar(255) DEFAULT NULL COMMENT 'User''s hashed password',
  `avatar` varchar(255) NOT NULL COMMENT 'User''s avatar',
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Account registration timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='users table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-02-28 17:15:39
