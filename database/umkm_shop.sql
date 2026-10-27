-- MySQL dump 10.13  Distrib 26.10.0, for macos27.0 (arm64)
--
-- Host: localhost    Database: umkm_shop
-- ------------------------------------------------------
-- Server version	26.10.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
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
  `expiration` bigint NOT NULL,
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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Camilan & Kerupuk','camilan-kerupuk','2026-10-26 19:35:30','2026-10-26 19:35:30'),(2,'Kopi & Teh','kopi-teh','2026-10-26 19:35:30','2026-10-26 19:35:30'),(3,'Batik Pemalang','batik-pemalang','2026-10-26 19:35:30','2026-10-26 19:35:30'),(4,'Hampers & Kue','hampers-kue','2026-10-26 19:35:30','2026-10-26 19:35:30');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_020313_add_role_to_users_table',1),(5,'2026_10_27_020314_create_categories_table',1),(6,'2026_10_27_020316_create_products_table',1),(7,'2026_10_27_020317_create_transactions_table',1),(8,'2026_10_27_020318_create_transaction_items_table',1),(9,'2026_10_27_100000_add_seller_role_to_users_table',1),(10,'2026_10_27_100001_create_stores_table',1),(11,'2026_10_27_100002_add_marketplace_fields_to_products_table',1),(12,'2026_10_27_100003_add_store_id_to_transactions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
  `store_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `stock` int unsigned NOT NULL DEFAULT '0',
  `weight_grams` int unsigned NOT NULL DEFAULT '0',
  `shelf_life_days` smallint unsigned DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_store_id_foreign` (`store_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,'Grontol Jagung Gurih','grontol-jagung-gurih','Jagung pipil rebus dengan parutan kelapa dan sedikit garam. Paling enak dimakan hari itu juga.',15000.00,40,250,5,1,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(2,1,1,'Kerupuk Pasir (Usek) Mentah','kerupuk-pasir-usek-mentah','Kerupuk yang digoreng pakai pasir, tanpa minyak. Dijual mentah, tinggal goreng sangrai di rumah.',18000.00,60,500,90,1,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(3,1,1,'Keripik Tempe Renyah','keripik-tempe-renyah','Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.',20000.00,35,200,30,0,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(4,1,1,'Emping Melinjo Mentah','emping-melinjo-mentah','Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.',35000.00,25,250,120,0,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(5,2,2,'Kopi Robusta Moga Bubuk 250g','kopi-robusta-moga-bubuk-250g','Robusta dari kebun rakyat di lereng selatan Pemalang, sangrai medium, giling halus.',45000.00,30,250,180,1,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(6,2,2,'Kopi Robusta Biji Sangrai 500g','kopi-robusta-biji-sangrai-500g','Biji kopi sangrai utuh untuk yang suka menggiling sendiri.',80000.00,20,500,180,0,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(7,2,2,'Teh Tubruk Melati Gaya Poci','teh-tubruk-melati-gaya-poci','Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.',12000.00,80,100,365,1,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(8,2,2,'Gula Batu Kristal 500g','gula-batu-kristal-500g','Pasangan wajib teh tubruk.',15000.00,50,500,365,0,NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(9,3,3,'Kain Batik Cap Motif Pemalangan','kain-batik-cap-motif-pemalangan','Kain batik cap 2 meter dengan motif dan warna khas pesisir Pemalang.',125000.00,15,400,NULL,1,NULL,'2026-10-26 19:35:31','2026-10-26 19:35:31'),(10,3,3,'Kemeja Batik Pria Lengan Pendek','kemeja-batik-pria-lengan-pendek','Kemeja katun batik cap, ukuran M sampai XL.',165000.00,12,300,NULL,0,NULL,'2026-10-26 19:35:31','2026-10-26 19:35:31'),(11,3,3,'Selendang Batik Tulis','selendang-batik-tulis','Selendang batik tulis halus, cocok untuk hadiah.',210000.00,6,150,NULL,0,NULL,'2026-10-26 19:35:31','2026-10-26 19:35:31'),(12,4,4,'Paket Hampers Oleh-Oleh Pemalang','paket-hampers-oleh-oleh-pemalang','Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.',150000.00,10,1500,30,0,NULL,'2026-10-26 19:35:31','2026-10-26 19:35:31'),(13,4,4,'Rengginang Ketan 250g','rengginang-ketan-250g','Rengginang ketan mentah, tinggal goreng.',17000.00,30,250,60,0,NULL,'2026-10-26 19:35:31','2026-10-26 19:35:31');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_user_id_unique` (`user_id`),
  UNIQUE KEY `stores_slug_unique` (`slug`),
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,4,'Camilan Mbok Darmi','camilan-mbok-darmi','Camilan rumahan dan kerupuk khas Pemalang, digoreng tiap pagi.','Kec. Taman, Pemalang, Jawa Tengah','081200000001',1,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(2,5,'Kopi & Teh Lereng Moga','kopi-teh-lereng-moga','Kopi robusta dari petani dataran tinggi Pemalang selatan dan teh tubruk wangi melati.','Kec. Moga, Pemalang, Jawa Tengah','081200000002',1,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(3,6,'Batik Sekar Pemalang','batik-sekar-pemalang','Batik cap dan tulis motif Pemalangan karya perajin lokal.','Kec. Pemalang, Pemalang, Jawa Tengah','081200000003',1,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(4,7,'Dapur Oleh-Oleh Comal','dapur-oleh-oleh-comal','Paket hampers dan kue kering untuk kiriman keluarga.','Kec. Comal, Pemalang, Jawa Tengah','081200000004',0,'2026-10-26 19:35:30','2026-10-26 19:35:30');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_items`
--

DROP TABLE IF EXISTS `transaction_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `qty` int unsigned NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_items_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_items`
--

LOCK TABLES `transaction_items` WRITE;
/*!40000 ALTER TABLE `transaction_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned DEFAULT NULL,
  `invoice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(14,2) NOT NULL,
  `status` enum('pending','paid','shipped','done','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_invoice_code_unique` (`invoice_code`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_store_id_foreign` (`store_id`),
  CONSTRAINT `transactions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staff','seller','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Platform','admin@umkm.test','admin',NULL,'$2y$12$JqbBcGmr3fp.m7fACSPOKuec2k1gs7QL6P/1pjbJMJW/0k9672dj6',NULL,'2026-10-26 19:35:28','2026-10-26 19:35:28'),(2,'Staff Moderator','staff@umkm.test','staff',NULL,'$2y$12$7NVlEOCG0MlMasGk9IVhs.q1hsVucFxranJ2.I9uzxPDyNBmpwFnK',NULL,'2026-10-26 19:35:29','2026-10-26 19:35:29'),(3,'Budi Perantau','customer@umkm.test','customer',NULL,'$2y$12$s/H4zPUHss0T5qyxqXfQ7uKUUGPQIwKrgHXEYUJxTe1cT02PpQFxe',NULL,'2026-10-26 19:35:29','2026-10-26 19:35:29'),(4,'Bu Darmi','seller@umkm.test','seller',NULL,'$2y$12$8/Z59Ick2FCfabQ6QbAn..G6ujc488w5sKAKsHBWtGYdP3sP62r8m',NULL,'2026-10-26 19:35:29','2026-10-26 19:35:29'),(5,'Pak Slamet','kopi@umkm.test','seller',NULL,'$2y$12$y8cz0TfKmMibTvG2z49KIOKeDpig9c7RjsPKMG79DDKvrIaS2FHYS',NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(6,'Mbak Sekar','batik@umkm.test','seller',NULL,'$2y$12$EW39TB8SkUJqxYgI/k6Yhu2TYoYQ.fE23sdN5FdKcjkFsxtFyMUfq',NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30'),(7,'Mas Arif','comal@umkm.test','seller',NULL,'$2y$12$GwGTyXUveZPgBIhxrfxWmekSS1cJWYNt.q1WWYB.e5gCl92nlHcVa',NULL,'2026-10-26 19:35:30','2026-10-26 19:35:30');
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

-- Dump completed on 2026-10-27  9:35:31
