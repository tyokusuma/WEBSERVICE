-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: bang_sini_bang
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.2

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
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ads_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `click_count` int(10) unsigned DEFAULT NULL,
  `showing_count` int(10) unsigned DEFAULT NULL,
  `choosen` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisements`
--

LOCK TABLES `advertisements` WRITE;
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
INSERT INTO `advertisements` VALUES (1,'1.jpg',7,4,'0','2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(2,'1.jpg',35,1,'0','2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(3,'1.jpg',35,1,'0','2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(4,'1.jpg',21,1,'0','2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(5,'1.jpg',12,3,'0','2017-09-15 17:18:29','2017-09-15 17:18:29',NULL);
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `armadas`
--

DROP TABLE IF EXISTS `armadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armadas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_driver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_platenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armadas`
--

LOCK TABLES `armadas` WRITE;
/*!40000 ALTER TABLE `armadas` DISABLE KEYS */;
INSERT INTO `armadas` VALUES (1,'blue bird','BB1','dixie bins','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(2,'blue bird','BB1','mrs. jazlyn kuvalis','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(3,'blue bird','BB1','aileen kemmer','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(4,'blue bird','BB1','prof. joseph cummerata v','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(5,'blue bird','BB1','robyn fay','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(6,'blue bird','BB1','fritz murazik','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(7,'blue bird','BB1','kellen mayer','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(8,'blue bird','BB1','axel towne','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(9,'blue bird','BB1','dr. jason jast','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29'),(10,'blue bird','BB1','laney adams','B 1234 OK','2017-09-15 17:18:29','2017-09-15 17:18:29');
/*!40000 ALTER TABLE `armadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_description` longtext COLLATE utf8mb4_unicode_ci,
  `admin_created` int(10) unsigned NOT NULL,
  `admin_updated` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'kendaraan','taksi','gemah ripah','taksi',NULL,NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(2,'pedagang','abang','nasi goreng','nasi goreng',101,101,'2017-09-15 17:23:02','2017-09-15 17:23:02',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` int(10) unsigned NOT NULL,
  `name_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_province_id_foreign` (`province_id`),
  CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,1,'bandung',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `f_c_ms`
--

DROP TABLE IF EXISTS `f_c_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `f_c_ms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fcm_registration_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `f_c_ms_fcm_registration_token_unique` (`fcm_registration_token`),
  UNIQUE KEY `f_c_ms_user_id_unique` (`user_id`),
  CONSTRAINT `f_c_ms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `f_c_ms`
--

LOCK TABLES `f_c_ms` WRITE;
/*!40000 ALTER TABLE `f_c_ms` DISABLE KEYS */;
INSERT INTO `f_c_ms` VALUES (1,'dsq3yElx8pQ:APA91bFeL18hcNUy3EOc0bHiDxtI1d16kDjlGDbZcGLNptNBSEZhupr2VmKGBcXNuru75LaPAzNbUAAjL5DleKrVAU_uS9ZdXr6xiRTafNff79HTsfuHathUPSf6BjiJj0actw60ydVs',101,'2017-09-15 17:18:31','2017-09-15 17:18:31',NULL);
/*!40000 ALTER TABLE `f_c_ms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` int(10) unsigned NOT NULL,
  `main_service_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_buyer_id_foreign` (`buyer_id`),
  KEY `favorites_main_service_id_foreign` (`main_service_id`),
  KEY `favorites_category_id_foreign` (`category_id`),
  CONSTRAINT `favorites_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `favorites_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `favorites_main_service_id_foreign` FOREIGN KEY (`main_service_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,2,74,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(2,1,94,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(3,74,15,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(4,19,95,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(5,93,3,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(6,69,62,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(7,49,3,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(8,95,23,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(9,18,51,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(10,62,81,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(11,15,47,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(12,37,68,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(13,85,24,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(14,19,30,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(15,73,14,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(16,98,1,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(17,20,81,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(18,67,47,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(19,12,91,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(20,19,24,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(21,1,23,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(22,66,14,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(23,43,74,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(24,32,1,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(25,14,94,1,'2017-09-15 17:18:28','2017-09-15 17:18:28'),(26,87,91,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(27,67,1,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(28,17,26,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(29,64,94,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(30,94,0,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(31,29,74,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(32,94,55,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(33,66,28,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(34,88,98,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(35,18,26,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(36,47,15,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(37,12,25,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(38,56,54,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(39,39,94,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(40,86,3,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(41,44,55,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(42,6,92,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(43,99,9,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(44,55,7,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(45,88,62,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(46,54,98,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(47,87,9,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(48,96,92,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(49,81,74,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(50,91,14,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(51,55,92,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(52,88,91,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(53,40,14,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(54,42,87,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(55,11,98,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(56,26,95,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(57,23,98,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(58,48,23,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(59,25,62,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(60,99,47,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(61,20,68,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(62,17,7,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(63,63,81,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(64,69,74,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(65,41,87,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(66,13,3,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(67,23,47,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(68,20,3,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(69,36,25,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(70,90,40,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(71,57,81,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(72,1,9,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(73,63,40,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(74,35,14,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(75,29,51,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(76,86,40,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(77,51,15,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(78,84,47,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(79,83,68,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(80,76,94,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(81,97,23,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(82,69,19,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(83,9,54,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(84,22,87,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(85,61,1,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(86,22,23,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(87,45,40,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(88,38,92,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(89,69,1,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(90,34,9,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(91,46,35,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(92,42,94,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(93,40,51,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(94,77,25,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(95,4,24,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(96,12,47,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(97,81,1,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(98,20,74,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(99,91,95,1,'2017-09-15 17:18:29','2017-09-15 17:18:29'),(100,37,23,1,'2017-09-15 17:18:29','2017-09-15 17:18:29');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graphics`
--

DROP TABLE IF EXISTS `graphics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graphics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `count_created` int(10) unsigned NOT NULL,
  `count_cancel` int(10) unsigned NOT NULL,
  `count_success` int(10) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `graphics_user_id_foreign` (`user_id`),
  CONSTRAINT `graphics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graphics`
--

LOCK TABLES `graphics` WRITE;
/*!40000 ALTER TABLE `graphics` DISABLE KEYS */;
/*!40000 ALTER TABLE `graphics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_details`
--

DROP TABLE IF EXISTS `message_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_admin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_user` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_by_admin` int(10) unsigned DEFAULT NULL,
  `deleted_by_user` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_details_message_id_foreign` (`message_id`),
  CONSTRAINT `message_details_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_details`
--

LOCK TABLES `message_details` WRITE;
/*!40000 ALTER TABLE `message_details` DISABLE KEYS */;
INSERT INTO `message_details` VALUES (1,6,0,1,'voluptatibus ut reiciendis est alias voluptatem. quos quidem minima harum sint voluptatibus quia cupiditate. ex ut molestias dolor blanditiis.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(2,6,0,1,'voluptatem a praesentium non iure. velit nisi aut nulla eos et maxime quam. quaerat magni est fuga quo velit et. beatae ab blanditiis quo nisi eligendi.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(3,6,0,1,'mollitia ullam est ut voluptates dolorum rem. esse unde distinctio et tempora sit velit. eos quo dicta modi at qui et. magnam adipisci inventore ut.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(4,6,0,1,'vel expedita veniam sapiente quia. sed omnis enim magni laboriosam vero sint. maiores voluptatum est sit nihil sed. non unde aut magni saepe amet tenetur dolor maxime. ut voluptas minima soluta molestias in incidunt est.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(5,6,0,1,'quam accusamus alias vitae. dignissimos aut officiis in modi distinctio. id et eaque voluptatem blanditiis. dolorem in fugiat qui et.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(6,6,0,1,'consequatur odit a omnis iure. sunt aut est voluptatem quam dolor eos corrupti. autem maiores neque tempora autem.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(7,6,0,1,'ab adipisci sed commodi inventore id quidem. ullam placeat pariatur omnis culpa. accusantium accusantium repellat dolor laborum esse.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(8,6,0,1,'possimus quia cumque debitis provident. magni quia dolorem quo earum. sapiente possimus molestias qui aperiam facere molestias tenetur. voluptate laudantium vitae explicabo et.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(9,6,0,1,'id quia ut provident hic. doloremque et quam esse quo pariatur quia. et ut quo similique mollitia pariatur.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(10,6,0,1,'ullam atque sint qui. odio nihil qui deserunt et aut tenetur nam. quos aliquam aut repellat est soluta.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(11,6,0,1,'repudiandae incidunt dolores dolor rem non dolorem officia dolorum. quia eligendi doloribus nihil temporibus ut. dolore et ut iusto ipsa voluptas.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(12,6,0,1,'laudantium tenetur id in. voluptatem qui in ut veniam dolore iure nemo. corrupti fuga incidunt sed cum est provident minima.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(13,6,0,1,'quia consectetur ut autem soluta architecto temporibus ea. ipsam repellendus dolorem non id consequuntur reiciendis. quis ad corrupti deserunt omnis.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(14,6,0,1,'voluptas aut itaque sed dolorem et non veritatis quod. quo numquam assumenda ex aut. sunt consectetur quibusdam dolor sit et assumenda aut. ratione molestias qui omnis est est.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(15,6,0,1,'nihil dolor autem numquam dicta libero qui consequuntur. ex pariatur unde in sint quia. delectus praesentium cum sed itaque molestiae. id qui aliquam in consequatur reiciendis fuga sed consequatur.',NULL,'0','0',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL);
/*!40000 ALTER TABLE `message_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_admin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_user` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `deleted_by_admin` int(10) unsigned DEFAULT NULL,
  `deleted_by_user` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,3,'id iure sint et voluptate cum.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(2,2,'ut debitis dolorem sit iusto.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(3,2,'et cum dignissimos repellat et quis eos debitis.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(4,4,'rerum ut tenetur provident rerum dolore totam quia.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(5,4,'omnis et atque sint quia quia laboriosam voluptatum.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(6,1,'suscipit consequuntur possimus occaecati suscipit ea.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(7,2,'delectus tempora molestiae explicabo ea occaecati inventore.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(8,2,'illo vitae aut culpa inventore non tempore.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(9,3,'deserunt et hic vero vel consequuntur aut voluptatem.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL),(10,1,'quam sunt necessitatibus in qui voluptatem.','0','0',NULL,NULL,NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29',NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (105,'2014_10_12_000000_create_provinces_table',1),(106,'2014_10_12_000001_create_cities_table',1),(107,'2014_10_12_000003_create_users_table',1),(108,'2014_10_12_100000_create_password_resets_table',1),(109,'2016_06_01_000001_create_oauth_auth_codes_table',1),(110,'2016_06_01_000002_create_oauth_access_tokens_table',1),(111,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(112,'2016_06_01_000004_create_oauth_clients_table',1),(113,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(114,'2017_06_04_021612_create_categories_table',1),(115,'2017_06_05_022011_create_services_table',1),(116,'2017_06_06_012702_create_transactions_table',1),(117,'2017_06_06_083045_create_favorites_table',1),(118,'2017_06_20_144459_create_permission_tables',1),(119,'2017_07_11_151621_create_messages_table',1),(120,'2017_07_11_214823_create_armadas_table',1),(121,'2017_07_12_112037_create_message_details_table',1),(122,'2017_07_14_093734_create_others_table',1),(123,'2017_07_14_132449_create_advertisements_table',1),(124,'2017_07_20_155325_create_notifications_table',1),(125,'2017_07_28_175236_create_graphics_table',1),(126,'2017_07_30_122737_create_banks_table',1),(127,'2017_08_10_162221_create_terms_table',1),(128,'2017_08_30_003657_create_payments_table',1),(129,'2017_08_31_084157_create_f_c_ms_table',1),(130,'2017_09_06_152309_create_tags_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('2992773bff0edeb7b82ce38bb894d653d3531e6ee7a37fe534e2da6f010b8e729c805a54265abd6c',101,1,NULL,'[]',0,'2017-09-15 17:21:01','2017-09-15 17:21:01','2018-09-15 17:21:01'),('38abcab664d61ea579b31870a32528fabe1ab340da0b0635793225057e715fdab58cfee2889c7903',102,1,NULL,'[]',0,'2017-09-15 17:21:33','2017-09-15 17:21:33','2018-09-15 17:21:33'),('e501d4edfbb14bb71646ae7aa4cf3a1cca473f886b3b90a58abb17390f180f95e1d2031744cdc008',103,1,NULL,'[]',0,'2017-09-15 17:21:47','2017-09-15 17:21:47','2018-09-15 17:21:47');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'password','Kxk8JBWyChLbyVjyHxZyjtfQCpXDvKgSr3x0VK0G','http://localhost',0,1,0,'2017-09-15 17:18:51','2017-09-15 17:18:51');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES ('1e0602ebad53b1a00e838515d8707f3114e1187aa0a4cb28d1d0e5955b795b33f6440ac4ef0bc7bc','e501d4edfbb14bb71646ae7aa4cf3a1cca473f886b3b90a58abb17390f180f95e1d2031744cdc008',0,'2018-09-15 17:21:47'),('29948d7267f4b32ab80b63dd39eb3e294b41d5421b40845a824dc2eb18fc02fd987f0cde7b7c6b39','2992773bff0edeb7b82ce38bb894d653d3531e6ee7a37fe534e2da6f010b8e729c805a54265abd6c',0,'2018-09-15 17:21:01'),('4223142bd921e855318faa3e82f280c51668400fb4831d35128fe20d73390978befab4376384bd18','38abcab664d61ea579b31870a32528fabe1ab340da0b0635793225057e715fdab58cfee2889c7903',0,'2018-09-15 17:21:33');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `others`
--

DROP TABLE IF EXISTS `others`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invite_friends` int(10) unsigned NOT NULL,
  `trial_days` int(10) unsigned NOT NULL,
  `share_days` int(10) unsigned NOT NULL,
  `buying_days` int(10) unsigned NOT NULL,
  `price_year_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_full_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_year_service` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_full_service` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `others`
--

LOCK TABLES `others` WRITE;
/*!40000 ALTER TABLE `others` DISABLE KEYS */;
INSERT INTO `others` VALUES (1,10,60,90,365,'275000','300000','375000','450000',NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29');
/*!40000 ALTER TABLE `others` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `total_payment` int(10) unsigned NOT NULL,
  `code_payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apps_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `payment_verified` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_bank_id_foreign` (`bank_id`),
  CONSTRAINT `payments_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'jawa barat',NULL,NULL,'2017-09-15 17:18:29','2017-09-15 17:18:29');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main_service_id` int(10) unsigned NOT NULL,
  `service_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sim_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stnk_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_platenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_service` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `armada` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_driver` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `rating` double(11,6) NOT NULL DEFAULT '0.000000',
  `rating_total` double(11,6) NOT NULL DEFAULT '0.000000',
  `rating_transactions_total` double(11,6) NOT NULL DEFAULT '0.000000',
  `location_abang` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_shop` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `old_expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_main_service_id_unique` (`main_service_id`),
  KEY `services_category_id_foreign` (`category_id`),
  CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `services_main_service_id_foreign` FOREIGN KEY (`main_service_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,94,'C4SrpwrWuwq','1.jpg','2.jpg','3.jpg','4.jpg','cuvs7uhS','1','ut','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(2,92,'ckxEbhTxzmC','1.jpg','2.jpg','3.jpg','4.jpg','Fr91vlaB','1','nam','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(3,3,'VR7UAdMuUvX','1.jpg','2.jpg','3.jpg','4.jpg','EO4pN6Mo','1','eius','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(4,54,'uIxqVB5WanO','1.jpg','2.jpg','3.jpg','4.jpg','ZuEmYMZu','1','in','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(5,40,'DKpbSaGW0E1','1.jpg','2.jpg','3.jpg','4.jpg','8eFC73Ix','1','ratione','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(6,25,'TpVSCSzG6tM','1.jpg','2.jpg','3.jpg','4.jpg','KF98cxxw','1','eum','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(7,28,'R0UJXpDdd74','1.jpg','2.jpg','3.jpg','4.jpg','e4x8a23O','1','voluptas','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(8,14,'MxZs0wvThpw','1.jpg','2.jpg','3.jpg','4.jpg','n7oWwoiA','1','odit','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(9,24,'H2p5KQdzniE','1.jpg','2.jpg','3.jpg','4.jpg','PPVEiES3','1','nihil','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(10,9,'f5dnvs5prkV','1.jpg','2.jpg','3.jpg','4.jpg','GsVDITKB','1','veniam','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(11,1,'vWIExtYD372','1.jpg','2.jpg','3.jpg','4.jpg','xAI6XW46','1','voluptatem','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(12,81,'jT0nVg8cszu','1.jpg','2.jpg','3.jpg','4.jpg','j7G5TfIn','1','consequuntur','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(13,68,'eYvRVBxnq3S','1.jpg','2.jpg','3.jpg','4.jpg','O8bU7sGD','1','aut','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(14,98,'UFWa1ByHQCz','1.jpg','2.jpg','3.jpg','4.jpg','maxAoqjv','1','est','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(15,47,'G3NQd17ZeqX','1.jpg','2.jpg','3.jpg','4.jpg','5X1OhoOd','1','consequatur','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(16,15,'1JKwT2D1sbX','1.jpg','2.jpg','3.jpg','4.jpg','GLH7vStY','1','nihil','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(17,26,'YlQPyM8HX16','1.jpg','2.jpg','3.jpg','4.jpg','oohuDb7z','1','distinctio','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(18,87,'NHd04je5ylW','1.jpg','2.jpg','3.jpg','4.jpg','n7SzlV8M','1','id','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(19,35,'EkB5tjjXcF9','1.jpg','2.jpg','3.jpg','4.jpg','0JX6KoRr','1','nobis','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(20,0,'ctegz77l2La','1.jpg','2.jpg','3.jpg','4.jpg','SwNqZ6PH','1','alias','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(21,74,'eryKbfWskd7','1.jpg','2.jpg','3.jpg','4.jpg','PFa56FuD','1','in','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(22,51,'dVJVF35YM1E','1.jpg','2.jpg','3.jpg','4.jpg','n4D4iuhG','1','molestiae','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(23,19,'GhsGJOj5wkx','1.jpg','2.jpg','3.jpg','4.jpg','U0kVACIm','1','sit','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(24,91,'7A1kEwl0I4D','1.jpg','2.jpg','3.jpg','4.jpg','GhRJEGDu','1','porro','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(25,7,'PHGWdZLoWYf','1.jpg','2.jpg','3.jpg','4.jpg','D942lXOK','1','sunt','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(26,55,'xcfSXRhB0yO','1.jpg','2.jpg','3.jpg','4.jpg','6ttWiLqV','1','officia','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(27,30,'SBuOzUy55lO','1.jpg','2.jpg','3.jpg','4.jpg','FH1yXck9','1','quos','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(28,95,'QuXWFp5nfIS','1.jpg','2.jpg','3.jpg','4.jpg','ACdqAIww','1','maiores','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(29,62,'AFpUFSkjsPp','1.jpg','2.jpg','3.jpg','4.jpg','qZfC5zrc','1','libero','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'1',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(30,23,'qojPGh8InDj','1.jpg','2.jpg','3.jpg','4.jpg','QM7nQM68','1','qui','1',NULL,NULL,1,0.000000,0.000000,0.000000,NULL,'0',NULL,NULL,'2017-11-14 17:18:28',NULL,'2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(31,102,'ABNAS000001','MNpBZGxSlabiPrBAdHlyeOR8dmJ7KpWbhbicIMNa.jpeg',NULL,NULL,'WC7pDwAaAnObG73mnGTy6UGgeEENWEfG9me1E0q8.jpeg',NULL,'0',NULL,'1','0','0',2,0.000000,0.000000,0.000000,'0','0',NULL,NULL,'2017-11-14 17:23:55',NULL,'2017-09-15 17:23:55','2017-09-15 17:23:55',NULL),(32,103,'TAGEM000001','kTP0CrpPsgvaUkkBBhBioP9ymE195vWLw3fW886V.jpeg','oiRY23AaRPT1fvh2AqesgAOyzETLbNt0gTMbYCwB.jpeg','2VeZveqmG24T1lMSx6zVeLiZbCrqFYZTXWvNn6I5.jpeg','qy6by7EX6i9JHFXv49nBYGHhFrp5l4RTIC9angUt.jpeg','ok 1234 jek','0','honda city','1','0','GJ-0001',1,0.000000,0.000000,0.000000,'0','0',NULL,NULL,'2017-11-14 17:24:28',NULL,'2017-09-15 17:24:28','2017-09-15 17:24:28',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'nasi goreng','2017-09-15 17:22:36','2017-09-15 17:22:36'),(2,'taksi','2017-09-15 17:22:45','2017-09-15 17:22:45');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_created` int(10) unsigned NOT NULL,
  `admin_updated` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main_service_id` int(10) unsigned NOT NULL,
  `buyer_id` int(10) unsigned NOT NULL,
  `order_code` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `status_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satisfaction_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `current_destination` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_destination` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude_current` double(11,6) NOT NULL,
  `longitude_current` double(11,6) NOT NULL,
  `latitude_destination` double(11,6) NOT NULL,
  `longitude_destination` double(11,6) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traveling_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimation_time_start` datetime DEFAULT NULL,
  `estimation_time_end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_buyer_id_foreign` (`buyer_id`),
  KEY `transactions_main_service_id_foreign` (`main_service_id`),
  CONSTRAINT `transactions_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_main_service_id_foreign` FOREIGN KEY (`main_service_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,94,72,'90868210','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'870 Kihn Field Suite 710','743 Greenfelder Dale',-78.882296,-97.910822,20.236947,-47.132329,NULL,'81.07','370','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(2,51,38,'05121441','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'918 Mustafa Hill Apt. 275','8991 Goodwin Brooks',-81.759855,-161.465948,-5.220116,-137.485565,NULL,'58.69','33','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(3,81,67,'10272484','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'12928 Torphy Islands','841 Jamal Stream Apt. 118',-3.954503,163.262826,11.501700,-5.657198,NULL,'15.57','112','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(4,91,57,'39289953','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'521 Wendell Meadow','818 Rath Estate',-83.950357,131.407027,-68.515243,148.029113,NULL,'18.45','872','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(5,15,72,'38795970','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'589 Lemke Streets','28732 Cormier Forks Apt. 258',83.658666,-9.364079,85.109752,167.705382,NULL,'53.2','158','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(6,15,89,'65869022','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'1849 Nya Creek Apt. 417','36149 Heaney Dam',62.669116,38.101767,-40.293916,15.082715,NULL,'47.27','212','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(7,9,67,'30749249','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'582 Nick Port Suite 501','253 Schumm Harbors Suite 463',-8.000698,-74.687595,4.940665,-122.004254,NULL,'45.87','609','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(8,30,80,'56816222','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'7006 Sonia Loaf Suite 602','7499 Stracke Dam',83.219955,134.321972,39.762023,-177.403521,NULL,'87.5','300','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(9,28,83,'08234861','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'8986 Graham Glens','91284 Jacobs Junction Apt. 897',15.524079,36.311071,-29.374885,-134.019302,NULL,'90.87','459','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(10,98,49,'18230077','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'6547 Jaylan Crossing Apt. 321','39409 Hyatt Curve',-21.089628,-31.089408,-77.883722,87.065695,NULL,'55.29','393','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(11,94,63,'17965963','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'557 Abdiel Branch Suite 234','3168 Britney Hollow Apt. 867',9.037133,-24.896510,32.573156,166.882929,NULL,'45.23','110','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(12,26,38,'50503566','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'13280 Zieme Club Apt. 257','98651 Littel Station',-6.131278,-110.115267,-6.525841,-92.410583,NULL,'81.97','149','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(13,40,86,'02259576','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'7285 Doris Mews Apt. 396','6982 Ruthie Via',-55.670955,57.130708,1.441184,4.600875,NULL,'89.69','399','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(14,23,49,'12715099','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'998 Kihn Pass','58703 Hills Estates',69.784436,-21.201883,28.066098,-160.225127,NULL,'61.38','63','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(15,3,80,'88087663','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'747 Considine Parkway','628 Douglas Islands',-81.500307,92.569459,87.788668,172.674852,NULL,'71.32','781','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(16,35,57,'92658723','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'421 Halvorson Flat','172 Marta Fall',-28.625074,40.410676,73.443259,59.534212,NULL,'43.73','308','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(17,68,59,'73396071','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'3846 Raina Flats','4455 Gerlach Ports Suite 746',-82.525848,167.218532,36.091997,119.379462,NULL,'43.96','592','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(18,14,29,'75870753','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'28438 Jacobs Burgs Apt. 464','33197 Runte Mission',51.044744,-141.042693,20.967246,-90.031159,NULL,'10.8','169','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(19,7,69,'50523375','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'65126 Otilia Dam Apt. 264','35279 Nona Stravenue',89.426994,-96.273393,24.523725,-47.690823,NULL,'96.84','946','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(20,19,96,'30941500','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'5239 Pattie Port','22162 Lowe Causeway Apt. 268',36.845107,170.981134,-81.486302,90.579326,NULL,'64.49','921','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(21,98,61,'35112255','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'368 Altenwerth Hill Apt. 590','8496 Senger Drive',-15.424964,-49.840088,81.509526,-22.111980,NULL,'50.24','762','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(22,23,67,'39689199','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'1133 Crona Hollow','96005 Kellie Corners Apt. 138',-67.263065,35.490887,84.974042,-164.943649,NULL,'86.57','438','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(23,40,36,'89911093','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'22579 Roselyn Forges','10487 Jast Island Apt. 777',81.890855,-35.440628,-34.047578,141.850550,NULL,'56.3','646','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(24,26,10,'30542725','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'6970 Rau Glens','934 Ortiz View',75.216401,-160.721291,-88.426156,3.282530,NULL,'27.56','512','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(25,98,82,'38164569','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'8522 McDermott Stream Apt. 372','4636 Eula Pass Apt. 571',59.103485,-113.159986,-10.687143,140.283821,NULL,'12.25','575','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(26,23,63,'63951365','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'3424 Rupert Lakes','201 Camren Ports',79.363875,18.511008,-0.767928,0.619738,NULL,'50.68','818','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(27,3,59,'71615990','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'89520 Hane Lakes Apt. 983','2074 Keeling Vista Apt. 726',87.080570,-69.818326,33.552485,-96.147435,NULL,'52.51','655','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(28,40,31,'96015467','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'92335 Schamberger Ville Apt. 631','31382 Samantha Circle Suite 170',0.531569,83.161891,-18.985771,116.340150,NULL,'50.86','520','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(29,30,37,'44089746','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'61830 Otho Forks','59321 Thiel Mills',5.691180,-62.364264,45.860390,53.387283,NULL,'47.69','217','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(30,15,34,'15071756','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'14053 Williamson Throughway Apt. 486','167 Brown Mall Apt. 096',12.894248,-30.524384,15.670639,-125.228635,NULL,'19.96','293','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(31,35,44,'53519072','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'6516 Loyal Valleys','15181 Libby Summit',-40.880381,86.347259,-16.823236,-25.233316,NULL,'62.57','546','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(32,62,22,'97987505','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'900 Bode Mission','681 Mayert Lights Suite 206',7.189258,24.271887,-20.686551,150.206809,NULL,'52.7','580','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(33,26,84,'32867619','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'191 Reichert Plain Suite 963','96170 Wiza Lodge Apt. 772',-28.399836,-12.958213,56.129824,106.487940,NULL,'30.89','594','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(34,35,36,'15681571','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'70067 Bradley Courts','9947 Walter Path Apt. 328',45.525738,-11.955867,3.023499,118.643349,NULL,'32.62','393','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(35,40,48,'85938311','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'4081 Steuber Forks','679 Sydni Vista',-16.438016,102.325293,70.565145,-162.176099,NULL,'77.94','963','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(36,98,71,'46788160','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'257 Gibson Prairie Suite 598','86466 Mauricio Crest Apt. 723',-47.291006,5.136431,-64.720652,116.112952,NULL,'66.84','511','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(37,9,42,'46852191','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'2997 Pouros Knoll','9044 Quigley Points',61.687121,17.807073,-58.544187,-166.573347,NULL,'20.5','562','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(38,28,53,'82492845','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'264 Roslyn Freeway Apt. 864','1522 Heller Locks Apt. 086',-65.084568,-107.849660,-18.076365,-119.846934,NULL,'60.79','328','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(39,81,16,'74550144','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'9539 Everett Wells','344 Novella Dam Suite 724',57.860542,-21.105869,47.546705,-9.976944,NULL,'70.58','809','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(40,25,70,'68688631','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'4535 Thompson Forges','89924 Murray Lodge',-53.122801,33.101447,-46.326603,-47.383033,NULL,'58.79','313','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(41,94,53,'46300421','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'163 Nitzsche Center Suite 277','707 Haag Course',46.456233,-102.877733,-24.628974,158.197202,NULL,'37.12','817','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(42,68,97,'67107935','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'22258 Larson Roads','2385 Gerhold Rue Apt. 066',-3.092647,-93.595950,73.858161,139.435178,NULL,'96.68','22','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(43,1,17,'32194346','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'478 Fadel Drive','1776 Harry Brook',25.455038,-178.034246,50.968208,85.038919,NULL,'51.88','374','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(44,7,38,'10748507','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'2851 Jacklyn Junction Suite 276','2901 Lelah Glen Suite 008',69.931093,11.035660,49.355172,-80.400104,NULL,'29.93','278','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(45,3,38,'59634425','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'92518 Zieme Loaf Suite 538','872 Crooks Village',-38.914470,-26.228252,-19.269760,-21.362031,NULL,'92.99','871','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(46,0,88,'32162471','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'8412 Hettinger Walk Apt. 795','4475 Issac Extension',-38.501704,-19.160823,79.983501,-20.528365,NULL,'4.47','223','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(47,47,11,'49867097','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'75948 Ezequiel Avenue Suite 838','996 Hand Views',-30.354271,155.601153,-10.849167,94.370912,NULL,'21.05','64','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(48,98,83,'69386493','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'5132 Maude Plaza','62287 Mara Expressway',84.492381,0.826972,22.819332,-105.167061,NULL,'49.74','326','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(49,40,11,'55067786','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'8088 Mante Village','8005 Tressie Pines',59.432559,-153.234935,81.185540,84.536187,NULL,'15.12','832','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(50,92,99,'80365282','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'3154 Nils Harbor','510 Gabriella Viaduct Suite 850',85.288928,-103.259342,-61.008357,-106.629292,NULL,'80.64','966','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(51,74,48,'89854664','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'3096 Morissette Way','164 Auer Garden',-13.615410,123.512923,87.110338,53.782457,NULL,'49.79','255','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(52,25,70,'58384949','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'675 Boyd Hill Suite 768','6199 Bryon Road',41.430346,-93.375087,31.416528,-134.344258,NULL,'53.18','382','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(53,81,56,'56075393','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'971 Wiza Corner','3289 Jerrod Shoal',-83.841807,141.606192,37.679847,-5.470117,NULL,'89.9','599','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(54,9,89,'18482847','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'67527 Ritchie Island','61449 Blick Locks',-79.299722,-130.047184,-12.410792,51.909030,NULL,'12.69','458','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(55,19,41,'17312222','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'443 Harvey Mission Suite 665','9197 Mraz Spurs Apt. 547',57.792563,-138.950321,-34.059937,103.082588,NULL,'3.67','524','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(56,14,70,'98304480','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'5605 Senger Mews Suite 334','587 Zelda Glens Suite 519',-66.078874,-6.585384,74.497676,-58.515436,NULL,'85.72','180','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(57,15,22,'39810540','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'270 Kirk Walks','83812 Shields Mountains',56.055434,-0.396854,49.614929,-79.481475,NULL,'35.83','716','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(58,55,75,'94147106','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'2392 Rodrick Roads Apt. 951','875 Vince Valley Suite 185',-34.143023,-172.408872,46.194843,28.679269,NULL,'90.91','930','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(59,55,46,'02689184','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'8301 Cartwright Tunnel','52175 Erdman Knoll',55.620403,78.159425,60.950039,-57.051242,NULL,'24.1','11','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(60,19,2,'96542864','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'9887 Zboncak Landing','100 Marty Plaza Suite 959',50.806356,-63.836053,64.297521,52.378178,NULL,'18.44','983','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(61,14,52,'94841549','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'660 Jaskolski Keys','5332 Lemke Vista',-4.833649,165.905273,-22.193629,96.900128,NULL,'2.92','66','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(62,81,80,'90717925','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'61938 Koch Garden','4445 Jast Mills Suite 580',1.500995,3.354013,59.838683,139.312737,NULL,'60.75','886','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(63,40,18,'76361298','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'7117 Rau Plain Apt. 406','6420 Denesik Cove Suite 412',-78.639755,-139.236271,83.604637,-10.161841,NULL,'8.62','17','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(64,30,4,'28196426','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'788 Thad Extensions','60227 Runte Shoal',-62.603678,169.442278,5.940988,-106.873238,NULL,'56.57','662','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(65,47,100,'76915752','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'771 Jacinto Walk Apt. 246','8556 Will Ridges',59.697898,-153.794324,-73.227677,153.487480,NULL,'95.96','723','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(66,68,80,'95065377','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'5201 Maxime Branch Suite 707','4936 Dasia Circle Apt. 650',-27.922506,29.048131,43.302536,144.307581,NULL,'35.21','966','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(67,35,10,'62721022','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'7186 Valentine Park','6702 Rex Roads',64.974302,-19.726780,-2.828501,-150.097177,NULL,'52.47','566','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(68,81,42,'96110531','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'1160 Daphne Ways Apt. 017','403 Jeanie Prairie',-17.177271,-176.958928,10.363535,8.321972,NULL,'27.61','966','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(69,94,41,'71146056','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'6825 Kertzmann Hills Apt. 411','63207 Delmer Street Apt. 595',26.390933,-147.398005,-15.425714,-129.545280,NULL,'20.35','643','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(70,94,49,'19704366','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'778 Olson Square','6675 Cesar Mountains',-16.387544,-66.020289,61.915291,73.151938,NULL,'9.3','890','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(71,81,41,'90596818','0','2017-09-15','17:18:29','pesanan diterima','',NULL,'95004 Rohan Trail Apt. 422','7366 Sharon Village Suite 190',-84.317742,177.922499,88.069308,-164.527949,NULL,'4.7','52','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(72,23,90,'18723559','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'607 Predovic Inlet Apt. 193','70168 Blanda Mall Suite 041',20.127236,-5.288150,-70.430028,-18.703285,NULL,'72.11','38','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(73,26,36,'57939274','1','2017-09-15','17:18:29','pesanan diterima','',NULL,'9899 Harrison Meadows Apt. 454','910 Ernser Mews',43.214865,141.798052,-11.011213,72.106442,NULL,'69.31','769','2017-09-15 16:48:29','2017-09-15 17:48:29','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(74,95,10,'89319888','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'252 Kristy Prairie Suite 335','8384 Heaney Parkways',41.982935,-126.494334,4.798053,-124.593549,NULL,'11.05','861','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(75,0,76,'91527958','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'8187 Rolfson Mountains','6070 Irwin Forks Suite 999',66.027587,-160.281275,-40.916937,-37.442333,NULL,'84.92','73','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(76,87,41,'21055111','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'318 Wiza Mission','9230 Larkin Well',58.171564,129.670466,47.874656,-43.673264,NULL,'67','134','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(77,7,18,'26966496','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'9074 Medhurst Walks Suite 316','8771 Macejkovic Trail',19.316451,152.687289,36.673689,52.833151,NULL,'27.73','411','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(78,9,56,'13522672','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'59793 Hills Spur','2080 Grimes Vista Apt. 771',65.085094,87.662705,30.440908,-5.687879,NULL,'60.58','715','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(79,68,5,'74513277','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'1532 Enid Parks Suite 926','490 Hauck Stravenue Suite 220',-6.786684,-119.276037,-39.352567,145.110419,NULL,'92.66','299','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(80,87,84,'08471240','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'508 Herman Ridge','2796 Waters Fort',-56.859364,12.531751,-82.790930,-68.704575,NULL,'92.46','431','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(81,94,46,'08619354','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'336 Orpha Center Suite 625','6548 Wehner Drive',-48.115260,158.252940,-67.841640,-57.344189,NULL,'27.58','850','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(82,14,99,'51888242','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'29757 Hahn Mill Suite 442','924 Abbott Extension',-59.197188,-52.431206,26.398493,155.198091,NULL,'81.01','863','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(83,1,13,'15195384','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'94494 Cormier Point Apt. 257','8961 Julian Causeway Apt. 973',28.899578,-102.026644,46.184275,-34.031739,NULL,'0.36','900','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(84,0,12,'39977702','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'210 Botsford Underpass Apt. 326','7611 Jimmie Bypass',-24.889518,-113.305684,-53.688731,-17.548305,NULL,'98.35','200','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(85,92,58,'62505017','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'709 Wuckert Island Apt. 570','2075 Zackery Hill',-89.971690,-13.510654,72.029679,152.484824,NULL,'82.96','137','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(86,26,43,'32483833','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'7977 Bogisich Shoal','3873 Dorothea Inlet',-70.947318,-146.633118,-74.735031,-146.759507,NULL,'13.09','891','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(87,74,4,'52322956','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'2873 Feeney Pass','975 Mertz Course',-83.752447,42.484010,-34.509938,-118.233207,NULL,'99.79','919','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(88,14,85,'89393048','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'7140 Herman Throughway','79474 Schneider Oval',69.309180,28.858836,49.679714,-114.197479,NULL,'7.91','9','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(89,62,32,'01206902','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'86864 Quitzon Fort','8312 Marie Mount Suite 312',69.279350,-138.483983,-82.911377,-47.223725,NULL,'86.09','438','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(90,51,71,'94326138','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'9493 Stark Plaza','31958 Buckridge Ridges Apt. 248',3.696019,-160.714604,-9.967822,-167.869868,NULL,'92.93','529','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(91,30,31,'00913281','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'35772 Schimmel Station','63798 Arnaldo Estates Apt. 230',20.891189,30.508746,-55.542444,24.184374,NULL,'90.56','485','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(92,98,45,'62939676','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'1010 Kali Curve','1666 Weber Club',44.011077,-20.808700,37.640033,-46.663822,NULL,'36.72','539','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(93,51,89,'54371406','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'857 Alessandro Point Apt. 635','584 Iva Stream Apt. 561',78.694679,-117.339955,36.129847,100.729140,NULL,'45.61','299','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(94,55,57,'11393863','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'25501 Laurianne Gardens','7035 Fernando Via',-57.556138,-114.625041,-3.907513,107.136000,NULL,'48.97','758','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(95,0,34,'10106084','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'8903 Weber Fords','82342 Spencer Brook',-15.234014,-92.943566,89.551010,-37.080564,NULL,'28.83','78','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(96,62,36,'78234031','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'258 Hand Center','667 Sanford Cove Suite 180',65.891396,6.787261,-64.165270,31.784450,NULL,'4.18','210','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(97,81,50,'58674985','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'2011 Edgardo Street Apt. 794','91784 Elenor Fall',73.371938,-117.427628,-79.950445,-34.016291,NULL,'66.78','660','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(98,9,46,'69331688','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'6753 Adriana Parks Suite 924','6753 Annalise Point',-12.797109,-145.423150,-63.839150,-34.182563,NULL,'0.22','899','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(99,55,77,'42238807','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'258 Mylene Streets Apt. 942','87205 Brandt Plaza Suite 644',78.177517,46.197172,12.721182,134.906431,NULL,'89.41','491','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(100,28,46,'57714286','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'887 Russel Junctions Suite 976','8151 Luettgen Trail Apt. 469',-59.792507,-20.229648,-2.270529,-63.610715,NULL,'38.29','40','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(101,91,31,'07729256','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'155 Rene Garden','1997 Littel Land Apt. 085',-60.517600,-167.459610,35.012957,-41.062069,NULL,'61.79','73','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(102,19,99,'36196643','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'72310 Raquel Parks Suite 354','46692 Lesch Spur Apt. 743',-68.163942,131.884696,-11.797903,89.983834,NULL,'42.53','493','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(103,26,72,'53286253','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'4649 Bobby Roads','376 Wisozk Vista',-78.534920,42.827561,54.147651,146.020555,NULL,'45.87','444','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(104,54,99,'97292735','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'863 Cummings Forge','7429 Tremblay Road',23.988206,-44.302784,-55.608679,-41.872493,NULL,'14.59','429','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(105,94,78,'85129393','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'72588 Arnoldo Way Suite 832','18785 Melba Locks',63.177959,-161.701848,-5.306813,175.622836,NULL,'77.27','692','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(106,51,8,'39021517','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'338 Baumbach Parkways Apt. 215','14572 Reichel Freeway',-53.327160,-142.463908,-81.175722,45.527793,NULL,'94.94','423','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(107,26,84,'41868762','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'356 Hilma Ramp Suite 087','9525 Jennie Springs',3.143550,105.387294,13.434462,14.830218,NULL,'63.21','417','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(108,1,59,'93003540','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'4278 Ilene Square Apt. 977','7562 VonRueden Bypass',61.491252,-6.163881,69.806245,98.753537,NULL,'87.77','604','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(109,74,75,'13679156','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'379 Corwin Port','61624 Demetris Greens',47.627965,-85.648622,72.090432,151.166545,NULL,'19.27','829','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(110,62,38,'89374900','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'5637 Mariane Lakes','7561 Kovacek Ranch',74.120958,-175.045463,-23.890129,11.384769,NULL,'31.55','964','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(111,1,97,'05855876','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'610 Sanford Mountains Suite 030','1235 Bartell Isle',36.358172,129.650334,34.114001,-125.689806,NULL,'11.86','34','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(112,24,71,'67089374','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'81769 Lucio Cove Suite 603','78432 Schuster Meadow',-89.237393,-21.297552,4.681668,109.911896,NULL,'42.43','92','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(113,28,8,'01998553','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'499 Reichel Mews Apt. 267','75513 Howe Shore',-72.349087,-12.827994,4.427176,-148.042180,NULL,'60.08','906','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(114,62,63,'54124279','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'43794 Trey Stravenue','3829 Judd Field Apt. 991',66.526001,85.898472,-52.571909,-143.006960,NULL,'12.64','205','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(115,81,96,'83284030','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'72584 Junius Brook','8943 Hettinger Stravenue',-21.076202,135.709557,87.789574,-74.367499,NULL,'87.15','336','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(116,55,4,'74759134','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'77073 Elyssa Bridge','140 Kirlin Valley',-82.689579,-0.967638,-74.982573,164.789556,NULL,'33.21','518','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(117,15,52,'80811602','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'15447 Wilburn Trail','79941 Joyce Locks',3.272557,-28.068405,2.718923,-47.332309,NULL,'5.93','877','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(118,0,89,'65494387','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'91788 Era Well Suite 734','74820 Else Islands',60.131124,-59.996511,17.055719,41.493542,NULL,'28.32','692','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(119,26,12,'97826170','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'95118 Hadley Vista','40471 Bailee Branch Suite 082',-77.050459,-103.461519,-8.308745,34.193126,NULL,'93.15','666','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(120,7,12,'18116555','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'171 Marianne Springs Suite 986','211 Schneider Fords',60.839400,10.903556,19.709159,-136.122422,NULL,'57.37','522','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(121,23,41,'11149730','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5118 Andy Tunnel','407 Koss Forks',-65.675574,124.674322,-86.592404,-38.905275,NULL,'2.21','240','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(122,14,90,'55820422','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'9782 Simonis Pine','5636 Kaycee Passage Suite 644',-84.776800,-143.588021,38.977532,4.260552,NULL,'96.74','843','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(123,51,4,'29039678','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'3421 Reina Port','79920 Gottlieb Court Apt. 322',-35.912861,-72.209946,31.713967,174.341119,NULL,'64.97','125','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(124,87,39,'02844125','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'738 Turner Glen','656 Pagac Villages Apt. 792',-55.300198,98.204902,17.026426,174.851064,NULL,'85.81','855','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(125,19,22,'72834273','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'1836 Glover Junction Apt. 690','2558 Lynch Rest Suite 379',-6.799230,45.617813,55.624595,-82.051716,NULL,'39.42','322','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(126,26,34,'48916785','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'92412 Botsford Field Apt. 100','28744 Nikita Coves',55.097175,-144.522116,-61.852722,-122.779996,NULL,'30.06','300','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(127,55,89,'89816363','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'44586 Eloy Stravenue Suite 912','243 Brittany Drive',79.342391,56.725560,-0.908352,40.817344,NULL,'82.59','572','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(128,47,39,'98689239','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'290 Hosea Turnpike','908 Rau Valleys',-4.316855,105.163932,-17.179694,-101.614166,NULL,'8.09','230','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(129,0,42,'11374284','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'390 Hilpert Unions','804 Kaylah Plaza',46.383093,-0.116368,5.854391,90.798933,NULL,'66.24','269','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(130,47,31,'58990403','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'401 Prudence Street Suite 523','69706 Lebsack View Suite 224',-2.421512,28.946317,33.159263,106.834355,NULL,'75.38','82','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(131,91,4,'77598950','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'48948 Trevor Road Suite 856','9203 Zieme Ports Suite 428',45.964235,114.306562,56.981434,-75.153622,NULL,'70.21','845','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(132,68,100,'10560981','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'87233 Patsy Corners','403 Cordie Stream',9.572105,109.669475,-26.808333,5.857971,NULL,'74.74','127','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(133,40,37,'06622600','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'6833 Marc Forge Apt. 154','31237 Kianna Inlet Apt. 521',-54.640666,162.776186,-52.872488,-163.659007,NULL,'79.19','649','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(134,51,39,'46553148','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'83555 Yadira Throughway Suite 563','91588 Schmidt Rapids Apt. 477',-4.939098,-91.879164,-67.285981,-27.668063,NULL,'12.39','627','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(135,55,43,'92146909','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'489 Elvis Manors','41962 Maribel Shoal',35.701888,-113.359752,77.577472,-144.948798,NULL,'55.77','308','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(136,30,67,'93580571','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'7942 Murray Run','503 Ignatius Court',-16.774069,54.534770,40.161328,78.808508,NULL,'14.3','463','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(137,51,65,'66007407','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'14792 Tremblay Freeway','4479 Lexi Station Suite 858',-9.112348,-136.894662,-41.353046,-74.911465,NULL,'76.4','865','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(138,68,10,'27380019','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'44089 Guy Extensions Suite 372','2197 Simonis Roads',-52.415825,-3.221434,61.911240,-172.470062,NULL,'88.6','973','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(139,0,83,'84337843','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'1139 Bernier Throughway Apt. 385','463 Kenny Hollow',-76.338677,-164.916540,-0.644356,124.249752,NULL,'12.4','184','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(140,28,64,'85779134','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'16438 Lori Square Apt. 541','90339 Jarvis Trafficway',24.602782,58.044873,57.900327,20.479460,NULL,'90.74','292','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(141,30,82,'24928137','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'2331 Ciara Trace Apt. 974','85994 Bette Lodge Suite 925',38.350783,-104.838106,35.307407,-77.337339,NULL,'12.93','596','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(142,19,93,'60642174','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'706 Ruecker Ranch Suite 831','5148 Morissette Vista',-43.798195,19.478359,33.812329,-117.994300,NULL,'41.75','640','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(143,74,73,'35099158','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'876 Laurel Orchard','6839 Haley Isle Apt. 193',51.698293,3.846135,72.763762,-163.238231,NULL,'94.58','144','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(144,9,46,'15383767','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'762 Kuhn Glens','36321 Schmidt Track Suite 692',-83.054099,-133.656725,-53.595808,178.454500,NULL,'33.28','631','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(145,62,70,'37828183','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'9763 Granville Well Suite 394','67985 Dominic Track Apt. 998',-36.512129,35.819134,-69.021122,101.311819,NULL,'60.63','18','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(146,7,57,'08774448','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'75453 Russell Loaf','3022 Ernie Forge Apt. 030',31.430673,-108.849440,46.090411,-41.884889,NULL,'31.06','878','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(147,1,90,'90427749','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'712 Ortiz Ford','753 Graham Estates',84.379081,-67.224702,-41.326521,40.752668,NULL,'95.06','347','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(148,0,53,'70161191','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'4875 Lockman Harbors Apt. 698','883 Ryley Loop',-87.449426,78.310712,17.968950,-97.204497,NULL,'45.14','66','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(149,74,69,'20106764','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'4058 Genevieve Loaf','1536 Mozelle Rue Apt. 405',33.580835,107.996479,-52.827542,-44.316722,NULL,'77.8','867','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(150,55,11,'97682664','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'9938 Garnet Extension','91640 Skiles Row',41.813508,-128.251429,-43.706344,0.950314,NULL,'10.96','496','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(151,1,96,'54534333','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'5029 Little Keys Suite 812','2582 West Spurs Suite 671',-27.753501,-179.013132,25.063375,17.997217,NULL,'16.39','977','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(152,14,69,'31440035','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'10454 Aaron Plains Suite 268','4222 Bernhard Stream',-80.695234,79.048712,71.006571,-27.089328,NULL,'69.79','141','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(153,74,49,'26360373','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'7848 Antonia Field','5813 Corkery Ways',-86.220548,7.905795,-76.393671,153.664609,NULL,'82.86','282','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(154,14,2,'10745139','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'97293 Leannon Square Apt. 929','781 Raina Underpass',87.181792,63.754873,-65.952337,-41.795575,NULL,'25.91','687','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(155,23,80,'69598274','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'8038 Hickle Vista','861 Quigley Light',-46.332165,151.646351,-10.232836,50.335746,NULL,'57.49','936','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(156,55,57,'39474418','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'786 Ryan Pines','8021 O\'Kon Springs',-4.529213,172.307446,-60.557735,-49.008723,NULL,'15.08','851','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(157,87,86,'28225834','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'509 Shanelle Highway','763 Nadia Oval Apt. 402',80.401364,121.156415,-63.650345,41.998832,NULL,'88.93','256','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(158,30,12,'49953987','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'938 Nolan Wells Apt. 803','90619 Thiel Causeway Suite 190',58.433445,32.117650,55.742188,16.284365,NULL,'65.05','920','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(159,87,10,'68884961','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'9942 Lorena Crossroad','44445 Roob Mills Apt. 771',39.518728,55.011333,2.487433,65.054990,NULL,'11.38','940','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(160,91,99,'28792965','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'3287 Howe Islands','483 Hermann Walk',-72.875817,-73.188931,-83.584569,-7.608420,NULL,'77.1','221','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(161,28,50,'63146714','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'822 Savannah Plain','90247 Harvey Rue',87.676158,-101.361262,18.542501,69.462420,NULL,'21.38','363','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(162,9,11,'20502357','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'891 Gabe Row','3551 Schoen Field Apt. 497',-73.333554,104.889490,-51.642878,124.949134,NULL,'82.21','943','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(163,15,86,'77505792','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'862 Jarrett Way Suite 182','67765 Flo Crossroad Suite 922',84.593055,163.548691,-69.002502,131.221883,NULL,'59.16','427','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(164,24,85,'85713305','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'6447 Hyatt Square','9872 Jayde Crest Apt. 674',50.457993,-109.448130,38.912101,153.724660,NULL,'23.26','392','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(165,1,56,'17652643','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'7537 Lang Green Apt. 032','5068 Reilly Stream',-23.810899,90.744541,-67.423742,-106.655558,NULL,'73.46','60','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(166,24,10,'49010200','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'87224 Reilly Burgs','6151 Sidney Rapids Suite 482',-35.134986,-160.777586,-71.611988,-163.169098,NULL,'64.12','419','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(167,35,86,'35900605','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5890 Nelda Greens Suite 453','75156 Madisen Forge Apt. 310',-23.451239,-80.612344,9.423055,-154.313358,NULL,'50.86','634','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(168,54,49,'58867734','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'56534 Christian Squares','43872 Helena Summit Apt. 805',23.092420,15.859850,13.252955,-168.223385,NULL,'61.86','216','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(169,24,100,'25009758','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5643 Rice Viaduct','243 Murray Flat',22.741961,28.175485,-24.852276,33.319423,NULL,'35.1','408','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(170,95,99,'18647727','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'4078 Jerrell Locks Suite 143','220 Carroll Ridge Apt. 178',41.615040,94.566428,-38.478795,-9.147142,NULL,'55.36','812','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(171,23,21,'76204601','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'808 Harvey Lodge Suite 831','49119 Halvorson Ranch',15.705580,-135.851568,18.693869,41.773254,NULL,'64.29','150','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(172,68,59,'27315945','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'230 Charity Hollow','124 Hoppe Path',-21.063462,122.128918,-87.701501,-144.777548,NULL,'39.9','298','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(173,19,79,'03787775','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'91894 Sheldon Mountains','1743 Camilla Canyon Suite 744',63.344736,171.343539,68.816127,-109.687561,NULL,'69.1','815','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(174,14,34,'90349867','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5380 Luella Rest','43587 Opal Burg Suite 529',-2.892014,-84.202443,-10.645658,-117.496865,NULL,'77.5','837','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(175,1,27,'76559644','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'33883 Charlene Valleys','758 Barton Ford',73.604784,-147.761115,-69.991200,169.663921,NULL,'96.88','462','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(176,68,66,'76560181','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'144 Bosco Oval','78877 Enrico Tunnel Suite 951',2.770500,-109.424143,66.282580,-124.147584,NULL,'57.3','497','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(177,24,29,'12482678','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'7324 Goodwin Orchard Apt. 380','9437 Feest Drive',74.914318,119.799595,-82.741021,-30.779208,NULL,'71.6','576','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(178,40,10,'59217389','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5272 Konopelski Orchard Apt. 062','8338 Gene Skyway',-59.653696,-133.779979,13.813714,59.514819,NULL,'16.57','88','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(179,68,70,'13732215','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'980 Cheyanne Crossing Apt. 433','552 Conrad Port',-73.014800,108.077964,-58.417348,73.754863,NULL,'52.83','962','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(180,54,36,'95829331','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'70857 Kohler Neck Suite 549','215 Brandyn Village Apt. 268',87.471867,103.291770,-74.856631,93.388025,NULL,'96.41','202','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(181,0,61,'44792840','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'3055 Cole Skyway Apt. 044','9049 Stoltenberg Villages Apt. 142',-79.623315,-133.896782,-30.076204,96.289640,NULL,'40.35','541','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(182,81,60,'41169573','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'4822 Trenton Pass Apt. 222','778 Darrell Spur',-59.375223,-54.913576,20.041566,-116.329275,NULL,'92.41','665','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(183,9,2,'52405587','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'33956 Desmond Drive Apt. 736','5303 Aileen Summit Suite 392',61.268830,69.906283,-39.477296,160.200155,NULL,'52.1','454','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(184,74,69,'51573775','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'1541 Wisozk Gateway Apt. 742','85009 Talon Union',83.618099,84.656224,49.220982,113.292396,NULL,'35.03','947','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(185,94,66,'42906713','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'7208 Padberg Circles Suite 544','13302 Torp Plaza',53.774333,101.726226,21.929612,29.257701,NULL,'95.52','631','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(186,28,36,'27856372','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'2224 Kessler Tunnel','64301 Hodkiewicz Ridges Apt. 437',72.548440,-77.086423,71.886760,46.419438,NULL,'89.19','804','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(187,23,83,'04898704','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'506 Giovanna Ports Apt. 354','89153 Bechtelar Corners Apt. 241',43.405162,-8.456201,-25.992070,57.070397,NULL,'27.54','401','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(188,62,78,'80485364','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'61447 Abby Glen Suite 774','24735 Emmitt Heights Apt. 490',-77.697239,65.153855,28.671261,-120.538295,NULL,'77.23','363','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(189,19,57,'27198621','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'9692 Mireya Lakes Apt. 782','596 Litzy Ramp',85.940137,107.830768,78.011654,124.945429,NULL,'84.17','981','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(190,40,38,'30238372','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'2558 Muller Loop Apt. 291','16840 Balistreri Bridge Suite 115',-24.318290,67.299338,-89.178451,127.604717,NULL,'19.66','834','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(191,7,18,'92029301','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'8309 Stehr Drive','11013 Katelyn Fort Suite 521',-61.165528,55.701479,-76.390681,-19.095719,NULL,'73.09','906','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(192,95,48,'91141749','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'826 Schimmel Lodge Apt. 292','7484 Schamberger Shoal',23.676646,78.270405,-85.831374,85.054571,NULL,'11.74','997','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(193,54,65,'85931743','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'24388 Friesen Meadows Suite 890','28788 Shanna Square',-46.623049,140.950182,61.848129,-134.318829,NULL,'15.33','557','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(194,94,64,'13795171','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'164 Dorothy Summit','38463 Bergnaum Track',-52.805323,2.902584,-37.086814,-92.608477,NULL,'38.69','742','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(195,91,52,'40273675','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'8955 Clint Green Apt. 837','694 Kamron Vista',-74.313916,7.399399,27.812189,158.848498,NULL,'33.92','415','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(196,62,93,'73991760','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'210 Bednar Parks Apt. 490','340 Kulas Forest Suite 935',1.748616,74.998758,12.101503,-35.158044,NULL,'35.6','705','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(197,14,50,'65708208','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'396 Addie Plain','611 Hartmann Tunnel',-85.164839,64.878836,15.843201,-25.550772,NULL,'69.7','886','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(198,14,43,'45758083','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'5457 Schmeler Causeway Suite 736','345 Margaret Drive Suite 682',-45.755799,-154.338472,28.510725,-70.748628,NULL,'96.32','74','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(199,51,61,'22728719','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'7938 Hodkiewicz Road Suite 309','28960 Herman Crossroad',-44.876315,-151.426727,-63.024693,-170.153681,NULL,'31.15','167','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(200,54,57,'65942875','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'320 Gorczany Curve Suite 947','755 Wunsch Loaf',-75.490122,28.234541,-69.240220,-0.175443,NULL,'28.11','508','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(201,15,21,'14744819','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'7711 Kovacek Road Suite 023','653 Wehner Pass Apt. 219',61.845391,-143.580312,25.050319,60.372841,NULL,'1.35','868','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(202,94,48,'99175061','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'362 Marcelle Lane','14383 Kassulke Way',-31.614119,-37.715047,2.959392,168.079080,NULL,'14.99','774','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(203,35,61,'63687381','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'565 Anabel Squares Suite 273','18605 Aniya Prairie Apt. 821',30.132717,-9.835802,-18.426353,-60.609577,NULL,'71.77','669','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(204,3,89,'84973788','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'67800 Stan Island Apt. 504','8878 Mueller Haven Suite 762',32.912191,144.651643,78.993010,162.374443,NULL,'76.67','606','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(205,91,21,'37973395','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'9631 Lind Avenue','57888 Tina Burg Suite 515',-12.747124,-154.863210,66.757117,-35.782388,NULL,'63.99','970','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(206,51,6,'13249618','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'943 Merl Ford','83959 O\'Kon Crossroad Apt. 832',52.692999,-19.913030,41.676074,-105.800403,NULL,'47.62','919','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(207,91,4,'38946608','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'15954 Nya Greens','416 Lionel Trafficway Apt. 590',1.447483,-162.533406,-79.087062,-12.467547,NULL,'43.33','336','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(208,9,38,'70891478','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'807 Thompson Gateway Apt. 901','65470 Cartwright Plaza',44.750594,-95.653788,15.585669,-39.940607,NULL,'18.72','92','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(209,47,20,'10004166','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'241 Una Rapid','2547 Rickey Spur Suite 705',88.106026,172.051176,87.667605,-134.948145,NULL,'16.56','244','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(210,51,70,'04949646','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'7915 Odie Brook Apt. 113','1200 Luz Pass Apt. 038',32.571772,14.575741,-80.624546,157.980933,NULL,'40.76','531','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(211,9,17,'71586625','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'5742 Shanahan Brooks Apt. 108','205 Althea Bridge',-40.047932,39.970161,24.512619,96.289179,NULL,'28.45','426','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(212,1,27,'27308653','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'29062 Bartoletti Knoll','959 Cristina Knoll',6.409541,60.147949,4.641134,75.222748,NULL,'42.78','39','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(213,3,2,'88404569','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'8835 Robin Passage','4522 Jammie Turnpike Suite 959',42.938904,44.899445,88.442039,-176.048479,NULL,'86.86','492','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(214,14,99,'16972373','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'617 Cormier Divide','9702 Hessel Centers',-64.501056,-42.897489,-27.466750,-171.479751,NULL,'60.3','542','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(215,81,93,'49211021','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'10670 Jenkins Ports Apt. 996','670 Bogisich Alley Suite 470',52.874923,146.487866,-52.739878,-112.220840,NULL,'71.35','805','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(216,94,8,'31288842','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'664 Ferry Ports','525 Helena Turnpike',19.227018,-3.407720,65.888875,-174.327435,NULL,'87.27','217','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(217,87,45,'56889778','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'15654 Floy Terrace Apt. 013','9999 Crist Mills Suite 534',-52.380503,-166.271333,83.056428,138.627876,NULL,'9.47','381','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(218,9,37,'89979574','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'71153 Marks Square','2882 Olson Street',-3.298196,-157.442269,-27.651738,61.182122,NULL,'51.35','41','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(219,74,80,'22909226','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'9663 Doyle Stravenue','661 Albert Loop Apt. 248',24.634685,-54.517594,12.383734,1.860986,NULL,'54.75','278','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(220,98,61,'12869178','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'1698 Jast Crossroad','91312 Windler Mountains',85.950898,-45.751882,12.737547,47.001211,NULL,'60.21','859','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(221,3,16,'98621280','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'42647 Johnston Tunnel','216 Meredith Neck Suite 152',85.090681,38.021212,47.554813,-137.174447,NULL,'69.14','274','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(222,98,99,'84247869','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'39345 Lowe Ridges Suite 209','17692 Jenkins Corner Suite 456',-0.928174,-55.947470,-16.807895,-177.249249,NULL,'12.93','799','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(223,91,5,'63589654','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'769 Grover Manors Apt. 570','211 Zola Key Apt. 984',25.173602,-145.776515,33.451581,-148.216853,NULL,'39.55','775','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(224,26,34,'13974398','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'53204 Purdy Gateway Apt. 933','259 Stanford Inlet Suite 451',-86.493581,-39.262952,-68.704982,-32.352437,NULL,'74.38','152','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(225,98,27,'24155351','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'6232 Kunze Overpass','710 Richard Forges Suite 418',41.876470,-179.746027,79.487068,75.509003,NULL,'15.73','931','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(226,35,37,'42326607','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'1814 O\'Connell Harbors','6912 Odell Lane Apt. 735',-35.041035,102.803225,-81.204301,74.898697,NULL,'99.18','491','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(227,62,49,'01416509','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'18014 Feil Parkway Apt. 359','92547 Russel Unions Apt. 040',-50.041784,140.705687,-19.957983,44.834811,NULL,'56','235','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(228,25,18,'91848356','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'37602 Rath Shore','30660 Izabella Forest',33.695970,88.723880,-21.547304,-107.617629,NULL,'28.85','583','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(229,1,99,'78986578','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'83008 Hanna Trafficway Apt. 689','167 Wilfredo Garden',41.913936,-5.456187,-21.557916,-96.599484,NULL,'34.57','763','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(230,9,93,'19950886','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'743 Mertz Canyon','375 Turner Well Suite 137',13.602794,164.009733,-38.649180,-25.791444,NULL,'18.8','892','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(231,3,78,'79723082','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'322 Fanny Spur Suite 177','556 Hauck Point Apt. 884',-60.481033,126.049676,-77.356736,70.003465,NULL,'55.24','205','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(232,3,43,'40790145','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'113 Gleichner Point','8588 Kane Ville Apt. 203',81.522753,128.164096,79.995627,177.012509,NULL,'83.19','359','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(233,0,65,'40375469','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'8446 Rippin Shoal','595 Trantow Crescent Apt. 363',19.857850,85.215575,-61.227647,146.758493,NULL,'15','211','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(234,92,90,'15517957','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'83197 Gutkowski Stravenue Apt. 334','62600 Waters Gardens Suite 629',19.491365,-6.761521,-1.102000,-79.618199,NULL,'70.19','777','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(235,95,27,'25581492','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'65903 Lind Glens Apt. 844','7923 Roberts Harbors Suite 030',4.461687,53.819317,-52.827310,96.212711,NULL,'39.03','300','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(236,15,22,'39185259','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'5188 Schneider Islands Apt. 815','70860 Swaniawski Meadow Suite 791',-42.361914,-179.572202,88.700387,-5.090222,NULL,'33.51','908','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(237,47,53,'41007051','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'79288 Lueilwitz Hollow Suite 017','4695 Lesch Forest Apt. 832',-81.218422,-107.268492,49.598487,-174.025523,NULL,'64.77','272','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(238,23,32,'81515556','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'54459 Kendra Trail Suite 980','8479 Raynor Tunnel',-66.655356,15.368688,-15.350051,-62.501485,NULL,'25.87','670','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(239,3,34,'64276845','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'2704 Yasmin Curve','9408 Walker Cove Suite 903',-64.653402,123.996324,-71.818131,172.568231,NULL,'36.82','243','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(240,68,84,'23238824','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'906 Jasmin Springs Suite 415','441 Eleonore Forks',-39.549962,-87.979883,21.796481,163.280590,NULL,'90.03','983','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(241,47,84,'24795168','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'3304 Brenna Trail','56761 Stiedemann Burg',-22.965059,135.635561,38.694675,-53.289367,NULL,'34.67','687','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(242,15,86,'08653613','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'49813 Friesen Hollow Suite 452','497 Stamm Square Apt. 646',-58.131673,-147.772837,-38.013622,-146.353830,NULL,'39.54','50','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(243,98,88,'52862968','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'244 Toy Avenue','711 Wolff Fords Suite 017',-5.186503,115.508516,80.330156,-131.622813,NULL,'62.82','334','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(244,1,89,'26440624','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'99175 Conn Lodge Suite 262','8487 Rice Prairie',48.254057,-43.608586,2.406316,-87.123694,NULL,'77.06','994','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(245,98,8,'56740789','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'98026 Jolie Spur Suite 523','9114 Wilfrid Extensions Suite 936',-50.726207,-78.472050,51.487315,10.096560,NULL,'57.97','962','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(246,87,42,'33779010','1','2017-09-15','17:18:30','pesanan diterima','',NULL,'9687 Wellington Valleys','77985 Wolff Expressway Suite 152',-65.817263,-5.494475,-20.151800,-36.948191,NULL,'38.21','267','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(247,3,2,'23676307','0','2017-09-15','17:18:30','pesanan diterima','',NULL,'80698 Schumm Inlet Suite 604','51817 Spencer Mission',31.389552,89.416200,67.583800,-42.359008,NULL,'4.77','765','2017-09-15 16:48:30','2017-09-15 17:48:30','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(248,40,2,'63044133','1','2017-09-15','17:18:31','pesanan diterima','',NULL,'1553 Rice Corner Apt. 356','88974 Ray Drive',89.412101,68.932891,-78.623713,-62.855742,NULL,'28.62','283','2017-09-15 16:48:31','2017-09-15 17:48:31','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(249,91,22,'96926482','0','2017-09-15','17:18:31','pesanan diterima','',NULL,'35387 Jett Fort','898 Clemmie Terrace',-17.684988,-27.701477,5.740028,-154.005190,NULL,'2.2','969','2017-09-15 16:48:31','2017-09-15 17:48:31','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL),(250,62,4,'54948518','0','2017-09-15','17:18:31','pesanan diterima','',NULL,'5546 Paucek Vista Suite 308','2308 Fleta Ridges Apt. 482',66.198461,-124.981356,-48.953903,80.793669,NULL,'68.42','984','2017-09-15 16:48:31','2017-09-15 17:48:31','2017-09-15 17:18:31','2017-09-15 17:18:31',NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `province_id` int(10) unsigned NOT NULL,
  `gps_latitude` double(11,6) DEFAULT NULL,
  `gps_longitude` double(11,6) DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_link` int(10) unsigned DEFAULT NULL,
  `reset_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `admin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `invite_friends` int(10) unsigned DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `old_expired_at` datetime DEFAULT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_created` int(10) unsigned DEFAULT NULL,
  `admin_updated` int(10) unsigned DEFAULT NULL,
  `share_newfriends` mediumtext COLLATE utf8mb4_unicode_ci,
  `already_hadfriends` mediumtext COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_city_id_foreign` (`city_id`),
  KEY `users_province_id_foreign` (`province_id`),
  CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `users_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'HXWZsEKeKZm',NULL,'prof. mikayla roberts','carson97@example.com','$2y$10$7USnImM8rLgRUfbGl61IcOJ0NPcoz8.KrJUAqC8M/fPsm55t1hb5u','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'ufKDkH5E8K','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(2,'c3fneswq1IK',NULL,'cloyd nolan','schinner.elmira@example.org','$2y$10$V.n6d0cNJcHiNbLoFsQQtO9F9haia0owy7NIz7GDNzn8QAU89HJKK','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'tJetRf3wBi','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(3,'zk5i8y0HG7W',NULL,'destini littel','kreiger.madge@example.com','$2y$10$f66iP4USLCYvYSopgUUUhuN7xOT.wak34jualxhm8zTiLCsqzIrFa','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'UIoGNdSLdD','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(4,'wtZLZjTr9VD',NULL,'dr. dayton nitzsche','ndicki@example.net','$2y$10$/hYo/7.Fucz.jU6s9UwTZue3ZTmlkMmxjYJIj8ixyAXFxw26GZc7W','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'2Myg66bTKJ','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(5,'0FjqbPUbXwc',NULL,'ollie kirlin','giovanny65@example.org','$2y$10$IrzaqGkO0uygPgJkqQs6GO5Znk50bfGd/yxXooBge5gieXlFwoZoy','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'DmGR30LesY','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(6,'zosKAVIt9DW',NULL,'claire schroeder','preston08@example.net','$2y$10$89vL66kmvLmdFFwIoa1gX.26XuiTmBG9av9d36c7p0nL/ndUyv2NG','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'XrfMMLkMoO','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(7,'ejdrcH27v2T',NULL,'shawna hickle','reid50@example.org','$2y$10$rXCwO9myxA28uUX4TqJbjOoJ9iMff.KfIcu6PP6kXGYpUb.uxkRie','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'0nB2hl7a9R','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(8,'WpVoc3Hbb5R',NULL,'gilbert cartwright md','crice@example.com','$2y$10$s1hjEtCEw5Skv2aJjMV7z.S2Nhv/.11594ztBlT0SHVJJn3RG6/UO','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'b5EHzTpiNj','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(9,'L9QX1CUFsFk',NULL,'mr. jordy fisher i','kiana.nitzsche@example.org','$2y$10$S6XZyMAIYan5jFLbFNZCmOskwKfGGl4TOmZOZDBuCHrKqIinLatAq','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'krDZY9430U','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(10,'szvWGbqyOCN',NULL,'gladyce kertzmann','aufderhar.esperanza@example.com','$2y$10$9Ei4HYix4vMmW5wqUbBQ/.bT3qBYSweFPrKJHTZD3.21s7DYLRgT.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'tVnoASa2ap','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(11,'lyw3dLgZG1F',NULL,'jayden marks','kilback.christiana@example.org','$2y$10$TpwIKd21gpG5RupYZ8s92uM9oCA8QcdrpQXlTA3KCI8KQBhrAEDO.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:19',NULL,'trial',NULL,NULL,NULL,NULL,'Ei8fovqwXj','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(12,'9MldU2ipCGz',NULL,'aimee mcglynn','xklocko@example.com','$2y$10$RuIEvE9PzFEknGBJmt4rBOFvj/p8nD3ygRCWsIDyxxDn.GHWn47Wy','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'pW3zPLAiu3','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(13,'RZLFkxwC0S8',NULL,'domenica dubuque','fhauck@example.net','$2y$10$4BwS/NsZI.4O6SekAWDTJ.HnNqxHhMVT2AR9r0dJKZt6BeTyPYiOC','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'VLVAbwYpKS','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(14,'hTj62sSkeX2',NULL,'dr. beau blanda phd','uweimann@example.com','$2y$10$SQ21STrzWQR2CMTnF.TtO.sUhv4v8yKNMZDLLJnin/v2om/hHnQtO','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'pVT4IGgIF0','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(15,'OpceRCAz8jA',NULL,'drake roob i','millie.ward@example.net','$2y$10$x8vb55LaxeQp.x/cODju7exqi5sdMG5NDucrEYNr4tmeO/o5GecOu','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'liZ85tYcvN','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(16,'qBWLNqLXUSE',NULL,'dr. sherwood casper phd','elwin.schultz@example.net','$2y$10$bVfEcp6dqBaQIIGYvtZ1guPSvZ1uVyLgOwBpCZQtXHh/H7iKwwUqq','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'KjGqvlnKUY','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(17,'TKrPckJK4w8',NULL,'odie reilly','ruecker.eugenia@example.net','$2y$10$MpVxzpazvxjCOXdBLQEqouWwQ4lPJs9OQJvWyPIVMZRM86QCPKBZG','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'M5OSyLg7gf','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(18,'gz3VydAxvg2',NULL,'napoleon stoltenberg','melvin.little@example.com','$2y$10$GnnoGibrJtUqQUZdmZgzGufpQvCTa9XfffC8xn5cax2D8UrAHpGdC','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'CgHVqmMV7s','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(19,'eu1T8YXQIsd',NULL,'ursula hermiston','liza.macejkovic@example.org','$2y$10$yctk/M/WZCyoxICLWnCpWeBzBrv6GOf5MwXUkkIK5eB1Pm0PqkjbK','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'HTEDwgpFZt','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(20,'ELw9g1SVLYq',NULL,'dr. bradly ortiz dds','tracey.koelpin@example.org','$2y$10$rS5UYx0mOFSGcD/n9/bTr.L.e98ySxCfTvMNxRYTPOaHOoCneef1C','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'Ils6L9FUqt','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(21,'90qes1moGC9',NULL,'bernita hilpert','desiree69@example.com','$2y$10$2codyLTtjxAT7UkPQKfmpORvY6iEhGOSwRb9FmpjETEMbLbNKWl8q','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'Inej9xVVFA','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(22,'B4EBLG0HXj4',NULL,'miss shawna reinger iii','ewiegand@example.net','$2y$10$nq6W0u4iPIGtJbQpFPDM3uuAPtzQ0LDQuovVtYzNlTCM5vYRSS1V.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:20',NULL,'trial',NULL,NULL,NULL,NULL,'pDnwLP4Wp3','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(23,'3pn0vp2WZnh',NULL,'dr. nichole schuppe','hdubuque@example.com','$2y$10$hNv9SHFvaRtNN1NwWmv7lOpwO692g3zLWk2P/xhJKjLCwxQ2JhpDu','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'WDvREkK7mk','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(24,'uCSgk4Vskug',NULL,'cornell stanton','tyson.murphy@example.com','$2y$10$AhTElN9nSpU5dI3Jmb80J.B.jNYYkl29cv/cfkQScdHMwo7o1qaM2','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'Cs5mvo6qRN','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(25,'TQgddaDS084',NULL,'alvena fritsch','annabelle67@example.com','$2y$10$1ASTgy.jgIsWu8abGDUnb.8RguJxu3.7azYAlsEqi8ojkhKGOiusa','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'wEhsLXQWJI','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(26,'EW6jpFEZA5E',NULL,'dr. ron gibson v','maggie97@example.com','$2y$10$dl3uTLJxRK0Alz0rzUHrOegZ1f1bDE4SJClK08pKgVs6RwRdfcIxW','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'cK3HwlM8dF','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(27,'7QVj0gkQWeM',NULL,'ms. wanda reinger phd','terry.lehner@example.net','$2y$10$PId8FPGIr6f68K4/6FwGRuPDmg92vRsNqmlOeCTH77n.880RanYy2','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'FGCTv8WFaS','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(28,'Nwnl9tXgbpT',NULL,'dr. harold feeney','zella26@example.org','$2y$10$1qOfrOHq3E07TWj87xZ6vut67FiL8033rk7Al.VcmnorOANWD5Psy','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'sNhW1S5QYy','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(29,'0t9f36xWeKK',NULL,'tremaine waters','velma.waelchi@example.net','$2y$10$Yd.9dd7DSnvfga42Gz5RYeS8CNt5eG9OE0hk2fCC4Og1kBTHZgGii','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'TtacEXowj9','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(30,'JntaIGtyux2',NULL,'eleonore torphy','qbartell@example.org','$2y$10$v0BdKhJPaLZS14PMvlrnAOR8p7IWZzZ4eVwMCjtE.qVMsWfoOLsGq','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'1JMr2wwQaW','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(31,'y6PQstcXqdu',NULL,'elody vonrueden','ayana.mcclure@example.org','$2y$10$Qyz.qgMKPhOVlDZIOaQTPODEhhmSEmsF54V0JuZ8AVSFzOCHU/NJ6','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'rFUoiToW7H','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(32,'RWNUm5akQ49',NULL,'alana tromp','mckenzie.mortimer@example.org','$2y$10$0y2yzR0jHcCm1gaRt7h32..EXGVvjtCO7iTvmUz/Rm.0PDLxyRlQK','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'bg0AAOuiBt','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(33,'WNsQ5ipbT4b',NULL,'hellen farrell','kosinski@example.org','$2y$10$j87A443OGddaModR3Jdb8eOwNaR0826rTIXHKqe4spHxY8Hg9YCEW','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:21',NULL,'trial',NULL,NULL,NULL,NULL,'x8XD7LUpJU','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(34,'XRa2T8sFXpO',NULL,'ms. joana parker','grohan@example.org','$2y$10$g.qFAOPBKTTb7dgDobRrcupzNZOI9ebRRfblS.7i3/0zeYTjrSPgG','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'TncMpd18W1','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(35,'erhBEIPA6Af',NULL,'arnaldo swaniawski','alia.heller@example.net','$2y$10$V8So8XFr0eWTvmJbWmsEf.YUCC3X4M587JXbWU7KgiIfyZFRxVIpC','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'H6j36SJA1f','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(36,'CoUkigmOAf1',NULL,'merle langosh','reinger.miles@example.org','$2y$10$eHN0cc4090IVVrY3d.k7audNX4MtlRBE2zqQAqZ5HOegDwX3.RR9e','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'0FJKZwvm8Q','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(37,'2rP7bm37LLS',NULL,'luther kunze iv','hope61@example.com','$2y$10$uiGazrtkl003ug1u2IH9KuRgusiajX5x311dZMl6GpbLIgCJ2XDt2','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'RTnMeM0lLz','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(38,'0exqWSKZC6O',NULL,'mason zboncak','gutmann.marta@example.org','$2y$10$E/BqIeVw/nd.CGjSbv3zguL/vd8O8li8kImo0jWjkWnFLkSIHNzK.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'pdd0JyURVe','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(39,'y3zcd2FyVNY',NULL,'dell mcglynn','showell@example.org','$2y$10$d2e241Opo9Mex4W5qGKEp.a9cVT6krFUGLDJ/5ABwVkaozgBSWcc6','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'uboRujKiEQ','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(40,'TtdXZ4ZImwj',NULL,'kendall reynolds','micah28@example.com','$2y$10$O3YadhIomlcuJvDsXi9O0Osu6gastEDjkux5z7Uk0gWQuzLQNKCMS','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'pDoS1Vd8Ns','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(41,'62pHDNeEqeZ',NULL,'elvera becker','destiney.schumm@example.net','$2y$10$5oASgS0GdF.ab40Q/nyVu.I/oXfHZYGHWstsabyCNDGR7ctWyaaiC','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'IJpDlwDbuE','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(42,'zmQBBQvRPKZ',NULL,'pablo gutmann','ivah.rempel@example.net','$2y$10$QAj6weLOSNsUFxn7iASmK.KxlZEeopzf0RdJn7x5gZ7VHDE7B6DrW','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'R59NIutfRK','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(43,'ZDP6YaBmftT',NULL,'prince hermann','bartoletti.alison@example.net','$2y$10$rbuf12.TFsDy4pFk2BW8Bum7gli7BSfZSPX2XGVTMVUwGxRFQdJmi','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'Vq7V5eoTgq','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(44,'bMNHJLdakpi',NULL,'riley gislason','loren.rosenbaum@example.net','$2y$10$Zvulcv/fcbLbu.y/LjD8r.cTv.y4MAFCm.hji87/He9HZ8KjCychu','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'wMuACahHIm','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(45,'v79I1LGtJuj',NULL,'ian turcotte','tomasa.wisoky@example.net','$2y$10$Z5Kz.51fWTRwy3b887GPt.eo4p3Qr66ZhZ0wSs8gjhI3g.ieKN.Na','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:22',NULL,'trial',NULL,NULL,NULL,NULL,'zcb7rGJypL','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(46,'hukLJxtcgBG',NULL,'casimir wiza','xkeeling@example.org','$2y$10$C2mxSvEJRhi9bRP2hvUiZuQGD7f8sicHaXwGuRYtmWo8xvoAWXnlu','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'RCN7P48fGs','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(47,'xROwVBCVJbW',NULL,'prof. dejon mccullough','cruickshank.harold@example.net','$2y$10$VCX6X.Z/NCAAUBjGUjzSduQuInbyzUfhM7syQF4SfdQsSLvX5qw6m','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'OUFXfiGFQD','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(48,'qBpQQh5EUyq',NULL,'isabell murray','akub@example.net','$2y$10$o37KGVp9.om8/ZvOAsW.qeuyTqNVz43bUK31Y0cN0a6vwDZrvTyoa','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'7doCOoH8Eu','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(49,'GHaWoAeUeZp',NULL,'corrine corwin md','halvorson.amelie@example.com','$2y$10$ViThioaCWFnxfYbBZBRJMe1eZq2wq1EgT881BT11twMYU3aQ.REdW','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'QxSY5NUKD6','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(50,'FK2loCWA912',NULL,'dr. stone streich','janie62@example.net','$2y$10$lhNqCTQKA2Isbo45xPoyzORCL227znnAMJOrTNuRkf35peNGtReGK','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'CpvUGabeYL','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(51,'MP2owzB7Le4',NULL,'fiona collins','xconroy@example.com','$2y$10$H0prHBvk603hJG6bEzqWce1maj88mQ6hezPyXTcdTUqWjnRA4uB3e','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'basMiV3kXc','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(52,'k5ABNYeRFVm',NULL,'prof. hassie jacobson','maxime.ritchie@example.org','$2y$10$dCnIf.0hFDbQFLUowZs.q.O2VsGa2x34QMXuuJvyWdnp7rcQyIP5O','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'CDfuzgxVfd','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(53,'ZuAZHTEIcjl',NULL,'dr. halle reilly','fredy04@example.net','$2y$10$pQfx6o9ZqUTzYwNTj8I4BOtEQNjZJAcNHftYGiHqbCjxzkeSONa.m','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'vBPHUrdnkC','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(54,'E6ejgkrAi34',NULL,'viola wehner','leonor19@example.net','$2y$10$lwrxsCiI5gNVxMGeZlOe5OdHslv.EVBNoLjQYAbFT1HMLxvHEiln6','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'nMUcZOvXqs','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(55,'BATYhFvspXA',NULL,'miss paula kassulke','xvon@example.org','$2y$10$BRmjN8jcqLmwiUtLSHehgumw4rBFhvcio3.Nt0zKVTNMiq6t/ee4K','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'zD18m3iuSd','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(56,'kFzE1xojzdZ',NULL,'ardella witting','brown.janet@example.net','$2y$10$v2DyRjPTg3H1Pd3ldjYN0e/hgiUuppnKvWPFnF0j2kCsLNXSn9MFq','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:23',NULL,'trial',NULL,NULL,NULL,NULL,'HqdVwRgkCx','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(57,'b2nqH7cBv0D',NULL,'catharine crooks','dahlia.hermann@example.net','$2y$10$Ap.TffM5oofF3FVCvc0nsOT8dtze20IzfM9G/dOrb9ysRI.CZI0Bi','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'Y4c5vxx8OD','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(58,'fk382TGalAT',NULL,'lionel gorczany','cletus16@example.com','$2y$10$UPCnumOSnTJcwn07SItsk.5Jd0apKqhB03Rzf/uEAyIxqSuXho4Za','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'txgbH7Ymj6','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(59,'75dOGO09IBm',NULL,'jordan schaefer','meagan.hauck@example.org','$2y$10$ij7JAnZa.8MOICQy.V1ZAeQ.1eqci4wKIO7rjL1b6oXG/6hwMBFDy','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'gHgeiVLfDZ','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(60,'Wcg22xGMyLG',NULL,'mrs. esperanza feest','yheathcote@example.org','$2y$10$0OqpGEnplu2o48xzxvDJiOu47IDcFnFLIWtY3suJ6iOYH9WrGbIxy','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'oa2UN5uU1J','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(61,'PaDUzuodk0v',NULL,'cyrus bayer i','brooks53@example.com','$2y$10$WHTI43wezFWTWEfp5zolC.BlxdmzEWSwcZlVIPdOdYfoiI954XYk6','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'p67BonkhrN','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(62,'SGMtmIzAGyR',NULL,'prof. genesis gislason jr.','everardo20@example.org','$2y$10$9pA.1x7v7TA/4mkGN.xxJ.okeSCmwZrHlhvWZO/GAi57K5smDl65.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'mQF1korV60','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(63,'xjsNeBouQms',NULL,'prof. elta hoppe md','vwolff@example.com','$2y$10$zNKvvBfl8f2zZb2j5jMbiOoUpFOTsnALn4aUGdzoyzR8WD2rzPPGS','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'Am2yfhjAtC','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(64,'CJOH2JCeb6u',NULL,'miss susie weissnat i','gwitting@example.com','$2y$10$5vRpYybVPPQEcg.o5X4/juZmAYzbMuSjITtggbhB56Wn0UnT7OgNy','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'41kofXdug8','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(65,'bJY7V9VsQhD',NULL,'kara crooks','halle.lubowitz@example.com','$2y$10$6Z1SJnAT7Rc/yK.wUmLSZeFkyCbY0qkQObByTLcMcIa8.IxnMWIE.','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'SAFKqewljd','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(66,'HWzL5xmeLh9',NULL,'prof. hillary gottlieb ii','florida.johnston@example.net','$2y$10$ZlVOjZzSk10vDxaItZ35Y.PvLuCn69QzBxFtkJXrGz.iFq9rk7E.K','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'6uHLj9uJCQ','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(67,'7qOtP9RCYJi',NULL,'prof. layne dietrich iv','laila39@example.org','$2y$10$SxitWmBQzr8Up/pJ/8SiR.W1rOjlS7i9bvDpNeCEL5OJCXlIqtPTO','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:24',NULL,'trial',NULL,NULL,NULL,NULL,'fgbF4P5y5V','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(68,'sqHx3oT8ipg',NULL,'percy mccullough','ila60@example.net','$2y$10$Jzp5e4uEsOCimB34S5hAguFNfwpOEhfmXmJrXVFwPLL2LLuu33gmK','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'WAhJK6hYb1','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(69,'OOnNY36gIaX',NULL,'kacey rowe','schaden.austin@example.net','$2y$10$AJGOKctyqu5Nyi2pfOc6WOX6nKeS43wri6V2nEEB9idpRODTevNlm','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'IQDZ7pESuz','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(70,'C3qf2PSwDhq',NULL,'kraig strosin jr.','hintz.arch@example.net','$2y$10$ZUAL82fPAI1kA1nKsqEZ..JkCHhhAODebHqaCit5tIWeMjLbqqryy','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'iSe0ADypFz','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(71,'6krPz46tBrv',NULL,'elsa fay md','edison.conn@example.net','$2y$10$7hQyMhvsTWMCsK.VTqkTBexh2KYio32QrrdCY2Pdn/UXPfVo64kDu','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'tjQv5HHhEt','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(72,'hLvsbH0Xft5',NULL,'christophe zboncak','beau73@example.com','$2y$10$WPYFSS4Kl9SwOHCldnZLFuPqaMd9BQFDdrTkPGF2a.ZM.vvtNN49a','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'2jfpssnSiA','2017-09-15 17:18:27','2017-09-15 17:18:27',NULL),(73,'cV8HwScRRus',NULL,'prof. kendrick lueilwitz','maud.schmeler@example.net','$2y$10$fFy12m9Xhze.aBvcTXHdc.A0Loqs1TETlPVS3wt6FvcQjm8T4Pneq','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'AQtqe49EO1','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(74,'91zCDox3DfY',NULL,'danny yost','smith.lloyd@example.com','$2y$10$f4gwvl3gZMcZAb2QvJui7eUjvs9wyHUtJOHkJOFau/JZs6aQoytqq','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'1bgAUEt92b','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(75,'bDxM0lak4Fr',NULL,'wayne hessel phd','bill.oberbrunner@example.org','$2y$10$4tZtdi4.Gi.eKpPch7QoQ.9J0AzWVY/BYmMCQTnCLru58FkzWzCKu','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',2,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'Rc3446OKxO','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(76,'ngyStTpMLws',NULL,'bud ledner md','janice.paucek@example.com','$2y$10$SslcIKCt6cTIJnTexRrPFO1YjatmEX68h6zHd5dBnoRp9LwPo6MZa','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'Cu7LKcmFOu','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(77,'TybvkHk3WUt',NULL,'jedediah leannon','kayley.quitzon@example.net','$2y$10$snl7Rwv72w0xaKKUSfY6hO1OZPEpncGR4rcQB0bWaAPvrQfREe0h6','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'oK5CEwNwYU','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(78,'UXBwL6gOfkA',NULL,'nichole nader','jemmerich@example.net','$2y$10$i7GSQ403yXju7Y.iDpXEZeh/3chAG7Ccmgpz.YKDzRp4dLJn2/qVW','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'2XPhWxc7lg','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(79,'syP5nZwVcYj',NULL,'nettie lueilwitz','oreilly.ernesto@example.org','$2y$10$nAEbVwdNy0GGijsyBPBX3OUC6mNhIm9/zDuL8W18WgWZcDrSmooGa','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:25',NULL,'trial',NULL,NULL,NULL,NULL,'shkQ1Znugw','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(80,'ulKVsSAtlEf',NULL,'arlie monahan','jaydon.schmidt@example.org','$2y$10$.vAX.laYx39FJ0DhNN1TNe.VdfBkwmH3ml/Jq6aewnrs9OiLGEyyq','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'otzpeLneu6','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(81,'oc4IwPfu56E',NULL,'estelle hettinger','zetta.bradtke@example.org','$2y$10$7J2tJfr3E2uBQp9zwCfBwu4/CAPVrv8zeQKKeGpK5vF/GxGmslN/m','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'GIoW3cvI96','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(82,'XX98T7Bhu8B',NULL,'felipe hettinger','fcorkery@example.com','$2y$10$fvryeaBwYEyZgTzVbxHx5uvrv6bKv4uUmdrkbOTOr/K0mn8LvRt.C','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'hdbePKjpcE','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(83,'4pcmSTdRVZM',NULL,'dr. deion cremin','schroeder.hayden@example.org','$2y$10$7XZvbfQjhQfYRFLRLN.hCutzH/DUeuHU02Qo2ld/B4ouTF2KajtGC','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'4xHKjOyG9L','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(84,'r0NhxtMzs2L',NULL,'karli deckow sr.','wbatz@example.com','$2y$10$U.8d82cXIgxSpu4ThPc4v.1q4X/aoZdpiVe0AHiLbUXeVoZmvbIvS','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'tRqETjfvn4','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(85,'qdEPvp968CR',NULL,'mara ullrich v','kmills@example.net','$2y$10$YS.Tre9bVM2w4fAzYeQx/.r3nllgRiviUsoQTy5h.ytVKtB1qNO52','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'0WYUG8fzMz','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(86,'R6bMcuzzXTe',NULL,'emely hagenes','lonnie45@example.com','$2y$10$zs98pnLBkwdFXh0li7GKiu3XMu71kiDHDlXSimyP9Nh04Grn3PQVy','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'FfMtb4bRCN','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(87,'HjMVHFY3j61',NULL,'madge hickle','ofahey@example.org','$2y$10$gyMTVnoPcC9ykLO0kokQ3.6XTGwgiBJ4jbAsQd5nhTN1H7yR3QXSy','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'HQx57CSNp0','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(88,'4BIAAcbQkx3',NULL,'oma ernser','myrtie.shields@example.com','$2y$10$s2L2r0Yk4/2hXXQ7C8r1O.ulX7hBehSyRXz7WO.30feq03pz/uH.u','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'Yyvqx81jUW','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(89,'tYK8X4qAQLd',NULL,'anissa raynor dds','jleuschke@example.org','$2y$10$Aq1Qi5ivDNt2e2NtLeGeyO1EZ2ZYW3Qf490LHCwCz5ajvsQeJ7giC','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'zVF7gSaMdG','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(90,'7WF1XquAPwl',NULL,'lonnie d\'amore','thompson.beth@example.com','$2y$10$e8yO3RTQB7qoIuL9YsqXdeQRLbKZUewVgoo3e0f/7jgq57FlsBSwG','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:26',NULL,'trial',NULL,NULL,NULL,NULL,'PLbGECxGrk','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(91,'WUAqcJroZ88',NULL,'nicolette nienow','goodwin.vincenzo@example.org','$2y$10$QnuVRQIlEhn7THUVaAyf..WiotI3qaj92bRT9WW.T2wi7E9uRuJGO','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'eTH3x6rvkA','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(92,'0qFURNhr2sq',NULL,'fae schuppe md','greenholt.kelley@example.org','$2y$10$URCVlgyrexXcSxsmII7qR.CmOpox//zXo/q/IV0001sh91YWTvEXm','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'4zB3GiDgyd','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(93,'z78m91Dd8FF',NULL,'jarrod prosacco','anissa.mosciski@example.com','$2y$10$TgnHGnZ582TzIvzgOgDYb.rSQTp7px.mLox1TuBVoa3b2Y0X2q7Ye','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',4,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'EZUB0M74T8','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(94,'h52Zg4EM0kb',NULL,'armani torp','sauer.estevan@example.org','$2y$10$DwCWDOQqi7fHjFi11dzIOuCsxsusW28wf0G35BNAsmwsVmwIJgLx.','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'VquV1w3uWo','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(95,'fpSFS17v7kw',NULL,'hudson gleichner ii','nlowe@example.com','$2y$10$aw.wGXZhcgGbJkiaNZqH0eR5Wfc97rdjUdb4rwnlwmWRVgYfK3MVe','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'jndYlvthje','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(96,'Gqoqvsrv8uU',NULL,'tania kshlerin','rschmeler@example.org','$2y$10$4S2UMlodB4JpEZQ3BZK1M.0mgaH97Tzg7u9jnyuUuxGlOp4tPiT1u','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'V76v8ef1iU','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(97,'rbPHBqlo5Lu',NULL,'prof. casper koelpin sr.','annie.murray@example.net','$2y$10$8r6Bs6Js709ec2h/lwShdOPaKgzVIQNRqLgVyN1.9zWtAgqXy49LC','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',8,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'NvVllJRzlL','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(98,'js8jO4D2hrQ',NULL,'mr. jaron kuhlman','pbahringer@example.org','$2y$10$IWiI9UrRFhlivoy0MxB/JOqUA8pXl.ClEl6OKRToj12Soi.8c3kXS','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'zOZTXbkFaW','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(99,'VI1duGAhQEJ',NULL,'rosina boyer','anthony30@example.org','$2y$10$LoEpuVL4ousoBxwMp9Vog.872gS3g0tSI7bREmHRUmTAvnOhjiIue','0','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',6,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'y0bCsDWCZy','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(100,'jrPR7jlRFZu',NULL,'daphne becker','clarissa.reinger@example.org','$2y$10$Nl5wSCPE9m1d.TcgZ98eRORR2wZlz9mLfyxhLE9nCHFPpW9X3tWv2','1','085721024770',1,1,-6.905365,107.615779,'pp.jpeg',NULL,NULL,'1','0',10,'2017-11-14 17:18:27',NULL,'trial',NULL,NULL,NULL,NULL,'DEUp40rw55','2017-09-15 17:18:28','2017-09-15 17:18:28',NULL),(101,'U0000000001',NULL,'shiloh','shiloh@example.com','$2y$10$rlOtOEKITF6VjvaCdzjZy.GEzbJsTs5XXduRcF8zOwITQhZB4hyBK','0','085721024770',1,1,-6.892254,107.583107,'pnuk994WtqpMqWudlkMUv7pJf71A2W1Oy3ZBlOF7.jpeg',364053,NULL,'0','0',NULL,'2017-11-14 17:19:55',NULL,'trial',NULL,NULL,NULL,NULL,NULL,'2017-09-15 17:19:55','2017-09-15 17:19:55',NULL),(102,'U0000000002',NULL,'cumi','cumi@example.com','$2y$10$LQNy1o/hmlPZ1JmK3EFgjus.JMKgesX6yVQhGtDg79Y/OZu7d7tEa','0','085721024770',1,1,-6.892254,107.583107,'XGEROxiCCT5njcKjphCnEHKkBmi44mRzBqm38bmt.jpeg',937478,NULL,'0','0',NULL,'2017-11-14 17:20:18',NULL,'trial',NULL,NULL,NULL,NULL,NULL,'2017-09-15 17:20:18','2017-09-15 17:20:18',NULL),(103,'U0000000003',NULL,'bandeng','bandeng@example.com','$2y$10$bi2fN3cKOE5F9laVG7Nob.tUuruGE5lzEvHeD6zanKo1zWu4ZsnyS','0','085721024770',1,1,-6.892254,107.583107,'AmDrNfUs0ygXxhYQtmSD31KIh5tb3amdLx3jKcwM.jpeg',128018,NULL,'0','0',NULL,'2017-11-14 17:20:33',NULL,'trial',NULL,NULL,NULL,NULL,NULL,'2017-09-15 17:20:33','2017-09-15 17:20:33',NULL);
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

-- Dump completed on 2017-09-27  2:20:34
