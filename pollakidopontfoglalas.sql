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

LOCK TABLES `esemenyek` WRITE;
/*!40000 ALTER TABLE `esemenyek` DISABLE KEYS */;
INSERT INTO `esemenyek` VALUES (6,'Teszt Esemény','Teszt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat erat vel mi semper congue. Phasellus sed commodo orci. Cras malesuada commodo leo et ornare. Integer iaculis dignissim efficitur. Morbi dictum diam sed massa malesuada venenatis. Donec quis hendrerit sapien. Ut tempor ornare mauris, eu vehicula mauris volutpat a. Nulla facilisi. Vestibulum sed justo sed diam ultricies gravida quis nec libero. Maecenas id ligula magna. Proin quam elit, consequat et vulputate eget, placerat quis orci. Nullam feugiat, libero at ultricies lacinia, nunc nisl finibus lectus, at semper orci elit vitae mauris. Quisque vitae massa diam. Donec imperdiet, leo nec finibus maximus, metus quam auctor ex, vel porta risus libero ac arcu. Nulla sit amet ligula luctus, consequat neque quis, sagittis tellus.\r\n\r\nAenean pellentesque dictum quam in consequat. Mauris maximus ex vel lacus vulputate, sed sagittis felis lobortis. Pellentesque pellentesque mi pretium turpis pellentesque tincidunt. Pellentesque in dignissim nulla, id maximus lacus. Donec consectetur purus mi, vitae ultricies neque rhoncus eu. Quisque id blandit eros, non malesuada dui. Quisque ac consequat lacus, et rutrum elit. Cras varius tellus eu purus vestibulum mollis. Nulla et finibus mi. Proin ullamcorper pretium urna nec blandit. Sed non velit iaculis, accumsan nisi eget, cursus purus. Duis quis ullamcorper mauris, et elementum felis. Mauris eu lobortis odio. Proin ornare ante non augue pulvinar volutpat. Nam laoreet, mi non vehicula porttitor, nisl augue vestibulum urna, a feugiat purus lorem quis sapien.','66f570141eb15.jpg','2024-10-29 12:40:00','2024-09-26 14:30:44',4,10,6,1),(7,'Teszt Esemény','Teszt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in arcu eu urna ultricies pellentesque. Proin malesuada, est eu auctor venenatis, lacus ante sagittis risus, vitae congue sapien felis sit amet lacus. Nunc at interdum elit. Donec eu nunc eu quam interdum consequat in vel libero. In quis enim euismod, placerat lacus ac, aliquam sem. Suspendisse convallis a arcu sit amet cursus. Fusce sagittis, enim eget volutpat dictum, mauris leo bibendum tellus, ac cursus arcu turpis a elit. Vestibulum malesuada nisi sed ante congue, quis eleifend ipsum tempus.\r\n\r\nInteger eget mi lectus. Aenean pulvinar euismod massa id tempus. Pellentesque eget semper mi, sit amet pharetra ligula. Sed id elementum arcu, vitae rhoncus lectus. Mauris id commodo odio. Nam ut est sem. Nam suscipit aliquet convallis. Proin consequat sollicitudin velit, vel blandit metus maximus vitae. In dictum faucibus erat. Integer purus orci, ullamcorper eget imperdiet nec, elementum eu mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean elementum, purus non dictum hendrerit, lectus urna scelerisque ipsum, vitae vestibulum metus lacus sit amet odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris varius nunc sit amet est dapibus hendrerit. Sed ut bibendum leo, sit amet ultricies metus. Ut porttitor lacus nibh, nec rutrum est sollicitudin vel.\r\n\r\nMorbi efficitur lectus fringilla lacinia accumsan. Sed bibendum felis ligula, tincidunt accumsan nibh dignissim vitae. Aliquam imperdiet tempus sollicitudin. In hendrerit nisi quis ipsum consequat consectetur. Suspendisse non sollicitudin mi, in euismod purus. Phasellus interdum turpis sit amet erat vestibulum, vitae consequat est hendrerit. Praesent eget odio auctor, sagittis magna nec, accumsan metus. Pellentesque nec nulla eu magna suscipit interdum. Sed sed pretium arcu, vel lobortis est. Sed ut nisl sed elit aliquam accumsan. Nulla facilisi. Donec sit amet elementum orci. Sed eu hendrerit elit, eu vehicula purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent tortor sem, malesuada quis libero et, gravida malesuada nibh.','66f7b682bb3c5.jpg','2024-10-15 12:00:00','2024-09-28 07:55:46',4,10,6,1),(8,'Teszt Esemény','Teszt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in arcu eu urna ultricies pellentesque. Proin malesuada, est eu auctor venenatis, lacus ante sagittis risus, vitae congue sapien felis sit amet lacus. Nunc at interdum elit. Donec eu nunc eu quam interdum consequat in vel libero. In quis enim euismod, placerat lacus ac, aliquam sem. Suspendisse convallis a arcu sit amet cursus. Fusce sagittis, enim eget volutpat dictum, mauris leo bibendum tellus, ac cursus arcu turpis a elit. Vestibulum malesuada nisi sed ante congue, quis eleifend ipsum tempus.\r\n\r\nInteger eget mi lectus. Aenean pulvinar euismod massa id tempus. Pellentesque eget semper mi, sit amet pharetra ligula. Sed id elementum arcu, vitae rhoncus lectus. Mauris id commodo odio. Nam ut est sem. Nam suscipit aliquet convallis. Proin consequat sollicitudin velit, vel blandit metus maximus vitae. In dictum faucibus erat. Integer purus orci, ullamcorper eget imperdiet nec, elementum eu mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean elementum, purus non dictum hendrerit, lectus urna scelerisque ipsum, vitae vestibulum metus lacus sit amet odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris varius nunc sit amet est dapibus hendrerit. Sed ut bibendum leo, sit amet ultricies metus. Ut porttitor lacus nibh, nec rutrum est sollicitudin vel.\r\n\r\nMorbi efficitur lectus fringilla lacinia accumsan. Sed bibendum felis ligula, tincidunt accumsan nibh dignissim vitae. Aliquam imperdiet tempus sollicitudin. In hendrerit nisi quis ipsum consequat consectetur. Suspendisse non sollicitudin mi, in euismod purus. Phasellus interdum turpis sit amet erat vestibulum, vitae consequat est hendrerit. Praesent eget odio auctor, sagittis magna nec, accumsan metus. Pellentesque nec nulla eu magna suscipit interdum. Sed sed pretium arcu, vel lobortis est. Sed ut nisl sed elit aliquam accumsan. Nulla facilisi. Donec sit amet elementum orci. Sed eu hendrerit elit, eu vehicula purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent tortor sem, malesuada quis libero et, gravida malesuada nibh.','66f7dd71a39e2.jpg','2024-09-18 12:40:00','2024-09-28 10:41:53',4,10,6,1),(11,'Teszt Esemény','Teszt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vestibulum velit dolor, non gravida nulla vestibulum sit amet. Phasellus venenatis dolor eget metus pharetra finibus. Quisque sit amet vulputate elit, nec rhoncus nisi. Suspendisse facilisis iaculis suscipit. Maecenas congue nisi turpis, in malesuada quam commodo vel. Pellentesque viverra tempus blandit. In ut arcu ante. Mauris lacus mi, pulvinar vel quam sit amet, eleifend pellentesque augue. Duis eget sagittis mi. Praesent sit amet tincidunt tellus. Phasellus consequat ultricies pellentesque. In eu volutpat ipsum. Duis condimentum et sem quis tincidunt.\r\n\r\nDonec ante libero, ornare a enim eu, tempus sodales ipsum. Sed ac nunc justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat commodo molestie. Curabitur sollicitudin sem ultricies ligula tincidunt, eget fermentum orci pretium. Curabitur sit amet scelerisque augue, quis cursus lacus. Cras sit amet est vitae tellus volutpat scelerisque. Aenean viverra scelerisque nulla et scelerisque. Curabitur finibus tincidunt mauris, ornare consequat lorem molestie ac. Ut varius ligula at pharetra auctor. Vestibulum suscipit lacinia pharetra.\r\n\r\nMauris sit amet dolor rhoncus, scelerisque tellus a, faucibus arcu. Aenean lorem massa, hendrerit et placerat eget, bibendum non lacus. Praesent a porttitor orci, et commodo eros. Donec a nulla a lacus iaculis molestie. Ut dignissim ipsum ac porttitor placerat. Praesent in molestie felis. Nam ut erat finibus, hendrerit odio ut, vehicula augue. Mauris volutpat lorem at mi dictum, eu tristique elit viverra. Aliquam erat volutpat.','6700342753be5.jpg','2024-10-15 08:10:00','2024-10-04 18:29:59',4,10,6,1),(12,'Teszt1','Teszt','Ez az esemény hosszú leírása...','6703c3d7cfe17.jfif','2024-10-14 14:00:00','2024-10-07 11:19:51',5,7,5,1),(17,'Teszt Esemény','Teszt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vestibulum velit dolor, non gravida nulla vestibulum sit amet. Phasellus venenatis dolor eget metus pharetra finibus. Quisque sit amet vulputate elit, nec rhoncus nisi. Suspendisse facilisis iaculis suscipit. Maecenas congue nisi turpis, in malesuada quam commodo vel. Pellentesque viverra tempus blandit. In ut arcu ante. Mauris lacus mi, pulvinar vel quam sit amet, eleifend pellentesque augue. Duis eget sagittis mi. Praesent sit amet tincidunt tellus. Phasellus consequat ultricies pellentesque. In eu volutpat ipsum. Duis condimentum et sem quis tincidunt.\r\n\r\nDonec ante libero, ornare a enim eu, tempus sodales ipsum. Sed ac nunc justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat commodo molestie. Curabitur sollicitudin sem ultricies ligula tincidunt, eget fermentum orci pretium. Curabitur sit amet scelerisque augue, quis cursus lacus. Cras sit amet est vitae tellus volutpat scelerisque. Aenean viverra scelerisque nulla et scelerisque. Curabitur finibus tincidunt mauris, ornare consequat lorem molestie ac. Ut varius ligula at pharetra auctor. Vestibulum suscipit lacinia pharetra.\r\n\r\nMauris sit amet dolor rhoncus, scelerisque tellus a, faucibus arcu. Aenean lorem massa, hendrerit et placerat eget, bibendum non lacus. Praesent a porttitor orci, et commodo eros. Donec a nulla a lacus iaculis molestie. Ut dignissim ipsum ac porttitor placerat. Praesent in molestie felis. Nam ut erat finibus, hendrerit odio ut, vehicula augue. Mauris volutpat lorem at mi dictum, eu tristique elit viverra. Aliquam erat volutpat.','6700342753be5.jpg','2024-11-15 08:10:00','2024-10-10 12:06:28',4,10,6,1),(18,'Teszt1','Teszt','Ez az esemény hosszú leírása...','6703c3d7cfe17.jfif','2024-10-14 14:00:00','2024-10-10 12:47:37',5,7,5,1),(19,'TEST','TEST','TEST','6720df116f884.svg','2024-10-29 14:11:00','2024-10-29 13:11:45',4,10,6,1),(20,'Nyitott Kapuk 2024','Magyar nyelv és irodalom','Magyar nyelv és irodalom óra - 9. évfolyamosokkal','672101e8e4c04.png','2024-11-12 08:55:00','2024-10-29 15:37:18',8,26,6,1),(21,'Nyitott Kapuk 2024','Történelem','Történelem óra a 11. évfolyamosokkal','672103bd4bd9a.png','2024-11-12 09:40:00','2024-10-29 15:48:13',32,3,6,1),(22,'Nyitott Kapuk 2024','Matematika','Matematika óra a 10. évfolyamosokkal','6721045e0cec5.png','2024-11-12 10:25:00','2024-10-29 15:50:54',30,18,6,1),(23,'IMGTEST','asd','asd','67211d465c340.png','2024-11-05 18:35:00','2024-10-29 18:37:10',4,10,3,1),(24,'1','1','1','6728aac68d072.docx','2024-11-10 12:06:00','2024-11-04 12:06:50',4,2,3,1),(25,'Nyitott Kapuk Napja 2024','Magyar nyelv és irodalom óra a 9. évfolyamosokkal','Magyar nyelv és irodalom óra a 9. évfolyamosokkal','6729cd4ef0ec5.png','2024-11-12 08:55:00','2024-11-04 16:38:11',8,26,8,0),(26,'Nyitott Kapuk Napja 2024','Történelem óra a 11. évfolyamosokkal','Történelem óra a 11. évfolyamosokkal','6728eaa7aedeb.png','2024-11-12 09:40:00','2024-11-04 16:39:19',32,3,8,0),(27,'Nyitott Kapuk Napja 2024','Matematika óra a 10. évfolyamosokkal','Matematika óra a 10. évfolyamosokkal','6728ead9dfed0.png','2024-11-12 10:25:00','2024-11-04 16:40:09',30,18,8,0),(28,'Nyitott Kapuk Napja 2024','Angolóra a 12. évfolyamosokkal','Angolóra a 12. évfolyamosokkal','6729c82f99541.png','2024-11-12 08:55:00','2024-11-05 08:24:31',23,21,8,0),(29,'Nyitott Kapuk Napja 2024','Angolóra a 12. évfolyamosokkal','Angolóra a 12. évfolyamosokkal','6729c858398a5.png','2024-11-12 09:40:00','2024-11-05 08:25:12',10,12,8,0),(30,'Nyitott Kapuk Napja 2024','Fizika óra a 11. évfolyamosokkal','Fizika óra a 11. évfolyamosokkal','6729c8951d3a8.png','2024-11-12 10:25:00','2024-11-05 08:26:13',35,13,8,0),(31,'Nyitott Kapuk Napja 2024','Hálózati eszközök alapszintű konfigurációja, biztonságos kapcsolatok','Cisco switch-ek alapszintű konfigurációjának megvalósítása, biztonságos SSH kapcsolat kialakítása, alapértelmezett átjárók definiálása','6729c8e456274.png','2024-11-12 08:55:00','2024-11-05 08:27:32',24,6,5,0),(32,'Nyitott Kapuk Napja 2024','Windows szerver és kliens üzemeltetése tartományi környezetben, házirendek','Windows szerveren felhasználó menedzsment megvalósítása, kliens tartományba léptetése, csoportházirendek létrehozása, alkalmazása a kliens gépen','6729c91a5719e.png','2024-11-12 09:40:00','2024-11-05 08:28:26',24,6,5,0),(33,'Nyitott Kapuk Napja 2024','Frontend programozás óra a 13. évfolyamosokkal','Frontend programozás óra a 13. évfolyamosokkal','6729c96eb801b.png','2024-11-12 10:25:00','2024-11-05 08:29:50',15,5,6,0),(34,'Nyitott Kapuk Napja 2024','Backend programozás óra a 13. évfolyamosokkal','Backend programozás óra a 13. évfolyamosokkal','6729ca6fe07b7.png','2024-11-12 08:55:00','2024-11-05 08:34:07',4,10,6,0),(35,'Nyitott Kapuk Napja 2024','Frontend programozás óra a 13. évfolyamosokkal','Frontend programozás óra a 13. évfolyamosokkal','6729caa83f7ea.png','2024-11-12 09:40:00','2024-11-05 08:35:04',4,10,6,0),(36,'Nyitott Kapuk Napja 2024','Matematika óra a 12. évfolyamosokkal','Matematika óra a 12. évfolyamosokkal','6729cae60a1d8.png','2024-11-12 10:25:00','2024-11-05 08:36:06',18,16,8,0),(37,'Nyitott Kapuk Napja 2024','Villamos alapismeretek gyakorlat a 10. évfolyamosokkal','Villamos alapismeretek gyakorlat a 10. évfolyamosokkal','6729cb464b09d.png','2024-11-12 08:55:00','2024-11-05 08:37:42',25,22,3,0),(38,'Nyitott Kapuk Napja 2024','Digitális kultúra II. óra 3D nyomtatással a 9. évfolyamosokkal','Digitális kultúra II. óra 3D nyomtatással a 9. évfolyamosokkal','6729cbaea4c00.png','2024-11-12 09:40:00','2024-11-05 08:39:26',9,29,6,0),(39,'Nyitott Kapuk Napja 2024','Műsorszóró rendszerek óra a távközlési technikusokkal','Műsorszóró rendszerek óra a távközlési technikusokkal','6729cbeca2bd9.png','2024-11-12 10:25:00','2024-11-05 08:40:28',7,2,7,0),(40,'Nyitott Kapuk Napja 2024','Villamos alapismeretek gyakorlat óra a 10. évfolyamosokkal','Villamos alapismeretek gyakorlat óra a 10. évfolyamosokkal','6729cc2735f57.png','2024-11-12 08:55:00','2024-11-05 08:41:27',17,11,3,0),(41,'Nyitott Kapuk Napja 2024','Irányítástechnikai alapok óra a 13. évfolyamosokkal','Irányítástechnikai alapok óra a 13. évfolyamosokkal','6729cc5f32ddf.png','2024-11-12 09:40:00','2024-11-05 08:42:23',25,22,4,0),(42,'Nyitott Kapuk Napja 2024','Digitális kultúra II. óra 3D nyomtatással a 9. évfolyamosokkal','Digitális kultúra II. óra 3D nyomtatással a 9. évfolyamosokkal','6729ccea56cfb.png','2024-11-12 10:25:00','2024-11-05 08:44:42',9,29,5,0),(43,'teszt','2','2','672a13d7cfaca.txt','2024-11-28 13:47:00','2024-11-05 13:47:24',4,2,4,1);
/*!40000 ALTER TABLE `esemenyek` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `evfolyam` WRITE;
/*!40000 ALTER TABLE `evfolyam` DISABLE KEYS */;
INSERT INTO `evfolyam` VALUES (1,'5. évfolyam'),(2,'6. évfolyam'),(3,'7. évfolyam'),(4,'8. évfolyam');
/*!40000 ALTER TABLE `evfolyam` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `iskolak` WRITE;
/*!40000 ALTER TABLE `iskolak` DISABLE KEYS */;
INSERT INTO `iskolak` VALUES (1,'Fábiánsebestyéni Arany János Általános Iskola'),(2,'Kiss Bálint Református Általános Iskola, Óvoda és Bölcsőde'),(3,'Klauzál Gábor Általános Iskola'),(4,'Mindszenti Általános Iskola'),(5,'Szegvári Forray Máté Általános Iskola'),(6,'Szent Erzsébet Katolikus Általános Iskola és Óvoda'),(7,'Szentesi Deák Ferenc Általános Iskola'),(8,'Szentesi Koszta József Általános Iskola');
/*!40000 ALTER TABLE `iskolak` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `jelentkezok` WRITE;
/*!40000 ALTER TABLE `jelentkezok` DISABLE KEYS */;
INSERT INTO `jelentkezok` VALUES ('0404c9dd-9ba9-11ef-8582-0242c0a8500a',26,'judit.muzsik@gmail.com','Muzsik Judit',1,0,0),('044fc59b-9bab-11ef-8582-0242c0a8500a',33,'bkrisztina@gmail.com','Szabó Milán Dominik',1,0,0),('08c537a4-9bab-11ef-8582-0242c0a8500a',38,'eztnefelejtsdel1@gmail.com','FFazekas Csanád',1,0,0),('1',6,'test@test.hu','TEST',1,0,1),('13324ba3-9b8a-11ef-8582-0242c0a8500a',34,'dzali2010@gmail.com','Dósai-Molmár Zalán',0,0,0),('145b3ebb-9bae-11ef-8582-0242c0a8500a',34,'eztnefelejtsdel1@gmail.com','Fazekas Csanád',1,0,0),('1f920276-9c06-11ef-8582-0242c0a8500a',37,'adrigulyas2009@gmail.com','Gulyás Adrián',0,0,0),('26508358-9b7b-11ef-8582-0242c0a8500a',43,'ricsike200719@gmail.com','teszt',1,1,0),('2839fe90-9ba2-11ef-8582-0242c0a8500a',33,'szucs.evi88@gmail.com','Botos Balázs',0,0,0),('28e13864-9bff-11ef-8582-0242c0a8500a',31,'akos.n.2020@gmail.com','Német Ákos',1,0,0),('28e3b0aa-9b8a-11ef-8582-0242c0a8500a',33,'dzali2010@gmail.com','Dósai-Molnár Zalán',0,0,0),('31ba79a2-9bab-11ef-8582-0242c0a8500a',34,'bkrisztina@gmail.com','Szabó Milán Dominik',1,0,0),('31c067bc-9c04-11ef-8582-0242c0a8500a',42,'adrigulyas2009@gmail.com','Gulyás Adrián',0,0,0),('340baf54-9ba1-11ef-8582-0242c0a8500a',31,'molnardaniel1105@gmail.com','Molnár Dániel',1,0,0),('3b298525-9b74-11ef-8582-0242c0a8500a',43,'vargimatix@gmail.com','dwd',1,1,1),('3ce6b75e-9a9d-11ef-8582-0242c0a8500a',24,'teszt@teszt.vom','ewe',0,0,1),('3ec501fc-9a9d-11ef-8582-0242c0a8500a',24,'teszt@teszt.vom','ewe',0,1,1),('405c6f78-9ba3-11ef-8582-0242c0a8500a',27,'virzoli@gmail.com','Virágos Zoltán',1,0,0),('43bc50eb-9bad-11ef-8582-0242c0a8500a',42,'huszak1977@gmail.com','Huszák Dàvid Màrk',1,0,0),('4bbad693-9a9d-11ef-8582-0242c0a8500a',24,'vargimatix@gmail.com','teszt',1,1,1),('4cf50184-9c06-11ef-8582-0242c0a8500a',35,'adrigulyas2009@gmail.com','Gulyás Adrián',0,0,0),('4f836d08-9b91-11ef-8582-0242c0a8500a',42,'banyaismate@gmail.com','Bányai Máté',1,0,0),('5263650d-9bab-11ef-8582-0242c0a8500a',32,'bkrisztina@gmail.com','Szabó Milán Dominik',1,0,0),('53b6239a-9b9d-11ef-8582-0242c0a8500a',34,'peterpusztai13@gmail.com','Pusztai Péter',0,0,0),('5cfec625-9aa1-11ef-8582-0242c0a8500a',24,'adrian.huszka@gmail.com','test',1,0,1),('5d88c73b-9bac-11ef-8582-0242c0a8500a',33,'eztnefelejtsdel1@gmail.com','Fazekas Csanád',1,0,0),('63a66476-9ba2-11ef-8582-0242c0a8500a',42,'molnardaniel1105@gmail.com','Molnár Dániel',1,0,0),('6a1add62-9bad-11ef-8582-0242c0a8500a',41,'huszak1977@gmail.com','Huszák Dàvid Màrk',1,0,0),('6a619182-9ba8-11ef-8582-0242c0a8500a',33,'judit.muzsik@gmail.com','Muzsik Judit',1,0,0),('711df4f3-9ba1-11ef-8582-0242c0a8500a',31,'szucs.evi88@gmail.com','Botos Balázs',1,0,0),('79c292f1-9b90-11ef-8582-0242c0a8500a',34,'banyaismate@gmail.com','Bányai Máté',1,0,0),('8595a311-9b7b-11ef-8582-0242c0a8500a',43,'654646@gmail.com','teszt',0,0,1),('8acbd5b1-9b96-11ef-8582-0242c0a8500a',41,'aszalaiadam@deakdamo.hu','Aszalai Ádám',1,0,1),('908c45ea-9b97-11ef-8582-0242c0a8500a',33,'aszalaiadam@deakdamo.hu','Aszalai Ádám',1,0,1),('925e1699-9b8a-11ef-8582-0242c0a8500a',38,'dzali2010@gmail.com','Dósai-Molnár Zalán',0,0,0),('937ec5bb-9c02-11ef-8582-0242c0a8500a',33,'akos.n.2020@gmail.com','Német Ákos',1,0,0),('99eb817a-9ba8-11ef-8582-0242c0a8500a',28,'judit.muzsik@gmail.com','Muzsik Judit',1,0,0),('9e365460-9b99-11ef-8582-0242c0a8500a',31,'seres.bence1994@gmail.com','Seres Bence',1,0,0),('9e850be3-9b9d-11ef-8582-0242c0a8500a',33,'peterpusztai13@gmail.com','Pusztai Péter',0,0,0),('a19ea828-9ba0-11ef-8582-0242c0a8500a',31,'szecsenyiteodora@gmail.com','Szécsényi Ádám',1,0,0),('a4e60c59-9b61-11ef-8582-0242c0a8500a',29,'dorogizsolt78@gmail.com','Dorogi Norman',1,0,0),('a60ad7b7-9bad-11ef-8582-0242c0a8500a',34,'huszak1977@gmail.com','Huszák Dàvid Màrk',1,0,0),('a790b7fc-9ba1-11ef-8582-0242c0a8500a',32,'molnardaniel1105@gmail.com','Molnár Dániel',1,0,0),('af3b4af5-9b7a-11ef-8582-0242c0a8500a',43,'ricsike200719@gmail.com','teszt',1,0,1),('b3f57b3c-9b7b-11ef-8582-0242c0a8500a',43,'mlevente468@gmail.com','teszt',1,1,1),('bae946d5-9b9c-11ef-8582-0242c0a8500a',34,'tibrik.david2010@gmail.com','Tibrik Dávid',1,0,0),('c03f0319-9b9a-11ef-8582-0242c0a8500a',31,'martondominik2010@gmail.com','Marton Dominik',1,0,0),('c3a0fdb2-9b99-11ef-8582-0242c0a8500a',32,'seres.bence1994@gmail.com','Seres Bence',1,0,0),('c3cd1349-9c01-11ef-8582-0242c0a8500a',38,'akos.n.2020@gmail.com','Német Ákos',1,0,0),('c678ea59-9b9b-11ef-8582-0242c0a8500a',33,'martondominik2010@gmail.com','Marton Dominik',1,0,0),('d094920c-9b60-11ef-8582-0242c0a8500a',34,'dorogizsolt78@gmail.com','Dorogi Norman',1,0,0),('d3c0c24e-9b9c-11ef-8582-0242c0a8500a',26,'tibrik.david2010@gmail.com','Tibrik Dávid',1,0,0),('d773df94-9ba1-11ef-8582-0242c0a8500a',32,'szucs.evi88@gmail.com','Botos Balázs',1,0,0),('d8b00968-9b61-11ef-8582-0242c0a8500a',33,'dorogizsolt78@gmail.com','Dorogi Norman',1,0,0),('e40834b9-9b7c-11ef-8582-0242c0a8500a',25,'vargimatix@gmail.com','teszt',1,0,1),('e45f3bf5-9b9d-11ef-8582-0242c0a8500a',32,'peterpusztai13@gmail.com','Pusztai Péter',0,0,0),('e977a80b-9b9c-11ef-8582-0242c0a8500a',33,'tibrik.david2010@gmail.com','Tibrik Dávid',1,0,0),('ed70bae1-9b99-11ef-8582-0242c0a8500a',33,'seres.bence1994@gmail.com','Seres Bence',1,0,0),('f1e3bf07-9b96-11ef-8582-0242c0a8500a',31,'aszalaiadam@deakdamo.hu','Aszalai Ádám',1,0,1),('f20f8f1b-9b7c-11ef-8582-0242c0a8500a',25,'vargimatix@gmail.com','teszt',0,0,1),('f22916d1-9b9a-11ef-8582-0242c0a8500a',32,'martondominik2010@gmail.com','Marton Dominik',1,0,0),('fc06a87b-9b90-11ef-8582-0242c0a8500a',29,'banyaismate@gmail.com','Bányai Máté',1,0,0),('fd9e183a-9ba2-11ef-8582-0242c0a8500a',34,'virzoli@gmail.com','Virágos Zoltán',1,0,0);
/*!40000 ALTER TABLE `jelentkezok` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `szakok` WRITE;
/*!40000 ALTER TABLE `szakok` DISABLE KEYS */;
INSERT INTO `szakok` VALUES (4,'Automatikai technikus'),(3,'Erősáramú elektrotechnikus'),(5,'Informatikai rendszer- és alkalmazás-üzemeltető technikus'),(8,'Közismeret'),(6,'Szoftverfejlesztő és -tesztelő'),(7,'Távközlési technikus');
/*!40000 ALTER TABLE `szakok` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `tanterem` WRITE;
/*!40000 ALTER TABLE `tanterem` DISABLE KEYS */;
INSERT INTO `tanterem` VALUES (2,'Elektronika terem',20,0),(3,'I.',36,0),(4,'Informatika I.',20,0),(5,'Informatika II.',19,0),(6,'Informatika III.',16,0),(7,'Informatika IV.',20,0),(8,'Informatika V.',20,0),(9,'Informatika VI.',20,0),(10,'Informatika VII.',20,0),(11,'Ipari elektronikai terem',12,0),(12,'IX.',30,0),(13,'Kajtor István tanterem',36,0),(14,'Könyvtár',12,0),(15,'LEGRAND KNX labor',12,0),(16,'Matek szaktanterem I.',24,0),(17,'Matek szaktanterem II.',18,0),(18,'Matek szaktanterem III.',36,0),(19,'Mechanikai műhely',24,0),(20,'MetALCOM',36,0),(21,'Nyelvi laboratórium',18,0),(22,'PLC terem',15,0),(23,'Robotika terem',20,0),(24,'Tornaterem',50,0),(25,'V.',15,0),(26,'VII.',32,0),(27,'VIII.',36,0),(28,'X.',30,0),(29,'DKA',10,0);
/*!40000 ALTER TABLE `tanterem` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `tiltottemail` WRITE;
/*!40000 ALTER TABLE `tiltottemail` DISABLE KEYS */;
INSERT INTO `tiltottemail` VALUES (1,'123mail.org'),(2,'126.com'),(3,'139.com'),(4,'150mail.com'),(5,'150ml.com'),(6,'163.com'),(7,'16mail.com'),(8,'2-mail.com'),(9,'420blaze.it'),(10,'4email.net'),(11,'50mail.com'),(12,'8chan.co'),(13,'aaathats3as.com'),(14,'airmail.cc'),(15,'airpost.net'),(16,'allmail.net'),(17,'antichef.com'),(18,'antichef.net'),(19,'bestmail.us'),(20,'bluewin.ch'),(21,'c2.hu'),(22,'cluemail.com'),(23,'cocaine.ninja'),(24,'cock.email'),(25,'cock.li'),(26,'cock.lu'),(27,'cumallover.me'),(28,'dfgh.net'),(29,'dicksinhisan.us'),(30,'dicksinmyan.us'),(31,'elitemail.org'),(32,'emailcorner.net'),(33,'emailengine.net'),(34,'emailengine.org'),(35,'emailgroups.net'),(36,'emailplus.org'),(37,'emailuser.net'),(38,'eml.cc'),(39,'f-m.fm'),(40,'fast-email.com'),(41,'fast-mail.org'),(42,'fastem.com'),(43,'fastemail.us'),(44,'fastemailer.com'),(45,'fastest.cc'),(46,'fastimap.com'),(47,'fastmail.cn'),(48,'fastmail.co.uk'),(49,'fastmail.com'),(50,'fastmail.com.au'),(51,'fastmail.es'),(52,'fastmail.fm'),(53,'fastmail.im'),(54,'fastmail.in'),(55,'fastmail.jp'),(56,'fastmail.mx'),(57,'fastmail.net'),(58,'fastmail.nl'),(59,'fastmail.se'),(60,'fastmail.to'),(61,'fastmail.tw'),(62,'fastmail.uk'),(63,'fastmail.us'),(64,'fastmailbox.net'),(65,'fastmessaging.com'),(66,'fea.st'),(67,'firemail.cc'),(68,'fmail.co.uk'),(69,'fmailbox.com'),(70,'fmgirl.com'),(71,'fmguy.com'),(72,'ftml.net'),(73,'getbackinthe.kitchen'),(74,'gmx.com'),(75,'gmx.us'),(76,'goat.si'),(77,'h-mail.us'),(78,'hailmail.net'),(79,'hitler.rocks'),(80,'horsefucker.org'),(81,'hush.ai'),(82,'hush.com'),(83,'hushmail.com'),(84,'hushmail.me'),(85,'imap-mail.com'),(86,'imap.cc'),(87,'imapmail.org'),(88,'inoutbox.com'),(89,'internet-e-mail.com'),(90,'internet-mail.org'),(91,'internetemails.net'),(92,'internetmailing.net'),(93,'jetemail.net'),(94,'justemail.net'),(95,'kakao.com'),(96,'kennedy808.com'),(97,'letterboxes.org'),(98,'liamekaens.com'),(99,'mail-central.com'),(100,'mail-page.com'),(101,'mail2world.com'),(102,'mailandftp.com'),(103,'mailas.com'),(104,'mailbolt.com'),(105,'mailc.net'),(106,'mailcan.com'),(107,'mailforce.net'),(108,'mailftp.com'),(109,'mailhaven.com'),(110,'mailingaddress.org'),(111,'mailite.com'),(112,'mailmight.com'),(113,'mailnew.com'),(114,'mailsent.net'),(115,'mailservice.ms'),(116,'mailup.net'),(117,'mailworks.org'),(118,'memeware.net'),(119,'ml1.net'),(120,'mm.st'),(121,'mozmail.com'),(122,'myfastmail.com'),(123,'mymacmail.com'),(124,'naver.com'),(125,'neverbox.com'),(126,'nigge.rs'),(127,'nospammail.net'),(128,'nus.edu.sg'),(129,'onet.pl'),(130,'ownmail.net'),(131,'petml.com'),(132,'postinbox.com'),(133,'postpro.net'),(134,'proinbox.com'),(135,'promessage.com'),(136,'qq.com'),(137,'realemail.net'),(138,'reallyfast.biz'),(139,'reallyfast.info'),(140,'recursor.net'),(141,'redchan.it'),(142,'ruffrey.com'),(143,'rushpost.com'),(144,'safe-mail.net'),(145,'sent.as'),(146,'sent.at'),(147,'sent.com'),(148,'shitposting.agency'),(149,'shitware.nl'),(150,'sibmail.com'),(151,'sneakemail.com'),(152,'snkmail.com'),(153,'snkml.com'),(154,'spamcannon.com'),(155,'spamcannon.net'),(156,'spamgourmet.com'),(157,'spamgourmet.net'),(158,'spamgourmet.org'),(159,'speedpost.net'),(160,'speedymail.org'),(161,'ssl-mail.com'),(162,'swift-mail.com'),(163,'tfwno.gf'),(164,'the-fastest.net'),(165,'the-quickest.com'),(166,'theinternetemail.com'),(167,'tweakly.net'),(168,'ubicloud.com'),(169,'veryfast.biz'),(170,'veryspeedy.net'),(171,'waifu.club'),(172,'warpmail.net'),(173,'xoxy.net'),(174,'xsmail.com'),(175,'xwaretech.com'),(176,'xwaretech.info'),(177,'xwaretech.net'),(178,'yahoo.com.ph'),(179,'yahoo.com.vn'),(180,'yeah.net'),(181,'yepmail.net'),(182,'your-mail.com');
/*!40000 ALTER TABLE `tiltottemail` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `tiltottnevek` WRITE;
/*!40000 ALTER TABLE `tiltottnevek` DISABLE KEYS */;
INSERT INTO `tiltottnevek` VALUES (236,'[ REDACTED ]'),(1,'Aberált'),(2,'Aberrált'),(3,'Abortuszmaradék'),(4,'Abszolút hülye'),(5,'Agyalágyult'),(6,'Agyatlan'),(7,'Agybatetovált'),(8,'Ágybavizelős'),(9,'Agyfasz'),(10,'Agyhalott'),(11,'Agyonkúrt'),(12,'Agyonvert'),(13,'Agyrákos'),(14,'AIDS-es'),(15,'Alapvetően fasz'),(16,'Animalsex-mániás'),(17,'Antibarom'),(18,'Aprófaszú'),(19,'Arcbarakott'),(20,'Aszaltfaszú'),(21,'Aszott'),(22,'Átbaszott'),(23,'Azt a kurva de fasz'),(24,'Balfasz'),(25,'Balfészek'),(26,'Baromfifasz'),(27,'Basz-o-matic'),(28,'Baszhatatlan'),(29,'Basznivaló'),(32,'Bazd meg'),(31,'Bazdmeg'),(30,'Bazmeg'),(33,'Bazzeg'),(34,'Bebaszott'),(35,'Befosi'),(36,'Békapicsa'),(37,'Bélböfi'),(38,'Beleiből kiforgatott'),(39,'Bélszél'),(40,'Brunya'),(41,'Büdösszájú'),(42,'Búvalbaszott'),(43,'Buzeráns'),(44,'Buzernyák'),(45,'Buzi'),(46,'Buzikurva'),(47,'Cafat'),(48,'Cafka'),(49,'Céda'),(50,'Cérnafaszú'),(51,'Cigány'),(52,'Cottonfej'),(53,'Cseszett'),(54,'Csibefasz'),(55,'Csipszar'),(56,'Csirkefaszú'),(57,'Csitri'),(58,'Csöcs'),(59,'Csöcsfej'),(60,'Csöppszar'),(61,'Csupaszfarkú'),(62,'Cuncipunci'),(63,'Deformáltfaszú'),(64,'Dekorált pofájú'),(65,'Döbbenetesen segg'),(66,'Dobseggű'),(67,'Dughatatlan'),(68,'Dunyhavalagú'),(69,'Duplafaszú'),(70,'Ebfasz'),(71,'Egyszerűen fasz'),(72,'Elbaszott'),(73,'Eleve hülye'),(74,'Extrahülye'),(75,'Fantasztikusan segg'),(76,'Fasszopó'),(77,'Fasz'),(78,'Fasz-emulátor'),(79,'Faszagyú'),(80,'Faszarc'),(81,'Faszfej'),(82,'Faszfészek'),(83,'Faszkalap'),(84,'Faszkarika'),(85,'Faszkedvelő'),(86,'Faszkópé'),(87,'Faszogány'),(88,'Faszpörgettyű'),(89,'Faszsapka'),(90,'Faszszagú'),(91,'Faszszopó'),(92,'Fasztalan'),(93,'Fasztarisznya'),(94,'Fasztengely'),(95,'Fasztolvaj'),(96,'Faszváladék'),(97,'Faszverő'),(98,'Feka'),(99,'Félrebaszott'),(100,'Félrefingott'),(101,'Félreszart'),(102,'Félribanc'),(103,'Fing'),(104,'Fölcsinált'),(105,'Fölfingott'),(106,'Fos'),(107,'Foskemence'),(108,'Fospisztoly'),(109,'Fospumpa'),(110,'Fostalicska'),(111,'Fütyi'),(112,'Fütyinyalogató'),(113,'Fütykös'),(114,'Geci'),(115,'Gecinyelő'),(116,'Geciszaró'),(117,'Geciszívó'),(118,'Genny'),(119,'Gennyesszájú'),(120,'Gennygóc'),(121,'Genyac'),(122,'Genyó'),(123,'Gólyafos'),(124,'Görbefaszú'),(125,'Gyennyszopó'),(126,'Gyíkfing'),(127,'Hájpacni'),(128,'Hatalmas nagy fasz'),(129,'Hátbabaszott'),(130,'Házikurva'),(131,'Hererákos'),(132,'Hígagyú'),(133,'Hihetetlenül fasz'),(134,'Hikomat'),(135,'Hímnőstény'),(136,'Hímringyó'),(137,'Hiperstrici'),(138,'Hitler-imádó'),(139,'Hitlerista'),(140,'Hivatásos balfasz'),(141,'Hú de segg'),(142,'Hugyagyú'),(143,'Hugyos'),(144,'Hugytócsa'),(145,'Hüje'),(146,'Hüle'),(147,'Hülye'),(148,'Hülyécske'),(149,'Hülyegyerek'),(150,'Inkubátor-szökevény'),(151,'Integrált barom'),(152,'Ionizált faszú'),(153,'IQ bajnok'),(154,'IQ fighter'),(155,'IQ hiányos'),(156,'Irdatlanul köcsög'),(157,'Íveltfaszú'),(158,'Jajj de barom'),(159,'Jókora fasz'),(160,'Kaka'),(161,'Kakamatyi'),(162,'Kaki'),(163,'Kaksi'),(164,'Kecskebaszó'),(165,'Kellően fasz'),(166,'Képlékeny faszú'),(167,'Keresve sem található fasz'),(168,'Kétfaszú'),(169,'Kétszer agyonbaszott'),(170,'Ki-bebaszott'),(171,'Kibaszott'),(172,'Kifingott'),(173,'Kiherélt'),(174,'Kikakkantott'),(175,'Kikészült'),(176,'Kimagaslóan fasz'),(177,'Kimondhatatlan pöcs'),(178,'Kis szaros'),(179,'Kisfütyi'),(180,'Klotyószagú'),(181,'Kojak-faszú'),(182,'Kopárfaszú'),(183,'Korlátolt gecizésű'),(184,'Kotonszökevény'),(185,'Középszar'),(186,'Kretén'),(187,'Kuki'),(188,'Kula'),(189,'Kunkorított faszú'),(190,'Kurva'),(191,'Kurvaanyjú'),(192,'Kurvapecér'),(193,'Kutyakaki'),(194,'Kutyapina'),(195,'Kutyaszar'),(196,'Lankadtfaszú'),(197,'Lebaszirgált'),(198,'Lebaszott'),(199,'Lecseszett'),(200,'Leírhatatlanul segg'),(201,'Lemenstruált'),(202,'Leokádott'),(203,'Lepkefing'),(204,'Leprafészek'),(205,'Leszart'),(206,'Leszbikus'),(207,'Lőcs'),(208,'Lőcsgéza'),(209,'Lófasz'),(210,'Lógócsöcsű'),(211,'Lóhugy'),(212,'Lotyó'),(213,'Lucskos'),(214,'Lugnya'),(215,'Lyukasbelű'),(216,'Lyukasfaszú'),(217,'Lyukát vakaró'),(218,'Lyuktalanított'),(219,'Mamutsegg'),(220,'Maszturbációs görcs'),(221,'Maszturbagép'),(222,'Maszturbáltatott'),(223,'Megfingatott'),(224,'Megkettyintett'),(225,'Megkúrt'),(226,'Megszopatott'),(227,'Mesterséges faszú'),(228,'Méteres kékeres'),(229,'Mikrotökű'),(230,'Mojfing'),(231,'Műfaszú'),(232,'Muff'),(233,'Multifasz'),(234,'Műtöttpofájú'),(235,'Náci'),(237,'Nikotinpatkány'),(238,'Nimfomániás'),(239,'Nuna'),(240,'Nunci'),(241,'Nuncóka'),(242,'Nyalábfasz'),(243,'Nyasgem'),(244,'Nyelestojás'),(245,'Nyúlszar'),(246,'Oltári nagy fasz'),(247,'Ondónyelő'),(248,'Orbitálisan hülye'),(249,'Ordenálé'),(250,'Összebaszott'),(251,'Ötcsillagos fasz'),(252,'Óvszerezett'),(253,'Pénisz'),(254,'Peremesfaszú'),(255,'Picsa'),(256,'Picsafej'),(257,'Picsameresztő'),(258,'Picsánnyalt'),(259,'Picsánrugott'),(260,'Picsányi'),(261,'Pina'),(262,'Pinna'),(263,'Pisa'),(264,'Pisaszagú'),(265,'Pisis'),(266,'Pöcs'),(267,'Pöcsfej'),(268,'Porbafingó'),(269,'Pornóbuzi'),(270,'Pornómániás'),(271,'Pudvás'),(272,'Pudváslikú'),(273,'Puhafaszú'),(274,'Punci'),(275,'Puncimókus'),(276,'Puncis'),(277,'Punciutáló'),(278,'Puncivirág'),(279,'Qki'),(280,'Qrva'),(281,'Qtyaszar'),(282,'Rágcsáltfaszú'),(283,'Redva'),(284,'Rendkívül fasz'),(285,'Rétó-román'),(286,'Ribanc'),(287,'Riherongy'),(288,'Rivalizáló'),(289,'Rőfös fasz'),(290,'Rojtospicsájú'),(291,'Rongyospinájú'),(292,'Roppant hülye'),(293,'Rossz kurva'),(294,'Saját nemével kefélő'),(295,'Segg'),(296,'Seggarc'),(297,'Seggdugó'),(298,'Seggfej'),(299,'Seggnyaló'),(300,'Seggszőr'),(301,'Seggtorlasz'),(302,'Strici'),(303,'Suttyó'),(304,'Sutyerák'),(305,'Szálkafaszú'),(306,'Szar'),(307,'Szaralak'),(308,'Szárazfing'),(309,'Szarbojler'),(310,'Szarcsimbók'),(311,'Szarevő'),(312,'Szarfaszú'),(313,'Szarházi'),(314,'Szarjankó'),(315,'Szarnivaló'),(316,'Szarosvalagú'),(317,'Szarrá vágott'),(318,'Szarrágó'),(319,'Szarszagú'),(320,'Szarszájú'),(321,'Szartragacs'),(322,'Szarzsák'),(323,'Szégyencsicska'),(324,'Szifiliszes'),(325,'Szivattyús kurva'),(326,'Szófosó'),(327,'Szokatlanul fasz'),(328,'Szop-o-matic'),(329,'Szopógép'),(330,'Szopógörcs'),(331,'Szopós kurva'),(332,'Szopottfarkú'),(333,'Szűklyukú'),(334,'Szúnyogfaszni'),(335,'Szuperbuzi'),(336,'Szuperkurva'),(337,'Szűzhártya-repedéses'),(338,'Szűzkurva'),(339,'Szűzpicsa'),(340,'Szűzpunci'),(341,'Tikfos'),(342,'Tikszar'),(343,'Tompatökű'),(344,'Törpefaszú'),(345,'Toszatlan'),(346,'Toszott'),(347,'Totálisan hülye'),(348,'Tyű de picsa'),(349,'Tyúkfasznyi'),(350,'Tyúkszar'),(351,'Vadfasz'),(352,'Valag'),(353,'Valagváladék'),(354,'Végbélféreg'),(355,'Xar'),(356,'Zsugorított faszú');
/*!40000 ALTER TABLE `tiltottnevek` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Huszka Adrián Gábor','hadrian','$2y$10$5ypfRlC2sPLntq2WgIPDb.n2SeQVyoDh.6Zjth8mRaLmbQl1rCL.W',0),(5,'Vincze Mihály','misi','$2y$10$mfqjsTyiguZAcp99F021vuOimK1KNBV0FVRi9hsItTwY2XW5Vnnxa',0),(7,'Ágoston Csaba',NULL,NULL,0),(8,'Bagi László',NULL,NULL,0),(9,'Bánfi János',NULL,NULL,0),(10,'Banka-Török Edit',NULL,NULL,0),(11,'Bányai Györgyi',NULL,NULL,0),(12,'Berényi Katalin',NULL,NULL,0),(13,'Faur István',NULL,NULL,0),(14,'Fehér Bertalan',NULL,NULL,0),(15,'Feke András','afeke','$2y$10$j/hmAAUj77TTaYD2iP8YC..2bii3oh5SH3PWguWmuk4mUCJGKb3Fu',0),(16,'Gila Olga',NULL,NULL,0),(17,'Hajdú Zoltán',NULL,NULL,0),(18,'Harmath Eszter',NULL,NULL,0),(19,'Kondor Csaba',NULL,NULL,0),(20,'Kovács Attila',NULL,NULL,0),(21,'Kuhn Miklós',NULL,NULL,0),(22,'Mácsai László Gergely',NULL,NULL,0),(23,'Miklós Zoltán',NULL,NULL,0),(24,'Molnár Norbert',NULL,NULL,0),(25,'Nagy Levente',NULL,NULL,0),(26,'Nagypál János',NULL,NULL,0),(27,'Niethammer Zoltán Péter',NULL,NULL,0),(28,'Ragányi-Vincze Ildikó',NULL,NULL,0),(29,'Rajosné Kozma Katalin',NULL,NULL,0),(30,'Sebők Renáta',NULL,NULL,0),(31,'Szemerédi Endre Roland',NULL,NULL,0),(32,'Szilágyi Anna',NULL,NULL,0),(33,'Szilágyiné Szabad Andrea',NULL,NULL,0),(34,'Szvetnyik Melinda',NULL,NULL,0),(35,'Vigh Attila',NULL,NULL,0),(36,'Vigh Viola',NULL,NULL,0),(37,'Máté','mate','$2y$10$Ua2PSLrHahZXdhvG8wz4geibicd1xTXzmXgbNIOmsH6RHWXXc24lm',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `versenyek` WRITE;
/*!40000 ALTER TABLE `versenyek` DISABLE KEYS */;
INSERT INTO `versenyek` VALUES (1,'Pollák Antal Járási Informatika Verseny','','Korcsoport: 5-8. osztály','2024-11-20 13:30:00','2024-11-17 23:59:59',0,'PAJIV_2024_jelentkezes.png','2024-10-25 10:22:39');
/*!40000 ALTER TABLE `versenyek` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `versenyjelentkezok` WRITE;
/*!40000 ALTER TABLE `versenyjelentkezok` DISABLE KEYS */;
INSERT INTO `versenyjelentkezok` VALUES (4,NULL,'Hingl Zsombor','hingl.zsombor@koszta-szentes.hu','Lucza László',4,8,1,0,0,0);
/*!40000 ALTER TABLE `versenyjelentkezok` ENABLE KEYS */;
UNLOCK TABLES;

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
