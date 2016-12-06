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
-- Dumping data for table `meet_events`
--

LOCK TABLES `meet_events` WRITE;
/*!40000 ALTER TABLE `meet_events` DISABLE KEYS */;
INSERT INTO `meet_events` VALUES (3,'Sprint Meet (2017)','[{\"event\":\"201\",\"length\":\"100\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"202\",\"length\":\"100\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"7\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"8\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"9\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"10\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"33\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"34\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"35\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"36\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"25\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"26\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"27\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"28\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"63\",\"length\":\"400\",\"stroke\":\"6\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"64\",\"length\":\"400\",\"stroke\":\"6\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"43\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"44\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"45\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"46\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"19\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"20\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"21\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"22\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"23\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"24\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"59\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"60\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"61\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"62\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"29\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"30\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"0\",\"competes_with\":\"1\"}]',0),(11,'A Meet (2017)','[{\"event\":\"33\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"34\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"35\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"36\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"1\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"2\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"3\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"4\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"5\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"6\",\"length\":\"200\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"7\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"8\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"9\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"10\",\"length\":\"50\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"11\",\"length\":\"100\",\"stroke\":\"0\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"12\",\"length\":\"100\",\"stroke\":\"0\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"13\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"14\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"15\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"16\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"17\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"18\",\"length\":\"100\",\"stroke\":\"2\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"19\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"20\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"21\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"22\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"23\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"24\",\"length\":\"50\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"25\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"26\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"27\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"28\",\"length\":\"200\",\"stroke\":\"6\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"29\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"30\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"0\",\"competes_with\":\"1\"}]',0),(13,'B Meet (2017)','[{\"event\":\"201\",\"length\":\"100\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"202\",\"length\":\"100\",\"stroke\":\"6\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"31\",\"length\":\"200\",\"stroke\":\"4\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"32\",\"length\":\"200\",\"stroke\":\"4\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"33\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"34\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"35\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"36\",\"length\":\"50\",\"stroke\":\"0\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"37\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"38\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"39\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"40\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"41\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"42\",\"length\":\"100\",\"stroke\":\"1\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"43\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"44\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"45\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"46\",\"length\":\"50\",\"stroke\":\"2\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"47\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"48\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"49\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"50\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"51\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"52\",\"length\":\"100\",\"stroke\":\"4\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"53\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"54\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"55\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"56\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"57\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"58\",\"length\":\"100\",\"stroke\":\"3\",\"division\":\"0\",\"competes_with\":\"1\"},{\"event\":\"59\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"1\",\"competes_with\":\"0\"},{\"event\":\"60\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"1\",\"competes_with\":\"1\"},{\"event\":\"61\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"2\",\"competes_with\":\"0\"},{\"event\":\"62\",\"length\":\"200\",\"stroke\":\"5\",\"division\":\"2\",\"competes_with\":\"1\"},{\"event\":\"63\",\"length\":\"400\",\"stroke\":\"6\",\"division\":\"0\",\"competes_with\":\"0\"},{\"event\":\"64\",\"length\":\"400\",\"stroke\":\"6\",\"division\":\"0\",\"competes_with\":\"1\"}]',0);
/*!40000 ALTER TABLE `meet_events` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Misha.Dev',2,1,4,'$2y$10$JsHayikFfxHXH4pnhLpTSuTPAvdYojBAKVtE5cHlJ2mvp8HCZQKzy',-1,0,'mishazharov1@gmail.com',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2016-12-05 19:29:59
