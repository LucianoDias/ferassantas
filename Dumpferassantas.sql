-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: dealership
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.18.04.1

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_brand`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'CHEVROLET'),(2,'FIAT'),(3,'FORD'),(4,'HONDA');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `year` varchar(4) NOT NULL,
  `price` float NOT NULL,
  `brand_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (2,'Carro','2016',10000,4,1,11),(3,'Semi novo luciano','2020',40000,2,3,5),(4,'Novo  semmm luciano dias','2020',12000,4,3,11),(6,'novo demias','2020',12000,3,3,8),(7,'Carro totalmente completo zero km','2121',11000,4,1,12),(8,'zero bala','2016',250000,3,3,8),(9,'Semi novo agora','2010',200000,2,2,5),(10,'Zero km','2001',55000,2,1,6),(11,'agora hoje','2121',1000000,2,3,4),(12,'teste ','2020',2000000,3,3,9),(13,'','2001',20000,3,1,8),(16,'lujciano dias ','71',1000000,4,1,12),(18,'lujciano dias ','71',1000000,4,1,12),(24,'','2020',9,1,1,2);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars_imagens`
--

DROP TABLE IF EXISTS `cars_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars_imagens` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_imagem`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars_imagens`
--

LOCK TABLES `cars_imagens` WRITE;
/*!40000 ALTER TABLE `cars_imagens` DISABLE KEYS */;
INSERT INTO `cars_imagens` VALUES (12,2,'820ac3a0f604ecab6da6eb730bacb9e2.jpg'),(13,2,'5bfcbd042e3c075b241c7c746b98feb2.jpg'),(14,2,'b8f71c38e339e2439e683b3741bdf3fa.jpg'),(15,3,'c33e0b2264a53b384b69c83233d5d5da.jpg'),(16,3,'439ed3b18a6631c1a468ec4eb982347a.jpg'),(17,3,'ec221c5e6616a31fca15e6f9089ea87e.jpg');
/*!40000 ALTER TABLE `cars_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id_model` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`id_model`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'CORSA',1),(2,'CELTA',1),(3,'ONIX',1),(4,'PUNTO',2),(5,'SIENA',2),(6,'UNO',2),(7,'FOCUS',3),(8,'ECOSPORT',3),(9,'FIESTA',3),(10,'FIT',4),(11,'CIVIC',4),(12,'HR-V',4);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Bruno','programacaoonaweb@gmail.com','Programar@10','(031) 6464-64'),(2,'Servers','sistema@gmail.com','e10adc3949ba59abbe56e057f20f883e','(031) 6464-6464');
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

-- Dump completed on 2020-08-21  9:51:05
