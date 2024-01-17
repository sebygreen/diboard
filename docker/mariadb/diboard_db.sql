-- MySQL dump 10.13  Distrib 8.2.0, for macos14.0 (arm64)
--
-- Host: 127.0.0.1    Database: diboard_db
-- ------------------------------------------------------
-- Server version	11.2.2-MariaDB-1:11.2.2+maria~ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Current Database: `diboard_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS */ `diboard_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `diboard_db`;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts`
(
    `id`        int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Index/post number',
    `uuid`      char(36)         NOT NULL COMMENT 'Unique identifier',
    `thumbnail` varchar(255)     NULL     DEFAULT NULL COMMENT 'Optional thumbnail',
    `title`     varchar(255)     NOT NULL COMMENT 'Title',
    `content`   text             NOT NULL COMMENT 'Content',
    `pub_time`  timestamp        NOT NULL DEFAULT current_timestamp() COMMENT 'Publication timestamp',
    `edit_time` timestamp        NULL     DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Edit timestamp',
    `edited`    tinyint(1)       NOT NULL DEFAULT 0 COMMENT 'Edit status',
    `author`    char(36)         NOT NULL COMMENT 'Author uuid',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uuid` (`uuid`),
    KEY `author` (`author`),
    CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `users` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users`
(
    `id`       int(11)      NOT NULL AUTO_INCREMENT COMMENT 'Index/user number',
    `uuid`     char(36)     NOT NULL COMMENT 'Unique identifier',
    `username` varchar(255) NOT NULL COMMENT 'Username',
    `email`    varchar(255) NOT NULL COMMENT 'Email',
    `password` varchar(255) NOT NULL COMMENT 'Hashed password',
    `avatar`   varchar(255) NOT NULL COMMENT 'Avatar',
    `reg_time` timestamp    NOT NULL DEFAULT current_timestamp() COMMENT 'Registration timestamp',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uuid` (`uuid`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci COMMENT ='users table';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2024-01-16 11:37:08
