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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
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
  `expiry_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000003_create_categories_table',1),(5,'2024_01_01_000004_create_products_table',1),(6,'2024_01_01_000005_add_role_to_users_table',1),(7,'2026_03_15_093255_add_username_to_users_table',1),(8,'2026_03_18_081751_add_details_to_products_table',2),(9,'2026_03_18_082549_add_gallery_to_products_table',3),(10,'2026_03_25_200000_add_phone_and_address_to_users_table',4),(11,'2026_03_25_200100_add_slug_to_categories_table',5),(12,'2026_03_25_200150_create_brands_table',6),(13,'2026_03_25_200200_add_brand_id_and_slug_to_products_table',6),(14,'2026_03_25_200400_create_orders_table',6),(15,'2026_03_25_200500_create_order_items_table',6),(16,'2026_03_25_200600_create_reviews_table',6),(17,'2026_03_25_200700_create_wishlists_table',6),(18,'2026_03_25_200800_create_coupons_table',6),(19,'2026_03_25_200900_create_settings_table',6),(20,'2026_03_28_112818_add_sale_price_to_products_table',7),(21,'2026_04_19_075936_update_orders_table_for_guest_checkout',8),(22,'2026_04_19_101122_add_birthday_gender_avatar_to_users_table',9),(23,'2026_04_19_103000_create_user_addresses_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,16,1,7000.00,'2026-04-19 01:37:56','2026-04-19 01:37:56'),(2,2,16,1,7000.00,'2026-04-19 01:42:40','2026-04-19 01:42:40'),(3,3,16,1,7000.00,'2026-04-19 01:45:46','2026-04-19 01:45:46'),(4,4,16,1,7000.00,'2026-04-19 01:52:28','2026-04-19 01:52:28'),(5,5,16,1,7000.00,'2026-04-19 01:56:27','2026-04-19 01:56:27'),(6,6,16,1,7000.00,'2026-04-19 02:09:41','2026-04-19 02:09:41'),(7,7,16,1,7000.00,'2026-04-19 02:56:28','2026-04-19 02:56:28'),(8,8,16,1,7000.00,'2026-04-19 03:34:30','2026-04-19 03:34:30');
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
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,'trung','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'processing','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:38:00\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:39:00','2026-04-19 01:37:56','2026-04-19 01:39:39'),(2,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'pending','banking','vĩnh long',NULL,'2026-04-19 01:42:40','2026-04-19 01:42:40'),(3,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'processing','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:46:00','2026-04-19 01:45:46','2026-04-19 01:46:08'),(4,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'processing','banking','vĩnh long','\n[SePay] Da thanh toan 37,700d luc 2026-04-19 15:53:00','2026-04-19 01:52:28','2026-04-19 01:52:57'),(5,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'pending','cod','vĩnh long',NULL,'2026-04-19 01:56:27','2026-04-19 01:56:27'),(6,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'pending','cod','vĩnh long',NULL,'2026-04-19 02:09:41','2026-04-19 02:09:41'),(7,NULL,'Trung Nguyễn','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'pending','cod','vĩnh long',NULL,'2026-04-19 02:56:28','2026-04-19 02:56:28'),(8,4,'Trung','nguyentientrungtpvl@gmail.com','0329346849',37700.00,'processing','cod','Vĩnh Long',NULL,'2026-04-19 03:34:30','2026-04-19 06:58:21');
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
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `stock_quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `specs` json DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `gallery` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,1,NULL,'Chuột không dây Logitech M331',NULL,390000.00,NULL,'products/XCfwbfFRCFtHBNeoEdjHUIVFKW8vAFEpUY1kdar2.jpg','Chuột không dây silent, phù hợp văn phòng, pin lên tới 24 tháng',100,'2026-03-15 02:34:07','2026-03-25 05:21:01','[{\"key\": \"Mắt đọc\", \"value\": \"1ms\"}]',NULL,1,1,'[\"products/cpxgbaSpSKyx5qe1MN5JSD8LUagJ42xhx4irRyEt.png\"]'),(4,2,NULL,'Bàn phím cơ Akko 3068B Plus',NULL,1490000.00,100000.00,'products/qSXjiHF02LBWAY4VkxP4QLgZeHwoVqVHHuUxb2jV.jpg','Bàn phím cơ 65%, switch Akko CS, kết nối Bluetooth/USB-C',40,'2026-03-15 02:34:07','2026-03-28 04:36:33','[{\"key\": null, \"value\": null}]',NULL,1,1,'[\"products/fFa8gb0Ga2P9KHoCjhrwRUnwGOaTV3GdbTv9axvw.jpg\", \"products/tepcYGfnvpMkex3vcRQ3Dla6vhjKx8hMI0tEiG9s.jpg\", \"products/Xg8aWGDoh05zs5a1FDjzjxJidlun19VRktaVrVrS.png\"]'),(5,2,NULL,'Bàn phím Corsair K70 RGB Pro',NULL,3290000.00,3000000.00,'products/sqK7P8zz72uKDStLIfLLVB654XipmMpP5ugK6ToM.png','Bàn phím cơ full-size, Cherry MX Red, đèn RGB per-key',25,'2026-03-15 02:34:07','2026-03-28 04:38:40','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/XwMUrLRDQSxEc0wPslTJTGZIp6OO2IxW5zveSSqH.jpg\", \"products/bRHvXopdWdXZLstgeXRb9YVqH577jCu9M2ONflgC.jpg\", \"products/wfiYz4OrsrznSQBM0bscN1QTh4s4U2biT35I31k4.jpg\"]'),(6,2,NULL,'Bàn phím Logitech K380',NULL,790000.00,NULL,'products/SYNOfyWClVc9a5QX6DIO54MchDYrBPxesxgSuX6M.png','Bàn phím không dây đa thiết bị, Bluetooth, thiết kế gọn nhẹ',80,'2026-03-15 02:34:07','2026-03-28 04:00:00','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/etsxx1HtiypTqc4EOfs2A0fs05VfUU20enu4dI8i.jpg\", \"products/CyR2B0EkPfqA4wr0OSSV4P6HPA8JEIej8dlbsGx3.jpg\", \"products/BpK878NpFabcn7xO9c6ucgA9xqZ09lATzuvahIZe.jpg\"]'),(7,3,NULL,'Tai nghe HyperX Cloud III',NULL,2190000.00,2000000.00,'products/OPzI5JTLNg0G3MR0HcqTuQs17guOmGOFMeVWSRPz.jpg','Tai nghe gaming 7.1, driver 53mm, mic có thể tháo rời',30,'2026-03-15 02:34:07','2026-03-28 04:39:07','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/0UKQFfUByoqavj2ndB6NiHOPm86Qw0Zm3pUt24n7.png\", \"products/GOGABLrSrCztr44VWKR3LwvUFwDiPlLgEnaLaCCl.jpg\", \"products/UXBsJS7bQNUKOEmXKBGgNBOMoq7Wz5if2EqQsHJg.png\"]'),(8,3,NULL,'Tai nghe Sony WH-1000XM5',NULL,7490000.00,NULL,'products/dZDA88c3qhPlrkbNg2VvKx1QEDwTYUsxlQrLmu5f.jpg','Tai nghe chống ồn chủ động, âm thanh Hi-Res, pin 30 giờ',15,'2026-03-15 02:34:07','2026-03-28 04:00:26','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/SnlcNPH4afJbbRws3oNNzeI8il1hfOc0P0wPV1PH.jpg\", \"products/iF2ofil3Z4D5XioQhxJ9ghQUmp456s8B8iJ56KYA.jpg\", \"products/4VmFHHR7m4rcrLpKWxxwPu5f6ETBuzTiQ5oNIJal.jpg\"]'),(9,3,NULL,'Tai nghe Razer Kraken V3',NULL,1890000.00,NULL,'products/bsWjiCz3AbZldmXjglgqKCjCTkkYjfu9ZF4NBVbS.jpg','Tai nghe gaming THX Spatial Audio, driver TriForce 50mm',45,'2026-03-15 02:34:07','2026-03-28 04:00:39','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/OWRy4Dto6om5WoLh6GmfYAILEUmTgJ6j21K4VYyI.jpg\", \"products/LbfYfWL0xwr2dgeDXOS8sO3QtcYc8gxPpmY2HGvx.png\", \"products/oQ6oOHVuXysh1Fc8CErUhfTgzUVXoX1GqBPzq445.jpg\"]'),(10,4,NULL,'Loa Edifier R1280T',NULL,1690000.00,NULL,'products/R3kltEDoGQVSLgsBI7oG2V38fj2sC0YVLJZwii9h.jpg','Loa bookshelf 2.0, công suất 42W, kết nối RCA',20,'2026-03-15 02:34:07','2026-03-28 04:00:52','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/UwEDdlPuSQGuM6fxb002ycTji8ibCQD5VRyHYIXq.jpg\", \"products/NEvR0WzgrOKKpidNtN0rpVhmHRqLbYjGQzzbHuYL.jpg\", \"products/4cQhLwGNto5TkJSkER9a9yqdxE5qhkmh09IhNOvS.jpg\"]'),(11,4,NULL,'Loa JBL Charge 5',NULL,3490000.00,NULL,'products/UC8YnLZ5s0PT8KFncpkxWHgSW45ECxHWm5IOiasi.jpg','Loa bluetooth di động, chống nước IP67, pin 20 giờ',25,'2026-03-15 02:34:07','2026-03-28 04:01:04','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/a9l01VL1UQOOxEdEHJA0VpZyIiJ3ydvIXIs2zMD1.jpg\", \"products/keXSXsxBslgx85wBLeAOpKgR58nzkdLWd84PW7Xy.jpg\", \"products/JjtnyohTImigNKbQ6BAMosAEy6C5Eg7xb2KS5BHX.jpg\"]'),(12,4,NULL,'Loa Soundbar Samsung HW-B450',NULL,2790000.00,2190000.00,'products/tcH7j9OLI7Yw4wQRn7crAFtDmDHsTYaNi35RMd74.png','Soundbar 2.1 kênh, công suất 300W, có subwoofer không dây',18,'2026-03-15 02:34:07','2026-03-28 04:40:49','[{\"key\": null, \"value\": null}]',NULL,1,0,'[\"products/0wP2Oqn6ZF1XDkjJMTRAeXe3pRubudgT9zZE7i3m.jpg\", \"products/1LeI8jYqaazZP4YJBrSkTvwdBR9bpmJ8aBai7jaH.jpg\", \"products/P8usjadGx3AuflmRAVQgPIlUkBIOPIOkrIcnwhzM.jpg\"]'),(16,1,NULL,'Chuột không dây Logitech MMM',NULL,500000.00,7000.00,'products/CZckVagtNeMKVsVd8M1uBLVRXpuwDcbjclaKcnjl.jpg','Mới',50,'2026-03-25 05:09:43','2026-04-19 01:37:04','[{\"key\": \"Mắt đọc\", \"value\": \"1ms\"}]',NULL,1,1,'[\"products/Hdet6UdWyL0lQh1bgEkYcgB3icGy9BEKI6s03RNA.png\", \"products/rlnDWw8tZscSuEfog3x082Aj34PoYrkDhtkaDU7x.png\", \"products/qGGoMfJRYHCLyqrhM8npCeSCGPwKSIoP0yB9Zt3s.png\", \"products/gEGAbUCPiXdl1z71SPkiW72Aif7jKnK4IBbaITAK.jpg\", \"products/YkzFHOnnvPdUQPBkMuDDH37peWrV68B7LWiPAkMO.jpg\", \"products/m0SfpMHSFA3RKeXLtrs9PUGDKDZG86tTtBrGzGGq.jpg\"]'),(17,1,NULL,'Chuột không dây M331',NULL,4998000.00,NULL,'products/tez25VtiQepx8HrFy8iaVuWMyoCfOHdirRcsqwwr.jpg',NULL,8,'2026-04-19 09:48:26','2026-04-19 09:48:26','[{\"key\": null, \"value\": null}]',NULL,1,1,'[\"products/J23fzzcTarN3kpFhvm295zNUhoZ4lFM3ZOXFzCnX.jpg\", \"products/vNA2zTxfEWHHRJNc4K6jImdpC7hIOsKuopruDSgK.jpg\", \"products/on7CczfZpeiX6Iwd3RaNygDORZngg6uaGWcyUSGu.png\"]');
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
INSERT INTO `sessions` VALUES ('sgaxrnsx5E6kzeGwgmQ76DLmeu4eNsjtrxggrmAh',3,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibUFjN2Y2RENkWE1DM1JJZmczVlQzbkNpdU1OQXVScklkMGZCbnRXRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9yZXBvcnRzIjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi5yZXBvcnRzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImNhcnQiO2E6MDp7fX0=',1776617470);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,4,'Trung','0329346849','Vĩnh Long','Công ty',0,'2026-04-19 03:33:45','2026-04-19 06:49:25'),(2,4,'Trung','0329346849','HCM','Nhà riêng',1,'2026-04-19 03:34:01','2026-04-19 06:49:25');
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
INSERT INTO `users` VALUES (1,'Admin',NULL,NULL,NULL,NULL,NULL,'admin@example.com',NULL,NULL,'$2y$12$v3KuRBLtcpdlGFBS3fQJb.Slpmj/jlxY7v6Q1wPph41C895hgIfie','admin',NULL,'2026-03-15 02:34:07','2026-03-15 02:34:07'),(2,'User',NULL,NULL,NULL,NULL,NULL,'user@example.com',NULL,NULL,'$2y$12$F7Zpapsubn5HZ4gumQmfBuOkxpPAoSxdRjNiRSwMoDA4wWhkDcNES','user',NULL,'2026-03-15 02:34:07','2026-03-15 02:34:07'),(3,'Administrator',NULL,NULL,NULL,NULL,NULL,'admin@techflow.vn',NULL,NULL,'$2y$12$15/6eXFlkYFqa0E2c3kpeOhymxhsNP7dppCxPOPu/sWcN7DKGv6gy','admin','tpKRoOe8NSFS3tRFAVC42QZDNIQZPBAbJX3b3Xw0PtqETXie8GoXula2Obxp','2026-03-15 02:34:27','2026-03-15 02:34:27'),(4,'NguyenTienTrung',NULL,'0329346849','2005-06-06','Nam','Vĩnh Long','nguyentientrungtpvl@gmail.com','avatars/krbZN07tUi0zZFTMvIzTl9pXZ13Qny3XIifyFquD.jpg',NULL,'$2y$12$Wz3a0iUsVeyOsgOCwkj2yOZUbBIPcg/Wm2LDWEPkq/a9kXjnZDG/W','user',NULL,'2026-04-19 03:03:13','2026-04-19 03:21:51');
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

-- Dump completed on 2026-04-22 23:06:48
