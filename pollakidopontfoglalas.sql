-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 138.3.248.186    Database: pollakidopontfoglalas
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `esemenyek`
--

CREATE Database if not exists pollakidopontfoglalas;

DROP TABLE IF EXISTS `esemenyek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `esemenyek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cim` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `tema` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `leiras` text CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `kep` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `datum` datetime NOT NULL,
  `feltoltesDatuma` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanarID` int NOT NULL,
  `tanteremID` int NOT NULL,
  `szakID` int NOT NULL,
  `torolt` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tanarID` (`tanarID`),
  KEY `tanteremID` (`tanteremID`),
  KEY `szakID` (`szakID`),
  CONSTRAINT `esemenyek_ibfk_1` FOREIGN KEY (`tanarID`) REFERENCES `users` (`id`),
  CONSTRAINT `esemenyek_ibfk_2` FOREIGN KEY (`tanteremID`) REFERENCES `tanterem` (`id`),
  CONSTRAINT `esemenyek_ibfk_3` FOREIGN KEY (`szakID`) REFERENCES `szakok` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esemenyek`
--

--
-- Table structure for table `evfolyam`
--

DROP TABLE IF EXISTS `evfolyam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evfolyam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nev` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evfolyam`
--

--
-- Table structure for table `iskolak`
--

DROP TABLE IF EXISTS `iskolak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iskolak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nev` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iskolak`
--



--
-- Table structure for table `jelentkezok`
--

DROP TABLE IF EXISTS `jelentkezok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jelentkezok` (
  `id` varchar(36) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `esemenyID` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `neve` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `visszaigazolt` tinyint NOT NULL DEFAULT '0',
  `megjelent` tinyint NOT NULL DEFAULT '0',
  `torolt` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_esemenyID` (`esemenyID`),
  CONSTRAINT `FK_esemeny_jelentkezes` FOREIGN KEY (`esemenyID`) REFERENCES `esemenyek` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jelentkezok`
--



--
-- Temporary view structure for view `jelentkezok_vt`
--

DROP TABLE IF EXISTS `jelentkezok_vt`;
/*!50001 DROP VIEW IF EXISTS `jelentkezok_vt`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jelentkezok_vt` AS SELECT 
 1 AS `id`,
 1 AS `esemenyID`,
 1 AS `email`,
 1 AS `neve`,
 1 AS `megjelent`,
 1 AS `visszaigazolt`,
 1 AS `torolt`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `szakok`
--

DROP TABLE IF EXISTS `szakok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `szakok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `neve` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `neve` (`neve`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `szakok`
--



--
-- Table structure for table `tanterem`
--

DROP TABLE IF EXISTS `tanterem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tanterem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `neve` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `ferohely` int NOT NULL,
  `torolt` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanterem`
--


--
-- Table structure for table `tiltottemail`
--

DROP TABLE IF EXISTS `tiltottemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiltottemail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiltottemail`
--


--
-- Table structure for table `tiltottnevek`
--

DROP TABLE IF EXISTS `tiltottnevek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiltottnevek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nev` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nev_UNIQUE` (`nev`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiltottnevek`
--


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `felhasznalonev` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci DEFAULT NULL,
  `jelszo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci DEFAULT NULL,
  `torolt` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--


--
-- Table structure for table `versenyek`
--

DROP TABLE IF EXISTS `versenyek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versenyek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `versenynev` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tema` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `leiras` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT '',
  `idopont` datetime NOT NULL,
  `jelentkezesiHatarido` datetime NOT NULL,
  `torolt` tinyint NOT NULL DEFAULT '0',
  `kep` varchar(500) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `feltoltesDatuma` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versenyek`
--


--
-- Table structure for table `versenyjelentkezok`
--

DROP TABLE IF EXISTS `versenyjelentkezok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versenyjelentkezok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kod` varchar(45) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `tanuloNeve` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tanarNeve` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `evfolyamID` int NOT NULL,
  `iskolaID` int NOT NULL,
  `versenyID` int NOT NULL,
  `pontszam` int NOT NULL DEFAULT '0',
  `latszodik` tinyint NOT NULL DEFAULT '0',
  `torolt` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `EV_INDEX` (`evfolyamID`) /*!80000 INVISIBLE */,
  KEY `IK_INDEX` (`iskolaID`) /*!80000 INVISIBLE */,
  KEY `V_INDEX` (`versenyID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versenyjelentkezok`
--


--
-- Final view structure for view `jelentkezok_vt`
--

/*!50001 DROP VIEW IF EXISTS `jelentkezok_vt`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_hungarian_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `jelentkezok_vt` AS select `j`.`id` AS `id`,`j`.`esemenyID` AS `esemenyID`,`j`.`email` AS `email`,`j`.`neve` AS `neve`,`j`.`megjelent` AS `megjelent`,`j`.`visszaigazolt` AS `visszaigazolt`,if((((`e`.`datum` < (now() + interval 10 minute)) and (`j`.`megjelent` = 0)) or (`j`.`torolt` = 1)),1,0) AS `torolt` from (`jelentkezok` `j` join `esemenyek` `e` on((`j`.`esemenyID` = `e`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-06  7:57:45
