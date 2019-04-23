-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: shareride
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `available_rides`
--

DROP TABLE IF EXISTS `available_rides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `available_rides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_available_rides_rides1_idx` (`ride_id`),
  CONSTRAINT `fk_available_rides_rides1` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `available_rides`
--

LOCK TABLES `available_rides` WRITE;
/*!40000 ALTER TABLE `available_rides` DISABLE KEYS */;
/*!40000 ALTER TABLE `available_rides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `identification_no` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_driver_users1_idx` (`user_id`),
  CONSTRAINT `fk_driver_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rides`
--

DROP TABLE IF EXISTS `rides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `origin` varchar(200) NOT NULL,
  `departure` varchar(200) NOT NULL,
  `capacity_of_vehicle` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rides`
--

LOCK TABLES `rides` WRITE;
/*!40000 ALTER TABLE `rides` DISABLE KEYS */;
INSERT INTO `rides` VALUES (1,'shannelle',719582000,'utawala','westlands','2',NULL,NULL,NULL),(5,'sean',719582000,'cbd','upperhill','5',NULL,NULL,NULL),(6,'one',712345678,'cbd','upperhill','56',NULL,NULL,NULL);
/*!40000 ALTER TABLE `rides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_booking_ride_details`
--

DROP TABLE IF EXISTS `user_booking_ride_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_booking_ride_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `available_ride_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_booking_ride_details_user1_idx` (`user_id`),
  KEY `fk_user_booking_ride_details_available_rides1_idx` (`available_ride_id`),
  CONSTRAINT `fk_user_booking_ride_details_available_rides1` FOREIGN KEY (`available_ride_id`) REFERENCES `available_rides` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_booking_ride_details_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_booking_ride_details`
--

LOCK TABLES `user_booking_ride_details` WRITE;
/*!40000 ALTER TABLE `user_booking_ride_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_booking_ride_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ride_assignment`
--

DROP TABLE IF EXISTS `user_ride_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_ride_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ride_assignment id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ride_assignment`
--

LOCK TABLES `user_ride_assignment` WRITE;
/*!40000 ALTER TABLE `user_ride_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ride_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'driver',NULL,NULL),(2,'client',NULL,NULL);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `confirm_password` varchar(200) NOT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_user_type1_idx` (`user_type_id`),
  CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'\"mee\"','\"mee\"','\"mee@gmail.com\"','\"e10adc3949ba59abbe56e057f20f883e\"','\"123456\"',NULL,NULL,NULL,NULL),(2,'\"mee\"','\"mee\"','\"mee@gmail.com\"','\"e10adc3949ba59abbe56e057f20f883e\"','\"123456\"',NULL,NULL,NULL,NULL),(3,'\"sean\"','\"sean\"','\"sean@gmail.com\"','\"e10adc3949ba59abbe56e057f20f883e\"','\"e10adc3949ba59abbe56e057f20f883e\"',NULL,NULL,NULL,NULL),(4,'shanny','baby','shanny@gmail.com','ad6136dbb947be526498c75171bb603d','ad6136dbb947be526498c75171bb603d',NULL,NULL,NULL,NULL),(5,'test','test','test@gmail.com','098f6bcd4621d373cade4e832627b4f6','098f6bcd4621d373cade4e832627b4f6',NULL,NULL,NULL,NULL),(6,'kiboi','em','em@gmail.com','c82dd414deb57467afbe564f9c57031d','243e61e9410a9f577d2d662c67025ee9',NULL,NULL,NULL,NULL),(7,'susan','muraya','susanm@gmail.com','c82dd414deb57467afbe564f9c57031d','243e61e9410a9f577d2d662c67025ee9',NULL,NULL,NULL,NULL),(8,'val','muthoni','val@gmail.com','c82dd414deb57467afbe564f9c57031d','243e61e9410a9f577d2d662c67025ee9',NULL,NULL,NULL,NULL),(9,'bradly','juma','bradly@gmail.com','c82dd414deb57467afbe564f9c57031d','243e61e9410a9f577d2d662c67025ee9',NULL,NULL,NULL,NULL),(10,'luis','bb','luis@gmail.com','c82dd414deb57467afbe564f9c57031d','243e61e9410a9f577d2d662c67025ee9',NULL,NULL,NULL,NULL),(11,'elle','wam','elle@gmail.com','1788613c5e5fb7a405c2b96b493881d2','243e61e9410a9f577d2d662c67025ee9',2,NULL,NULL,NULL),(12,'shanny','wamaitha','shannywam@gmail.com','1788613c5e5fb7a405c2b96b493881d2','243e61e9410a9f577d2d662c67025ee9',2,NULL,NULL,NULL);
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

-- Dump completed on 2019-04-23 19:52:29
