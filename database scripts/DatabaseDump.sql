-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: webdevfinalproject
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `bookingId` int NOT NULL AUTO_INCREMENT,
  `catId` int NOT NULL,
  `clientId` int NOT NULL,
  `employeeId` int NOT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`bookingId`),
  KEY `catId` (`catId`),
  KEY `clientId` (`clientId`),
  KEY `employeeId` (`employeeId`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `cats` (`catId`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`),
  CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`employeeId`) REFERENCES `employees` (`employeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,1,1,'2025-02-15 17:30:00'),(2,2,1,1,'2025-03-19 10:55:00'),(3,1,1,1,'2025-03-31 11:12:00'),(30,1,2,2,'2025-03-07 19:29:00'),(32,1,2,1,'2025-04-18 23:13:00');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cats` (
  `catId` int NOT NULL AUTO_INCREMENT,
  `image` varchar(200) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `breed` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `weight` double NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `inboundDate` date NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cats`
--

LOCK TABLES `cats` WRITE;
/*!40000 ALTER TABLE `cats` DISABLE KEYS */;
INSERT INTO `cats` VALUES (1,'images/img1.jpg','Lala',2,'Female','Maine Coon','Silver Tabby',4.75,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec scelerisque velit, vel aliquet tortor. \nVestibulum et euismod ante, maximus tincidunt odio. Suspendisse sodales scelerisque lacinia. Praesent mi \nlibero, molestie sed orci nec, luctus auctor mi. Maecenas in nisi eget enim vulputate convallis id quis purus. \nNam tempus iaculis elementum.','2025-03-19'),(2,'images/img2.jpg','Darry',5,'Male','Maine Coon','Silver Tabby',5,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec scelerisque velit, vel aliquet tortor. \nVestibulum et euismod ante, maximus tincidunt odio. Suspendisse sodales scelerisque lacinia. Praesent mi \nlibero, molestie sed orci nec, luctus auctor mi. Maecenas in nisi eget enim vulputate convallis id quis purus. \nNam tempus iaculis elementum.','2025-03-19'),(4,'images/img3.jpg','Bob',1,'Male','English','Black',3.5,'Distinct english gentleman','2024-05-03'),(11,'images/img4.jpg','Marmaduke',1,'Male','No','Stainy',0.8,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-24'),(12,'images/img5.jpg','Spencer',7,'Male','Birman','Tabby',3.9,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-17'),(13,'images/img6.jpg','Hank',4,'Male','british shorthair','cinnamon',3.2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-01'),(14,'images/img7.jpg','Piglet',1,'Female','Birman','Cream',1.7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-10'),(15,'images/img8.jpg','Sheba',2,'Female','Abyssinian','Tabby',3.3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-31'),(16,'images/img9.jpg','Poco',4,'Female','Devon Rex','Orange',3.9,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-25'),(17,'images/img10.gif','Cabrimi',3,'Female','No','Black',3.5,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-22'),(18,'images/img11.jpeg','Gleep glorp',67,'Male','No','Green',250,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2029-05-26'),(19,'images/img12.jpeg','Chichinderyk',2,'Male','No','Black',3.7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-15'),(20,'images/img13.jpg','Peppa',1,'Female','Bengal','Brown',1.6,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-10'),(21,'images/img14.jpg','Ziggy',7,'Female','Burmese','brown',2.3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-02-24'),(22,'images/img15.jpg','Cookie',2,'Male','Burmilla','White',4.1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-05'),(23,'images/img17.jpeg','Miata',4,'Female','Cornish Rex','White and black',4.7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-04-02'),(24,'images/img16.jpeg','Garfield',9,'Male','No','Orange',7.6,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','2025-03-29');
/*!40000 ALTER TABLE `cats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `clientId` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phoneNum` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`clientId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'client@gmail.com','qwerty','Bob','0874783321','3828 Piermont Dr, Albuquerque, NM'),(2,'email@gmail.com','pass','Andryi','0877606444','w43kd41'),(4,'email1@gmail.com','e','Illia Stefanovskyi','0877606444','11 Fortress Village Run'),(5,'email2@gmail.com','2','Illia Stefanovskyi','0877606444','11 Fortress Village Run'),(6,'email3@gmail.com','t','Illia Stefanovskyi','0877606444','11 Fortress Village Run'),(7,'email4@gmail.com','pass','wq','2323','weew');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `employeeId` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `jobTitle` varchar(45) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `managerId` int NOT NULL,
  PRIMARY KEY (`employeeId`),
  UNIQUE KEY `email` (`email`),
  KEY `managerId` (`managerId`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`managerId`) REFERENCES `managers` (`managerId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'employee@gmail.com','qwerty','John Dobs','Assistant','0874653528',1),(2,'employee1@gmail.com','qwerty','Lincoln Johnston','Assistant','0383728332',1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `managers` (
  `managerId` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  PRIMARY KEY (`managerId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES (1,'manager@gmail.com','qwerty','Luke Kscheshov','0874300435');
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rescues`
--

DROP TABLE IF EXISTS `rescues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rescues` (
  `rescueId` int NOT NULL AUTO_INCREMENT,
  `clientId` int NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `desCatName` varchar(45) DEFAULT NULL,
  `descriptionOfCat` varchar(10000) NOT NULL,
  `descriptionOfEvent` varchar(1000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rescueId`),
  KEY `clientId` (`clientId`),
  CONSTRAINT `rescues_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rescues`
--

LOCK TABLES `rescues` WRITE;
/*!40000 ALTER TABLE `rescues` DISABLE KEYS */;
INSERT INTO `rescues` VALUES (7,2,'Albukerque','2025-03-25','Larry','The evil thing','Chamber mulfunction','approved'),(12,2,'Vasylkiv','2025-04-25','Lalo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare.','--','Pending'),(13,2,'Wicklow','2025-04-25','John','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec magna suscipit finibus et sed ex. Phasellus id bibendum massa, vel tempus diam. Ut sit amet sagittis odio. Ut at orci nisi. Aliquam hendrerit pellentesque velit, euismod luctus lorem aliquet non. Donec id tempus lorem, a aliquet felis. Morbi tempus congue ornare','Pending');
/*!40000 ALTER TABLE `rescues` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25 23:56:27
