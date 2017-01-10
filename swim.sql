CREATE DATABASE  IF NOT EXISTS `swim` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `swim`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 192.168.0.103    Database: swim
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `meet_events`
--

DROP TABLE IF EXISTS `meet_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meet_events` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=butterfly, 1 = back, 2 = breast, 3 = free, 4 = im relay, 5 = medley relay, 6= free relay',
  `deleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meets`
--

DROP TABLE IF EXISTS `meets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meets` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Meet name',
  `type` int(5) NOT NULL COMMENT 'ID of the meet type from the meet_events table',
  `date` date NOT NULL,
  `length` int(2) NOT NULL COMMENT '0=25 yards 1=25 meters',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT '0=not deleted',
  `active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reset_password`
--

DROP TABLE IF EXISTS `reset_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_password` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL COMMENT 'The id of the user in the users table',
  `timestamp` int(20) NOT NULL COMMENT 'timestamp of request',
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'token for verification',
  `reset` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `timecards`
--

DROP TABLE IF EXISTS `timecards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timecards` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stroke` int(5) NOT NULL,
  `length` int(2) NOT NULL,
  `event` int(20) NOT NULL,
  `time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00:00',
  `created_by` int(5) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `meet_id` int(10) NOT NULL,
  `relay_letter` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(A, B, C, etc)',
  `division` int(3) NOT NULL COMMENT '0= open, 1=junior, 2=senior',
  `competes_with` int(11) NOT NULL COMMENT '0=girls, 1= boys',
  `type` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restrict_to_one` (`name`,`event`,`meet_id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` int(5) NOT NULL COMMENT '0=open 1=junior 2=senior',
  `competes_with` int(5) NOT NULL COMMENT '0=girls 1=boys',
  `rank` int(5) NOT NULL COMMENT '0=swimmer 1=captain 2=manager 3=admin 4=superadmin?',
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` int(5) NOT NULL DEFAULT '-1' COMMENT '9, 10, 11, 12, 13 or -1',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT '0 = not deleted, 1 = deleted',
  `email` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setup` int(2) NOT NULL DEFAULT '0' COMMENT '0=Never logged in, 1=logged in before',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'swim'
--

--
-- Dumping routines for database 'swim'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-09 19:32:54
