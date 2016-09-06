CREATE DATABASE  IF NOT EXISTS `swim` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `swim`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 192.168.0.103    Database: swim
-- ------------------------------------------------------
-- Server version	5.5.46-0+deb7u1

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
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `text` mediumtext COLLATE utf8_bin NOT NULL COMMENT '0=butterfly, 1 = back, 2 = breast, 3 = free, 4 = im relay, 5 = medley relay, 6= free relay',
  `deleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
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
  `name` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Meet name',
  `type` int(5) NOT NULL COMMENT 'ID of the meet type from the meet_events table',
  `date` date NOT NULL,
  `length` int(2) NOT NULL COMMENT '0=25 yards 1=25 meters',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT '0=not deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meets`
--

LOCK TABLES `meets` WRITE;
/*!40000 ALTER TABLE `meets` DISABLE KEYS */;
INSERT INTO `meets` VALUES (4,'Harbord (A)',11,'2016-01-07',1,1),(10,'Riverdale (B)',13,'2016-01-12',1,1),(11,'AWFgiagfiuwffw',3,'2016-09-11',0,1),(12,'Test Meet',3,'0000-00-00',1,1),(13,'Test Meet',3,'2016-09-12',1,0);
/*!40000 ALTER TABLE `meets` ENABLE KEYS */;
UNLOCK TABLES;

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
  `token` varchar(200) COLLATE utf8_bin NOT NULL COMMENT 'token for verification',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password`
--

LOCK TABLES `reset_password` WRITE;
/*!40000 ALTER TABLE `reset_password` DISABLE KEYS */;
INSERT INTO `reset_password` VALUES (20,1,1451175223,'7q2gHLTtym6P9VvnWoniYjkIayLGC/9K0PSsQDJu');
/*!40000 ALTER TABLE `reset_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timecards`
--

DROP TABLE IF EXISTS `timecards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timecards` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `stroke` int(5) NOT NULL,
  `length` int(2) NOT NULL,
  `event` int(20) NOT NULL,
  `time` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '00:00:00',
  `created_by` int(5) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `meet_id` int(10) NOT NULL,
  `relay_letter` varchar(5) COLLATE utf8_bin NOT NULL COMMENT '(A, B, C, etc)',
  `division` int(3) NOT NULL COMMENT '0= open, 1=junior, 2=senior',
  `competes_with` int(11) NOT NULL COMMENT '0=girls, 1= boys',
  `type` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restrict_to_one` (`name`,`event`,`meet_id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timecards`
--

LOCK TABLES `timecards` WRITE;
/*!40000 ALTER TABLE `timecards` DISABLE KEYS */;
INSERT INTO `timecards` VALUES (62,'45.',0,50,36,'',40,1,10,'',2,1,13),(63,'40.',0,50,36,'00:33.67',1,1,10,'',2,1,13),(64,'40.46.47.48.45.',5,200,62,'02:00.61',40,1,10,'A',2,1,13),(68,'45.',3,100,56,'00:33.68',40,1,10,'',2,1,13),(71,'47.',3,100,56,'00:33.67',40,1,10,'',2,1,13),(73,'40.',3,100,56,'00:59.61',1,1,10,'',2,1,13),(74,'50.',2,50,46,'00:39.34',40,1,10,'',2,1,13),(75,'50.',4,100,50,'',40,1,10,'',2,1,13),(76,'45.',1,50,7,'00:40.00',52,1,11,'',1,0,3),(77,'45.',1,50,8,'00:40.00',52,1,11,'',1,1,3),(78,'54',1,50,10,'',54,1,11,'',2,1,3),(79,'45.45.45.45.45.',6,100,201,'00:00.00',1,1,13,'A',1,0,3);
/*!40000 ALTER TABLE `timecards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `division` int(5) NOT NULL COMMENT '0=open 1=junior 2=senior',
  `competes_with` int(5) NOT NULL COMMENT '0=girls 1=boys',
  `rank` int(5) NOT NULL COMMENT '0=swimmer 1=captain 2=manager 3=admin 4=superadmin?',
  `password` varchar(300) COLLATE utf8_bin NOT NULL,
  `grade` int(5) NOT NULL DEFAULT '-1' COMMENT '9, 10, 11, 12, 13 or -1',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT '0 = not deleted, 1 = deleted',
  `email` varchar(75) COLLATE utf8_bin NOT NULL,
  `setup` int(2) NOT NULL DEFAULT '0' COMMENT '0=Never logged in, 1=logged in before',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Misha.Dev',2,1,4,'$2y$10$OBCWM1.IX6iRep2GBUocqu0zuhkN/p5qn6ajx.iFw6.GUHwYBQiTa',-1,0,'mishazharov1@gmail.com',3),(40,'Misha.Zharov',2,1,1,'$2y$10$aeub5W2uR1r04ySGgNqvmeiv7VQt/7JWuk8aPdsRWUPqjN1mVStUC',12,0,'',3),(42,'Sarah.McFarlan',2,0,0,'$2y$12$FOnvPQl680MNEKOWQwOZdeHOiIogkb/2xZ53NWjPLZVKUphlAyj/y',12,0,'',0),(43,'Evanne.Bell',0,0,1,'$2y$12$emRuGLTnzvwAWHZ32MGuDuN6WBopiboE22tzNLtXmxMf8gQG.jAji',11,0,'',0),(45,'Abhigyan.Dwivedi	',2,1,0,'$2y$12$sab.Mwu88QRKoqRJOGFGv.z4taBEW.A12Y/2KBrlYnzc.OedEkN62',12,0,'',0),(47,'James.Ketchen',2,1,0,'$2y$12$dmmCAxvIBGEun.kIEaMbIu6U47zjv0YkGQa1ZFtBQZquCQeAHLQZ2',12,2,'',0),(48,'Brendan.Dolan.Plymale	',2,1,0,'$2y$12$3CkKrnIAGYEK454rv3bHd.LCUtGhjPWpmnjsc0O.XY72ZIdVgmlWu',12,0,'',0),(49,'Annie.Jiang',2,0,2,'$2y$12$PDSl7D2JDc.O9xHlOjB/Yuz5R4Hk1E.rnRlkRtotmaGhpMvAejMJS',12,1,'',0),(50,'Jack.Spears',2,1,0,'$2y$12$aCRJIPlIiEpeoGjBIvwHZOubFENilbPFTv7Le5inXSmkQH9HV9OpW',12,1,'',0),(51,'a',1,0,0,'$2y$12$2qCVbRqf4gLeuPxKvl28xuOIhlUhPyDqPSdilcHRPEu3cJcKnRLEe',9,2,'',0),(52,'Toni.Pano',2,1,3,'$2y$10$tCZpow1r7HcAHeMol5X.1OvoRGIkcUyDPisOHuCKTqI2P7DBYXgle',12,0,'toni.pano19@gmail.com',3),(53,'toni.piano',-1,1,0,'$2y$12$VexpAe6rA7f79FsRogIyLeQcuDXGLG7.iCOEzLDB88DIMpic00hFq',-1,2,'',0),(54,'a.a',2,1,0,'$2y$10$j3Evvc/vz4LcR0Tq79LncOF0wHKY7Zu55WLn0Ztg5uszaIJSyit/e',12,2,'toni.pano19@gmail.com',3),(56,'James.Captain',2,1,1,'$2y$12$i88iwEA9oBokPVytjfh9.eMaLZ.cRDbi1P8TuG.YuuZHB6lwI//na',12,2,'',0),(57,'Misha.Captain',2,1,1,'$2y$10$d8sDZ5alApAqFo/aY5Elhe1WSV9LEm/OoG3B2uyt4MyaMWme9680a',12,0,'',3),(59,'Rowland.Goddard',2,1,0,'$2y$12$..bQIze/kt/EbVaiqiz0UO2AGUOhzNw2cW7UC.j.qatUYuzl.f7.C',12,2,'',0),(60,'Rowland.Goddard',2,1,0,'$2y$12$exubjJ5X.pFkgSFxwaQI2uQ4Q6zhWydKMogQs5Mn53fQ/v/hSsIXS',12,2,'',0),(61,'Rowland.Goddard',2,1,0,'$2y$12$d1v2Tss2woocJfizpNdtdeEJb0RovcM3Psb1HbhmRxDPH2wlVa972',12,2,'',0),(62,'Rowland.Goddard',2,1,0,'$2y$12$NFLVax6NAm1Z0AQzV7kRN.0YRRxp6vaRtz0amnrVYm8akEuUE2xG.',12,2,'',0),(63,'Rowland.Goddard',2,1,0,'$2y$12$g3E1bsqwJMwmhzgVklpFV.mYhYDewD/i9u.grZu7axFSG5Pi9sU9.',12,2,'',0),(64,'Rowland.Goddard',2,1,0,'$2y$12$3quEbwFInwX26Fh4AsjTrujukZSE3WOJpaG4tMPP8p8Yv.xLG/CGy',12,2,'',0),(65,'Rowland.Goddard',2,1,0,'$2y$12$31rsyULpeP.pbMZQYFYlMuSwH4QrKEnZ5gh5Nz20ZnlZsoNmG5yaa',12,2,'',0),(66,'Rowland.Goddard',2,1,0,'$2y$12$uoGpeyt3VPAvCAcCrRd.EOSc.DOb5l.KfVM8NSO1iu9ZAoCLdbVmu',12,2,'',0),(67,'James.Swimmer',2,1,0,'$2y$10$S4KW2nSvcPJ.btBFxZp64OzORjsB.YoEvwekRPsJa9M29ZhSz1qZa',12,0,'jamesketchen97@gmail.com',3),(68,'James.Captain',2,1,1,'$2y$12$UjmU.xjVF8gttyauu8vNNes5fhv7O.8hX8fpThN83vNBaJ7wgl3J2',12,0,'',0),(69,'A',2,1,0,'$2y$12$1Y6Ir6iAxxw4HMkOh4Em2OtjofC0ASnu1Y9l9ZkB45mOjOPC8574G',11,1,'',0);
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

-- Dump completed on 2016-07-30 17:06:53
