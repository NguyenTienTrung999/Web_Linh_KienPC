CREATE DATABASE  IF NOT EXISTS `weblinhkien` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `weblinhkien`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: weblinhkien
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Logitech','brands/egSzyPiRyPKAuMI8lrqVbQeYj0eIIygQZSMPULhz.png','2026-04-27 02:29:57','2026-04-27 02:29:57'),(2,'Asus','brands/uXDI6DzwUZ2hLX6x53fznGUra0wm7oxv92Jy4PKb.jpg','2026-04-27 02:30:06','2026-04-27 02:30:06'),(3,'Razer',NULL,'2026-04-27 02:35:14','2026-04-27 02:35:14'),(4,'SteelSeries',NULL,'2026-04-27 02:35:26','2026-04-27 02:35:26'),(5,'Corsair',NULL,'2026-04-27 02:35:36','2026-04-27 02:35:36'),(6,'HyperX',NULL,'2026-04-27 02:35:47','2026-04-27 02:35:47');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Chuột','Các loại chuột máy tính gaming và văn phòng','2026-03-15 02:34:07','2026-03-15 02:34:07'),(2,'Bàn phím','Bàn phím cơ, bàn phím membrane cho gaming và văn phòng','2026-03-15 02:34:07','2026-03-15 02:34:07'),(3,'Tai nghe','Tai nghe gaming, tai nghe không dây, tai nghe có mic','2026-03-15 02:34:07','2026-03-15 02:34:07'),(4,'Loa','Loa vi tính, loa bluetooth, loa soundbar','2026-03-15 02:34:07','2026-03-15 02:34:07');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(15,2) NOT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `min_order_value` decimal(15,2) NOT NULL DEFAULT '0.00',
  `usage_limit` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'TECHFLOW10',10.00,'percent',100000.00,100,0,'2026-04-29 14:07:18','2026-05-10 14:07:18',1,'2026-04-30 07:07:18','2026-04-30 07:07:18'),(2,'FREESHIP',30000.00,'fixed',0.00,100,4,'2026-04-29 14:07:18','2026-05-10 14:07:18',1,'2026-04-30 07:07:18','2026-04-30 07:58:52');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_available_at_index` (`queue`,`reserved_at`,`available_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000003_create_categories_table',1),(5,'2024_01_01_000004_create_products_table',1),(6,'2024_01_01_000005_add_role_to_users_table',1),(7,'2026_03_15_093255_add_username_to_users_table',1),(8,'2026_03_18_081751_add_details_to_products_table',2),(9,'2026_03_18_082549_add_gallery_to_products_table',3),(10,'2026_03_25_200000_add_phone_and_address_to_users_table',4),(11,'2026_03_25_200100_add_slug_to_categories_table',5),(12,'2026_03_25_200150_create_brands_table',6),(13,'2026_03_25_200200_add_brand_id_and_slug_to_products_table',6),(14,'2026_03_25_200400_create_orders_table',6),(15,'2026_03_25_200500_create_order_items_table',6),(16,'2026_03_25_200600_create_reviews_table',6),(17,'2026_03_25_200700_create_wishlists_table',6),(18,'2026_03_25_200800_create_coupons_table',6),(19,'2026_03_25_200900_create_settings_table',6),(20,'2026_03_28_112818_add_sale_price_to_products_table',7),(21,'2026_04_19_075936_update_orders_table_for_guest_checkout',8),(22,'2026_04_19_101122_add_birthday_gender_avatar_to_users_table',9),(23,'2026_04_19_103000_create_user_addresses_table',10),(24,'2026_04_27_131949_create_notifications_table',11),(25,'2026_04_29_132419_add_warranty_period_to_products_table',12),(26,'2026_04_29_171500_change_price_columns_in_products_table',13),(27,'2026_04_30_140023_update_coupons_table',14),(28,'2026_04_30_140024_add_coupon_fields_to_orders_table',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('20750f7d-ef1d-41f7-994e-30fc32d90fd6','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":8,\"status\":\"processing\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #8 c\\u1ee7a b\\u1ea1n \\u0111ang \\u0111\\u01b0\\u1ee3c x\\u1eed l\\u00fd\"}','2026-04-27 06:26:39','2026-04-27 06:26:00','2026-04-27 06:26:39'),('295b4116-5556-452a-9c98-e70a037f391b','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":9,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #9\"}','2026-04-27 06:54:22','2026-04-27 06:51:57','2026-04-27 06:54:22'),('2d4f0d94-eff0-4d62-b2f3-a22d425a63c6','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":12,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #12\"}',NULL,'2026-04-30 07:58:10','2026-04-30 07:58:10'),('375e5770-08ce-4468-af09-fa56ec6d79b4','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":9,\"status\":\"cancelled\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #9 c\\u1ee7a b\\u1ea1n \\u0111\\u00e3 b\\u1ecb h\\u1ee7y\"}','2026-04-27 07:11:48','2026-04-27 06:58:51','2026-04-27 07:11:48'),('401632a2-2fbb-4d48-939e-0c1acc50a43d','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":13,\"status\":\"completed\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #13 c\\u1ee7a b\\u1ea1n \\u0111\\u00e3 ho\\u00e0n th\\u00e0nh\"}',NULL,'2026-04-30 08:11:27','2026-04-30 08:11:27'),('4600dca2-37c2-4e00-8d1d-e7e131cbf606','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":8,\"status\":\"cancelled\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #8 c\\u1ee7a b\\u1ea1n \\u0111\\u00e3 b\\u1ecb h\\u1ee7y\"}','2026-04-27 06:48:43','2026-04-27 06:48:34','2026-04-27 06:48:43'),('5a54a33e-32b9-4c5d-b698-742153c3b7d5','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":8,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #8\"}','2026-04-27 06:46:19','2026-04-27 06:45:11','2026-04-27 06:46:19'),('6e2e2326-a3c1-4ffd-95a3-8b46c3d077c2','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":11,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #11\"}',NULL,'2026-04-30 07:57:30','2026-04-30 07:57:30'),('8c89aaee-2e0d-41f8-ad39-8204fa86a2c9','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":10,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #10\"}',NULL,'2026-04-30 07:50:50','2026-04-30 07:50:50'),('9964f0e7-805f-4dea-b61f-a8edb5743cae','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":9,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #9\"}','2026-04-27 07:11:48','2026-04-27 06:58:56','2026-04-27 07:11:48'),('a0a12b6b-7176-4f98-9b19-b065352c70d7','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":9,\"status\":\"processing\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #9 c\\u1ee7a b\\u1ea1n \\u0111ang \\u0111\\u01b0\\u1ee3c x\\u1eed l\\u00fd\"}','2026-04-28 06:07:02','2026-04-28 06:05:45','2026-04-28 06:07:02'),('a568e797-3844-4583-9412-8972b89506fb','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":10,\"status\":\"completed\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #10 c\\u1ee7a b\\u1ea1n \\u0111\\u00e3 ho\\u00e0n th\\u00e0nh\"}',NULL,'2026-04-30 08:11:38','2026-04-30 08:11:38'),('a5a82d07-56e6-4068-b502-bcbceeacc530','App\\Notifications\\OrderStatusNotification','App\\Models\\User',3,'{\"order_id\":13,\"status\":\"pending\",\"message\":\"Ch\\u00fac m\\u1eebng! B\\u1ea1n \\u0111\\u00e3 \\u0111\\u1eb7t h\\u00e0ng th\\u00e0nh c\\u00f4ng \\u0111\\u01a1n h\\u00e0ng #13\"}',NULL,'2026-04-30 07:58:52','2026-04-30 07:58:52'),('b3d7e499-911d-4791-9079-999e2eebb597','App\\Notifications\\OrderStatusNotification','App\\Models\\User',4,'{\"order_id\":9,\"status\":\"completed\",\"message\":\"\\u0110\\u01a1n h\\u00e0ng #9 c\\u1ee7a b\\u1ea1n \\u0111\\u00e3 ho\\u00e0n th\\u00e0nh\"}',NULL,'2026-04-28 06:20:18','2026-04-28 06:20:18');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,16,1,7000.00,'2026-04-19 01:37:56','2026-04-19 01:37:56'),(2,2,16,1,7000.00,'2026-04-19 01:42:40','2026-04-19 01:42:40'),(3,3,16,1,7000.00,'2026-04-19 01:45:46','2026-04-19 01:45:46'),(4,4,16,1,7000.00,'2026-04-19 01:52:28','2026-04-19 01:52:28'),(5,5,16,1,7000.00,'2026-04-19 01:56:27','2026-04-19 01:56:27'),(6,6,16,1,7000.00,'2026-04-19 02:09:41','2026-04-19 02:09:41'),(7,7,16,1,7000.00,'2026-04-19 02:56:28','2026-04-19 02:56:28'),(8,8,16,1,7000.00,'2026-04-19 03:34:30','2026-04-19 03:34:30'),(9,9,16,1,7000.00,'2026-04-27 06:51:57','2026-04-27 06:51:57'),(10,10,16,1,7000.00,'2026-04-30 07:50:50','2026-04-30 07:50:50'),(11,11,16,1,7000.00,'2026-04-30 07:57:30','2026-04-30 07:57:30'),(12,12,16,1,7000.00,'2026-04-30 07:58:10','2026-04-30 07:58:10'),(13,13,16,1,7000.00,'2026-04-30 07:58:52','2026-04-30 07:58:52');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_id` bigint unsigned DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_coupon_id_foreign` (`coupon_id`),
  CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,'trung','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:38:00\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:39:00','2026-04-19 01:37:56','2026-04-28 07:10:44',NULL,NULL,0.00),(2,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','banking','vĩnh long',NULL,'2026-04-19 01:42:40','2026-04-28 07:10:09',NULL,NULL,0.00),(3,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:46:00','2026-04-19 01:45:46','2026-04-28 07:10:34',NULL,NULL,0.00),(4,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:53:00','2026-04-19 01:52:28','2026-04-28 07:10:20',NULL,NULL,0.00),(5,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','cod','vĩnh long',NULL,'2026-04-19 01:56:27','2026-04-28 07:10:03',NULL,NULL,0.00),(6,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','cod','vĩnh long',NULL,'2026-04-19 02:09:41','2026-04-28 07:09:57',NULL,NULL,0.00),(7,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','cod','vĩnh long',NULL,'2026-04-19 02:56:28','2026-04-28 07:09:51',NULL,NULL,0.00),(8,4,'Trung','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'cancelled','cod','Vĩnh Long',NULL,'2026-04-19 03:34:30','2026-04-27 06:48:34',NULL,NULL,0.00),(9,4,'Trung','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'completed','cod','HCM',NULL,'2026-04-27 06:51:57','2026-04-28 06:20:18',NULL,NULL,0.00),(10,3,'Administrator','admin@techflow.vn','0329346849',30000.00,'completed','banking','Vĩnh Long','\n[SePay] Da thanh toan 30,000d luc 2026-04-30 21:52:00','2026-04-30 07:50:50','2026-04-30 08:11:38',2,'FREESHIP',7000.00),(11,3,'Administrator','admin@techflow.vn','0329346849',7000.00,'pending','banking','Vĩnh Long',NULL,'2026-04-30 07:57:30','2026-04-30 07:57:30',2,'FREESHIP',30000.00),(12,3,'Administrator','admin@techflow.vn','0329346849',7000.00,'pending','cod','Vĩnh Long',NULL,'2026-04-30 07:58:10','2026-04-30 07:58:10',2,'FREESHIP',30000.00),(13,3,'Administrator','admin@techflow.vn','0329346849',7000.00,'completed','banking','Vĩnh Long','\n[SePay] Da thanh toan 7,000d luc 2026-04-30 22:08:00','2026-04-30 07:58:52','2026-04-30 08:11:27',2,'FREESHIP',30000.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `stock_quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `specs` json DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `gallery` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,1,4,'Chuột không dây Logitech M331',NULL,390000.00,NULL,'products/XCfwbfFRCFtHBNeoEdjHUIVFKW8vAFEpUY1kdar2.jpg','Chuột không dây silent, phù hợp văn phòng, pin lên tới 24 tháng',100,'2026-03-15 02:34:07','2026-04-27 02:52:01','[{\"key\": \"Mắt đọc\", \"value\": \"1ms\"}]',NULL,NULL,1,1,'[\"products/cpxgbaSpSKyx5qe1MN5JSD8LUagJ42xhx4irRyEt.png\"]'),(4,2,1,'Bàn phím cơ Akko 3068B Plus',NULL,1490000.00,100000.00,'products/qSXjiHF02LBWAY4VkxP4QLgZeHwoVqVHHuUxb2jV.jpg','Bàn phím cơ 65%, switch Akko CS, kết nối Bluetooth/USB-C',40,'2026-03-15 02:34:07','2026-04-27 02:53:40','[{\"key\": null, \"value\": null}]',NULL,NULL,1,1,'[\"products/fFa8gb0Ga2P9KHoCjhrwRUnwGOaTV3GdbTv9axvw.jpg\", \"products/tepcYGfnvpMkex3vcRQ3Dla6vhjKx8hMI0tEiG9s.jpg\", \"products/Xg8aWGDoh05zs5a1FDjzjxJidlun19VRktaVrVrS.png\"]'),(5,2,1,'Bàn phím Corsair K70 RGB Pro',NULL,3290000.00,3000000.00,'products/sqK7P8zz72uKDStLIfLLVB654XipmMpP5ugK6ToM.png','Bàn phím cơ full-size, Cherry MX Red, đèn RGB per-key',25,'2026-03-15 02:34:07','2026-04-27 02:53:45','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/XwMUrLRDQSxEc0wPslTJTGZIp6OO2IxW5zveSSqH.jpg\", \"products/bRHvXopdWdXZLstgeXRb9YVqH577jCu9M2ONflgC.jpg\", \"products/wfiYz4OrsrznSQBM0bscN1QTh4s4U2biT35I31k4.jpg\"]'),(6,2,NULL,'Bàn phím Logitech K380',NULL,790000.00,NULL,'products/SYNOfyWClVc9a5QX6DIO54MchDYrBPxesxgSuX6M.png','Bàn phím không dây đa thiết bị, Bluetooth, thiết kế gọn nhẹ',80,'2026-03-15 02:34:07','2026-03-28 04:00:00','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/etsxx1HtiypTqc4EOfs2A0fs05VfUU20enu4dI8i.jpg\", \"products/CyR2B0EkPfqA4wr0OSSV4P6HPA8JEIej8dlbsGx3.jpg\", \"products/BpK878NpFabcn7xO9c6ucgA9xqZ09lATzuvahIZe.jpg\"]'),(7,3,3,'Tai nghe HyperX Cloud III',NULL,2190000.00,2000000.00,'products/OPzI5JTLNg0G3MR0HcqTuQs17guOmGOFMeVWSRPz.jpg','Tai nghe gaming 7.1, driver 53mm, mic có thể tháo rời',30,'2026-03-15 02:34:07','2026-04-27 02:36:50','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/0UKQFfUByoqavj2ndB6NiHOPm86Qw0Zm3pUt24n7.png\", \"products/GOGABLrSrCztr44VWKR3LwvUFwDiPlLgEnaLaCCl.jpg\", \"products/UXBsJS7bQNUKOEmXKBGgNBOMoq7Wz5if2EqQsHJg.png\"]'),(8,3,6,'Tai nghe Sony WH-1000XM5',NULL,7490000.00,NULL,'products/dZDA88c3qhPlrkbNg2VvKx1QEDwTYUsxlQrLmu5f.jpg','Tai nghe chống ồn chủ động, âm thanh Hi-Res, pin 30 giờ',15,'2026-03-15 02:34:07','2026-04-27 02:52:20','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/SnlcNPH4afJbbRws3oNNzeI8il1hfOc0P0wPV1PH.jpg\", \"products/iF2ofil3Z4D5XioQhxJ9ghQUmp456s8B8iJ56KYA.jpg\", \"products/4VmFHHR7m4rcrLpKWxxwPu5f6ETBuzTiQ5oNIJal.jpg\"]'),(9,3,6,'Tai nghe Razer Kraken V3',NULL,1890000.00,NULL,'products/bsWjiCz3AbZldmXjglgqKCjCTkkYjfu9ZF4NBVbS.jpg','Tai nghe gaming THX Spatial Audio, driver TriForce 50mm',45,'2026-03-15 02:34:07','2026-04-28 07:44:58','[{\"key\": null, \"value\": null}]','Mới nhất hôm nay',NULL,1,0,'[\"products/OWRy4Dto6om5WoLh6GmfYAILEUmTgJ6j21K4VYyI.jpg\", \"products/LbfYfWL0xwr2dgeDXOS8sO3QtcYc8gxPpmY2HGvx.png\", \"products/oQ6oOHVuXysh1Fc8CErUhfTgzUVXoX1GqBPzq445.jpg\"]'),(10,4,4,'Loa Edifier R1280T',NULL,1690000.00,NULL,'products/R3kltEDoGQVSLgsBI7oG2V38fj2sC0YVLJZwii9h.jpg','Loa bookshelf 2.0, công suất 42W, kết nối RCA',20,'2026-03-15 02:34:07','2026-04-27 02:52:52','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/UwEDdlPuSQGuM6fxb002ycTji8ibCQD5VRyHYIXq.jpg\", \"products/NEvR0WzgrOKKpidNtN0rpVhmHRqLbYjGQzzbHuYL.jpg\", \"products/4cQhLwGNto5TkJSkER9a9yqdxE5qhkmh09IhNOvS.jpg\"]'),(11,4,5,'Loa JBL Charge 5',NULL,3490000.00,NULL,'products/UC8YnLZ5s0PT8KFncpkxWHgSW45ECxHWm5IOiasi.jpg','Loa bluetooth di động, chống nước IP67, pin 20 giờ',25,'2026-03-15 02:34:07','2026-04-27 02:53:05','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/a9l01VL1UQOOxEdEHJA0VpZyIiJ3ydvIXIs2zMD1.jpg\", \"products/keXSXsxBslgx85wBLeAOpKgR58nzkdLWd84PW7Xy.jpg\", \"products/JjtnyohTImigNKbQ6BAMosAEy6C5Eg7xb2KS5BHX.jpg\"]'),(12,4,4,'Loa Soundbar Samsung HW-B450',NULL,2790000.00,2190000.00,'products/tcH7j9OLI7Yw4wQRn7crAFtDmDHsTYaNi35RMd74.png','Soundbar 2.1 kênh, công suất 300W, có subwoofer không dây',18,'2026-03-15 02:34:07','2026-04-27 02:36:57','[{\"key\": null, \"value\": null}]',NULL,NULL,1,0,'[\"products/0wP2Oqn6ZF1XDkjJMTRAeXe3pRubudgT9zZE7i3m.jpg\", \"products/1LeI8jYqaazZP4YJBrSkTvwdBR9bpmJ8aBai7jaH.jpg\", \"products/P8usjadGx3AuflmRAVQgPIlUkBIOPIOkrIcnwhzM.jpg\"]'),(16,1,6,'Chuột không dây Logitech MMM',NULL,500000.00,7000.00,'products/CZckVagtNeMKVsVd8M1uBLVRXpuwDcbjclaKcnjl.jpg','Mới',50,'2026-03-25 05:09:43','2026-04-27 02:51:44','[{\"key\": \"Mắt đọc\", \"value\": \"1ms\"}]',NULL,NULL,1,1,'[\"products/Hdet6UdWyL0lQh1bgEkYcgB3icGy9BEKI6s03RNA.png\", \"products/rlnDWw8tZscSuEfog3x082Aj34PoYrkDhtkaDU7x.png\", \"products/qGGoMfJRYHCLyqrhM8npCeSCGPwKSIoP0yB9Zt3s.png\", \"products/gEGAbUCPiXdl1z71SPkiW72Aif7jKnK4IBbaITAK.jpg\", \"products/YkzFHOnnvPdUQPBkMuDDH37peWrV68B7LWiPAkMO.jpg\", \"products/m0SfpMHSFA3RKeXLtrs9PUGDKDZG86tTtBrGzGGq.jpg\"]'),(17,1,6,'Chuột không dây M331',NULL,4998000.00,NULL,'products/tez25VtiQepx8HrFy8iaVuWMyoCfOHdirRcsqwwr.jpg',NULL,8,'2026-04-19 09:48:26','2026-04-27 02:35:57','[{\"key\": null, \"value\": null}]',NULL,NULL,1,1,'[\"products/J23fzzcTarN3kpFhvm295zNUhoZ4lFM3ZOXFzCnX.jpg\", \"products/vNA2zTxfEWHHRJNc4K6jImdpC7hIOsKuopruDSgK.jpg\", \"products/on7CczfZpeiX6Iwd3RaNygDORZngg6uaGWcyUSGu.png\"]'),(18,2,5,'Bàn phím cơ',NULL,1000000.00,NULL,'products/WQIL973yn9qE9d7kGntn32Iy5FItxyg3sz9rEQKn.jpg','Sản phẫm mới nhất của chúng \r\nVới giá thành rẻ nhất\r\nSản phẩm ngon nhất mọi tầm giá\r\nCó nhiều tính năng ngon nhất',1,'2026-04-27 01:30:51','2026-04-27 02:51:32','[{\"key\": \"Kết nối\", \"value\": \"3 mod\"}, {\"key\": \"Trọng Lượng\", \"value\": \"100g\"}, {\"key\": \"Marco Keys\", \"value\": \"có\"}, {\"key\": \"a\", \"value\": \"a\"}, {\"key\": \"b\", \"value\": \"b\"}, {\"key\": \"c\", \"value\": \"c\"}, {\"key\": \"d\", \"value\": \"d\"}]',NULL,NULL,1,0,'[\"products/VlcpHEen2nchJdEf9nckehRf6gxsEsgsYMfZUkao.jpg\", \"products/PP858Qt4T2aHwlibvHmt9meyjSVXDPg34fYyYZH1.jpg\", \"products/aCrHAurmRlfjEldJBWDEOFLQE54EbSZJfbQ7GJxr.jpg\", \"products/M7EFCMdbbQWSL0M30BtC1WfYRGBooygCMCly5N1y.jpg\", \"products/OysQQCLZK1uwvAUOT1BObVIoQwZIBEuT4pb7D0Yv.jpg\", \"products/d55XH7NveEiQDofU8L7zLA1syMxrl9lHstNu8Klo.png\"]'),(19,2,2,'Bàn phím cơ có dây',NULL,5000000.00,NULL,'products/h4Cp3XlrQx7NxIeeIbCkjUQvTB4ufd3tB7IvHQv3.png','Thương hiệu: ASUS\r\nModel: TUF Gaming K3 Gen II Hatsune Miku Edition\r\nTình trạng: Mới 100%\r\nKết nối: Có dây, USB 2.0 (TypeA) 1000 Hz cáp dài 2m\r\nMàu sắc: Xanh',1,'2026-04-27 01:32:05','2026-04-27 02:36:15','[{\"key\": \"a\", \"value\": \"a\"}, {\"key\": \"b\", \"value\": \"b\"}, {\"key\": \"c\", \"value\": \"c\"}, {\"key\": \"d\", \"value\": \"d\"}, {\"key\": \"e\", \"value\": \"e\"}, {\"key\": \"f\", \"value\": \"f\"}]',NULL,NULL,1,0,'[\"products/oF8ARhNPC2McTW3jvlwC9gNbNXdyWmU6BjyxBYV3.jpg\", \"products/DG0O0xFoqK9HGqb6b7MFAX3PaDfFyV8MIKmnVhLy.jpg\", \"products/OSEzRMaX7vJbR8s89qotowOtLSrJkAbsGoBTCAVw.png\", \"products/DKpBpcpsaQtcB4WSIptOGh9ZFgyF8O1E9hMLp7tu.jpg\", \"products/69oqkpvWH3aSKjI76vi3vqJUlrDxBwFKPY9SZTvK.jpg\"]'),(20,2,1,'Bàn phím cơ không dây',NULL,50000.00,40000.00,'products/SNdmTYw31mHdGdCpd3mmXlkXRFXdLC2VQThLJhG5.jpg','Thương hiệu: Logitech;\r\nModel: TUF Gaming K3 Gen II Hatsune Miku Edition;\r\nTình trạng: Mới 100%;\r\nKết nối: Có dây, USB 2.0 (TypeA) 1000 Hz cáp dài 2m;\r\nMàu sắc: Cam',1,'2026-04-27 01:39:09','2026-04-29 10:17:22','[{\"key\": \"a\", \"value\": \"a\"}, {\"key\": \"b\", \"value\": \"b\"}, {\"key\": \"c\", \"value\": \"c\"}, {\"key\": \"d\", \"value\": \"d\"}]',NULL,'12 tháng',1,0,'[\"products/heMpRiiES7snJz3UYB0EpXPoLVDg3UA62xu7j86q.jpg\", \"products/NExZ9rVZP6m0qrYwtmvUPWKNYWNUpnsSMM66Imb7.jpg\", \"products/5nidwrt4EHGDoNFWVFg5oarQFICfyIgBeqb8zUZw.jpg\", \"products/lBmlEU8xcbjiuDuazW7dPoQXKhqG07H2vlWPVhJ0.jpg\", \"products/Ru9MivUHe6ASdDEphD7V1B7865vj6uYLsoKKlhH2.jpg\"]');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('hLyaj6ovKepqKlVXxkemJ6iGYOl1vtk8OZknumea',4,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHNMT202N3NsbzcybUNCVXg0YklLeXJNUGdzZmNCcExnOFJkWmhkWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9',1777563819),('QfbiKR1Iz3uwtCXIlHJdRtgYbTTfXg5VRcDLp4Nw',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiTGJTc0hrNmFaQmNLa2tsdTAxTW1JMWVZR1UyWTdzRHE2OERPam9OOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1777560764),('WVWa4yVtcQNU6kHQKVUjZRUXjydKeFY0MHqxPa9G',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiZnBRNFpIc0gzc2dLa3Z3TU96dndEQmxLYXU1VE5CcVh5T1R2eDF2QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1777561702);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,4,'Trung','0329346849','Vĩnh Long','Công ty',0,'2026-04-19 03:33:45','2026-04-19 06:49:25'),(2,4,'Trung','0329346849','HCM','Nhà riêng',1,'2026-04-19 03:34:01','2026-04-19 06:49:25'),(3,3,'Administrator','0329346849','Vĩnh Long','Mặc định',1,'2026-04-30 07:50:50','2026-04-30 07:50:50');
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin',NULL,NULL,NULL,NULL,NULL,'admin@example.com',NULL,NULL,'$2y$12$v3KuRBLtcpdlGFBS3fQJb.Slpmj/jlxY7v6Q1wPph41C895hgIfie','admin',NULL,'2026-03-15 02:34:07','2026-03-15 02:34:07'),(2,'User',NULL,NULL,NULL,NULL,NULL,'user@example.com',NULL,NULL,'$2y$12$F7Zpapsubn5HZ4gumQmfBuOkxpPAoSxdRjNiRSwMoDA4wWhkDcNES','user',NULL,'2026-03-15 02:34:07','2026-03-15 02:34:07'),(3,'Administrator',NULL,NULL,NULL,NULL,NULL,'admin@techflow.vn',NULL,NULL,'$2y$12$15/6eXFlkYFqa0E2c3kpeOhymxhsNP7dppCxPOPu/sWcN7DKGv6gy','admin','eHr6ikbzmaVlxNEU8MkTysjyu0nYHXX5KExLaUXqdoqeurpMiTTHI4oZHUK7','2026-03-15 02:34:27','2026-03-15 02:34:27'),(4,'NguyenTienTrung',NULL,'0329346849','2005-06-06','Nam','Vĩnh Long','nguyentientrungtpvl@gmail.com','avatars/krbZN07tUi0zZFTMvIzTl9pXZ13Qny3XIifyFquD.jpg',NULL,'$2y$12$Wz3a0iUsVeyOsgOCwkj2yOZUbBIPcg/Wm2LDWEPkq/a9kXjnZDG/W','user',NULL,'2026-04-19 03:03:13','2026-04-19 03:21:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_user_id_foreign` (`user_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-30 22:48:30
