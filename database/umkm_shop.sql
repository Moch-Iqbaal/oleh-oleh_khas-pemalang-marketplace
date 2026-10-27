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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '76e16e92-d1aa-11f1-8b8a-1533bd1d5967:1-951';

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Camilan & Kerupuk','camilan-kerupuk','2026-10-26 20:28:10','2026-10-26 20:28:10'),(2,'Kopi & Teh','kopi-teh','2026-10-26 20:28:10','2026-10-26 20:28:10'),(3,'Batik Pemalang','batik-pemalang','2026-10-26 20:28:10','2026-10-26 20:28:10'),(4,'Hampers & Kue','hampers-kue','2026-10-26 20:28:10','2026-10-26 20:28:10'),(5,'Siap Saji','siap-saji','2026-10-26 20:28:10','2026-10-26 20:28:10'),(6,'Gula & Manisan','gula-manisan','2026-10-26 20:28:10','2026-10-26 20:28:10'),(7,'Olahan Laut','olahan-laut','2026-10-26 20:28:10','2026-10-26 20:28:10'),(8,'Kerajinan Bambu','kerajinan-bambu','2026-10-26 20:28:10','2026-10-26 20:28:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_020313_add_role_to_users_table',1),(5,'2026_10_27_020314_create_categories_table',1),(6,'2026_10_27_020316_create_products_table',1),(7,'2026_10_27_020317_create_transactions_table',1),(8,'2026_10_27_020318_create_transaction_items_table',1),(9,'2026_10_27_100000_add_seller_role_to_users_table',1),(10,'2026_10_27_100001_create_stores_table',1),(11,'2026_10_27_100002_add_marketplace_fields_to_products_table',1),(12,'2026_10_27_100003_add_store_id_to_transactions_table',1),(13,'2026_10_27_110000_add_photo_and_location_to_stores_table',1),(14,'2026_10_27_120000_add_place_name_to_stores_table',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,'Grontol Jagung Gurih','grontol-jagung-gurih','Jagung pipil rebus dengan parutan kelapa dan sedikit garam. Paling enak dimakan hari itu juga.',15000.00,40,250,5,1,'images/products/grontol-jagung-gurih.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(2,1,1,'Kerupuk Usek Mentah','kerupuk-usek-mentah','Kerupuk usek: adonan tepung tapioka berbumbu bawang putih yang dikukus, dijemur, lalu digoreng dengan pasir panas tanpa minyak. Teman makan sayur, soto, atau bakso.',13000.00,60,500,90,1,'images/products/kerupuk-usek-mentah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(3,1,1,'Keripik Tempe Renyah','keripik-tempe-renyah','Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.',20000.00,35,200,30,0,'images/products/keripik-tempe-renyah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(4,1,1,'Emping Melinjo Mentah','emping-melinjo-mentah','Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.',35000.00,25,250,120,0,'images/products/emping-melinjo-mentah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(5,2,2,'Kopi Robusta Pulosari Bubuk 250g','kopi-robusta-pulosari-bubuk-250g','Robusta dari petani lereng Gunung Slamet di Kecamatan Pulosari, sangrai medium, giling halus, tanpa campuran.',25000.00,30,250,180,1,'images/products/kopi-robusta-pulosari-bubuk-250g.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(6,2,2,'Kopi Robusta Pulosari Biji Sangrai 500g','kopi-robusta-pulosari-biji-sangrai-500g','Biji robusta Pulosari sangrai utuh untuk yang suka menggiling sendiri.',45000.00,20,500,180,0,'images/products/kopi-robusta-pulosari-biji-sangrai-500g.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(7,2,2,'Teh Tubruk Melati Gaya Poci','teh-tubruk-melati-gaya-poci','Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.',12000.00,80,100,365,1,'images/products/teh-tubruk-melati-gaya-poci.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(8,2,2,'Gula Batu Kristal 500g','gula-batu-kristal-500g','Pasangan wajib teh tubruk.',15000.00,50,500,365,0,'images/products/gula-batu-kristal-500g.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(9,3,3,'Kain Batik Cap Motif Pemalangan','kain-batik-cap-motif-pemalangan','Kain batik cap 2 meter motif Pemalangan (misalnya Gemek Setekem atau Sawat Rante).',150000.00,15,400,NULL,1,'images/products/kain-batik-cap-motif-pemalangan.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(10,3,3,'Kemeja Batik Pria Lengan Panjang','kemeja-batik-pria-lengan-panjang','Kemeja katun batik lengan panjang, ukuran M sampai XL.',175000.00,12,350,NULL,0,'images/products/kemeja-batik-pria-lengan-panjang.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(11,3,3,'Selendang Batik Tulis','selendang-batik-tulis','Selendang batik tulis halus, cocok untuk hadiah.',210000.00,6,150,NULL,0,'images/products/selendang-batik-tulis.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(12,4,4,'Paket Hampers Oleh-Oleh Pemalang','paket-hampers-oleh-oleh-pemalang','Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.',150000.00,10,1500,30,0,'images/products/paket-hampers-oleh-oleh-pemalang.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(13,4,4,'Rengginang Ketan 250g','rengginang-ketan-250g','Rengginang ketan mentah, tinggal goreng.',17000.00,30,250,60,0,'images/products/rengginang-ketan-250g.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(14,5,5,'Paket Nasi Grombyang Siap Saji','paket-nasi-grombyang-siap-saji','Paket untuk 2 porsi: daging sapi, kuah kluwek berempah dalam kemasan terpisah, serundeng, dan bawang goreng. Simpan di kulkas, panaskan kuah sampai mendidih lalu siram ke nasi. Tahan 3 hari di kulkas.',40000.00,20,900,3,1,'images/products/paket-nasi-grombyang-siap-saji.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(15,5,4,'Kue Kamir Original isi 10','kue-kamir-original-isi-10','Kue kamir khas Pemalang dari adonan terigu, telur, dan mentega dengan tape. Manis, legit, sedikit gosong di pinggir. Tahan sekitar 4 hari.',20000.00,30,600,4,1,'images/products/kue-kamir-original-isi-10.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(16,5,4,'Apem Kukus Daun Pisang','apem-kukus-daun-pisang','Apem tepung beras dan santan yang dikukus beralas daun pisang. Isi 10.',15000.00,25,400,2,0,'images/products/apem-kukus-daun-pisang.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(17,5,4,'Kue Putu Ayu isi 12','kue-putu-ayu-isi-12','Kue putu ayu pandan dengan taburan kelapa parut.',18000.00,20,350,2,0,'images/products/kue-putu-ayu-isi-12.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(18,4,4,'Wajik Ketan Gula Merah','wajik-ketan-gula-merah','Wajik dari beras ketan dan gula merah, legit dan wangi daun pandan.',22000.00,25,400,7,0,'images/products/wajik-ketan-gula-merah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(19,4,4,'Jenang Ketan Bungkus Klobot','jenang-ketan-bungkus-klobot','Jenang ketan santan gula merah, dibungkus kulit jagung (klobot).',25000.00,20,500,14,0,'images/products/jenang-ketan-bungkus-klobot.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(20,4,4,'Dodol Aneka Rasa 500g','dodol-aneka-rasa-500g','Dodol bungkus kecil rasa original, durian, dan nangka.',30000.00,30,500,60,0,'images/products/dodol-aneka-rasa-500g.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(21,4,4,'Kue Lidah Kucing Toples','kue-lidah-kucing-toples','Kue kering lidah kucing tipis dan renyah dalam toples.',45000.00,20,300,60,0,'images/products/kue-lidah-kucing-toples.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(22,4,4,'Nastar Selai Nanas Toples','nastar-selai-nanas-toples','Nastar lembut dengan selai nanas buatan sendiri.',65000.00,20,400,45,1,'images/products/nastar-selai-nanas-toples.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(23,4,4,'Kastengel Keju Toples','kastengel-keju-toples','Kastengel keju edam, gurih dan wangi.',70000.00,15,400,45,0,'images/products/kastengel-keju-toples.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(24,4,4,'Kembang Goyang Renyah','kembang-goyang-renyah','Kembang goyang tepung beras, manis gurih.',25000.00,30,250,60,0,'images/products/kembang-goyang-renyah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(25,4,4,'Kue Satu Kacang Hijau','kue-satu-kacang-hijau','Kue satu dari tepung kacang hijau yang dicetak dan dijemur.',20000.00,30,250,30,0,'images/products/kue-satu-kacang-hijau.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(26,4,4,'Semprong Gulung Wijen','semprong-gulung-wijen','Kue semprong gulung tipis dengan wijen.',28000.00,25,250,60,0,'images/products/semprong-gulung-wijen.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(27,4,4,'Semprong Lipat Kelapa','semprong-lipat-kelapa','Semprong lipat dengan aroma kelapa.',28000.00,25,250,60,0,'images/products/semprong-lipat-kelapa.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(28,4,1,'Kue Bawang Stik','kue-bawang-stik','Stik bawang gurih untuk teman ngeteh.',20000.00,40,250,60,0,'images/products/kue-bawang-stik.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(29,1,1,'Rempeyek Kacang Tanah','rempeyek-kacang-tanah','Rempeyek tepung beras dengan kacang tanah, renyah dan gurih.',20000.00,40,200,30,0,'images/products/rempeyek-kacang-tanah.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(30,1,1,'Kacang Bawang Gurih','kacang-bawang-gurih','Kacang tanah kupas goreng dengan bawang putih.',18000.00,40,250,60,0,'images/products/kacang-bawang-gurih.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(31,1,1,'Keripik Singkong Original','keripik-singkong-original','Keripik singkong tipis, asin gurih.',15000.00,50,250,60,0,'images/products/keripik-singkong-original.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(32,1,1,'Keripik Singkong Balado','keripik-singkong-balado','Keripik singkong dengan bumbu balado pedas manis.',17000.00,50,250,60,0,'images/products/keripik-singkong-balado.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(33,1,1,'Keripik Pisang Manis','keripik-pisang-manis','Keripik pisang tanduk dengan lapisan gula tipis.',18000.00,40,250,60,0,'images/products/keripik-pisang-manis.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(34,1,1,'Opak Singkong Bakar','opak-singkong-bakar','Opak singkong mentah, dibakar atau digoreng sebelum disantap.',15000.00,40,250,60,0,'images/products/opak-singkong-bakar.webp','2026-10-26 20:28:10','2026-10-26 20:28:10'),(35,1,1,'Kerupuk Kulit Rambak','kerupuk-kulit-rambak','Kerupuk kulit sapi yang renyah, cocok untuk teman makan.',25000.00,30,150,60,0,'images/products/kerupuk-kulit-rambak.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(36,1,1,'Emping Jagung Manis','emping-jagung-manis','Emping jagung pipih dengan rasa manis.',16000.00,40,250,60,0,'images/products/emping-jagung-manis.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(37,1,1,'Kue Keciput Wijen','kue-keciput-wijen','Bola-bola kecil tepung ketan berbalut wijen.',20000.00,30,250,60,0,'images/products/kue-keciput-wijen.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(38,2,6,'Manisan Pepaya Moga','manisan-pepaya-moga','Manisan pepaya kering dari Moga, manis dan kenyal.',20000.00,30,250,30,1,'images/products/manisan-pepaya-moga.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(39,2,2,'Wedang Jahe Instan','wedang-jahe-instan','Serbuk jahe merah dan gula untuk wedang jahe hangat.',18000.00,50,200,365,0,'images/products/wedang-jahe-instan.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(40,6,6,'Nanas Madu Belik','nanas-madu-belik','Nanas madu segar dari kebun Belik, sentra nanas Pemalang. Harga per buah.',15000.00,40,1200,7,0,'images/products/nanas-madu-belik.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(41,6,6,'Gula Aren Cetak Bongas 1kg','gula-aren-cetak-bongas-1kg','Gula aren padat dari Desa Bongas, Watukumpul. Dimasak dengan kayu bakar tanpa campuran, isi 5 linting.',32000.00,50,1000,180,1,'images/products/gula-aren-cetak-bongas-1kg.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(42,6,6,'Gula Aren Cair 250ml','gula-aren-cair-250ml','Gula aren cair untuk kopi, es, dan kue.',25000.00,40,300,180,0,'images/products/gula-aren-cair-250ml.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(43,7,7,'Ikan Asin Teri Nasi 250g','ikan-asin-teri-nasi-250g','Teri nasi asin kering, kecil dan gurih.',30000.00,30,250,90,0,'images/products/ikan-asin-teri-nasi-250g.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(44,7,7,'Ikan Asin Jambal 250g','ikan-asin-jambal-250g','Ikan asin jambal kering untuk digoreng atau dibakar.',40000.00,25,250,90,0,'images/products/ikan-asin-jambal-250g.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(45,7,7,'Terasi Udang Rebon','terasi-udang-rebon','Terasi dari udang rebon untuk sambal dan masakan.',15000.00,40,200,180,0,'images/products/terasi-udang-rebon.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(46,7,7,'Kerupuk Udang Mentah 500g','kerupuk-udang-mentah-500g','Kerupuk udang mentah, mekar besar saat digoreng.',35000.00,30,500,120,0,'images/products/kerupuk-udang-mentah-500g.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(47,4,7,'Abon Sapi 100g','abon-sapi-100g','Abon daging sapi manis gurih.',35000.00,25,100,90,0,'images/products/abon-sapi-100g.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(48,3,3,'Sarung Batik Cap','sarung-batik-cap','Sarung batik cap katun, nyaman untuk sehari-hari.',135000.00,15,450,NULL,0,'images/products/sarung-batik-cap.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(49,3,3,'Kain Batik Tulis 2 Meter','kain-batik-tulis-2-meter','Kain batik tulis halus, panjang 2 meter.',250000.00,8,400,NULL,0,'images/products/kain-batik-tulis-2-meter.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(50,3,3,'Blangkon Batik','blangkon-batik','Blangkon batik untuk acara adat atau koleksi.',60000.00,15,150,NULL,0,'images/products/blangkon-batik.webp','2026-10-26 20:28:11','2026-10-26 20:28:11'),(51,8,8,'Bakul Anyaman Bambu','bakul-anyaman-bambu','Bakul bambu anyaman tangan untuk nasi atau wadah serbaguna.',35000.00,20,400,NULL,0,'images/products/bakul-anyaman-bambu.webp','2026-10-26 20:28:11','2026-10-26 20:28:11');
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
INSERT INTO `sessions` VALUES ('OHuZRbwtRgiU0cnu5XDMcqPGkj66PtDLPssmLZN7',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Safari/605.1.15','eyJfdG9rZW4iOiI4dzJaNjhnaENOMWZEZVNLQk9VNnA3SDNGYjdRcUw1cnBJWjRvamdkIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvdXNlcnMiLCJyb3V0ZSI6ImFkbWluLnVzZXJzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiYmM5ODkyNWE1MTVjMDZjYzcxMmE5NDM4ZDA2ZmNmOTg0MmNiZGM4ODI5YjYxZTkxZDA3NzA0YzhlNzNlMWM3MCJ9',1793071708);
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
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_user_id_unique` (`user_id`),
  UNIQUE KEY `stores_slug_unique` (`slug`),
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,4,'Camilan Mbok Darmi','camilan-mbok-darmi','Kerupuk usek dan camilan rumahan dari perajin Kalimas, dijual di kios Pasar Randudongkal.','images/stores/camilan-mbok-darmi.webp','Pasar Randudongkal','Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah',-7.1036051,109.3244742,'081200000001',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(2,5,'Kopi & Teh Lereng Moga','kopi-teh-lereng-moga','Kopi robusta petani lereng Gunung Slamet (Pulosari) dan manisan pepaya Moga.','images/stores/kopi-teh-lereng-moga.webp','Pasar Moga','Kios di Pasar Moga, Jl. Raya Moga - Pulosari, Kec. Moga, Kab. Pemalang, Jawa Tengah',-7.1235743,109.2463483,'081200000002',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(3,6,'Batik Canting Lestari','batik-canting-lestari','Batik tulis dan cap motif Pemalangan dari perajin Taman, kiosnya di los sandang Pasar Pagi Pemalang.','images/stores/batik-canting-lestari.webp','Pasar Pagi Pemalang','Kios di Pasar Pagi Pemalang, Jl. Mawar, Kel. Mulyoharjo, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8890280,109.3911390,'081200000003',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(4,7,'Dapur Oleh-Oleh Comal','dapur-oleh-oleh-comal','Kue kering, jajanan tradisional, dan paket hampers dari kios di Pasar Comal.','images/stores/dapur-oleh-oleh-comal.webp','Pasar Comal','Kios di Pasar Comal, Posongan, Kel. Purwoharjo, Kec. Comal, Kab. Pemalang, Jawa Tengah',-6.9057000,109.5334000,'081200000004',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(5,8,'Grombyang & Kamir Semeru','grombyang-kamir-semeru','Paket nasi grombyang dan kue kamir, lapak kuliner di kawasan Alun-Alun Pemalang.','images/stores/grombyang-kamir-semeru.webp','Alun-Alun Pemalang','Kios di Alun-Alun Pemalang, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8902901,109.3806267,'081200000005',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(6,9,'Gula Aren Lestari Watukumpul','gula-aren-lestari-watukumpul','Gula aren cetak dan cair dari perajin Bongas, Watukumpul, plus nanas madu Belik, dijual di Pasar Belik.','images/stores/gula-aren-lestari-watukumpul.webp','Pasar Belik','Kios di Pasar Belik, Jl. Raya Belik - Pulosari, Kec. Belik, Kab. Pemalang, Jawa Tengah',-7.1870190,109.3295400,'081200000006',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(7,10,'Hasil Laut Tanjungsari','hasil-laut-tanjungsari','Ikan asin, terasi, dan kerupuk udang dari nelayan TPI Tanjungsari.','images/stores/hasil-laut-tanjungsari.webp','TPI Tanjungsari Pemalang','Kios di TPI Tanjungsari Pemalang, Jl. Yos Sudarso, Kel. Sugihwaras, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8685483,109.3684456,'081200000007',1,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(8,11,'Anyaman Bambu Randudongkal','anyaman-bambu-randudongkal','Bakul dan wadah anyaman bambu buatan tangan, dijual di Pasar Randudongkal.','images/stores/anyaman-bambu-randudongkal.webp','Pasar Randudongkal','Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah',-7.1036051,109.3244742,'081200000008',0,'2026-10-26 20:28:10','2026-10-26 20:28:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Platform','admin@umkm.test','admin',NULL,'$2y$12$arU20t3cPYkTqTVaVNoIiOeLJAxJzkOgUI6Ooh2ZL6OaJ.kIF6xhO',NULL,'2026-10-26 20:28:07','2026-10-26 20:28:07'),(2,'Staff Moderator','staff@umkm.test','staff',NULL,'$2y$12$thiH9rFThwCzjJAA7qcsReReEFpKfJw5dJmM7EzP34TWwUZ4HI03C',NULL,'2026-10-26 20:28:07','2026-10-26 20:28:07'),(3,'Budi Perantau','customer@umkm.test','customer',NULL,'$2y$12$9vfQUldQtwKSFNk5XllwVOGPjOsIlPdwk3jhkKuH52sNWfKzdHTQa',NULL,'2026-10-26 20:28:08','2026-10-26 20:28:08'),(4,'Bu Darmi','seller@umkm.test','seller',NULL,'$2y$12$HRVfhTSM1bJnjU9f0EPUg.gmGkyUl30gAXwL7JRUqOuhcich2lQ9K',NULL,'2026-10-26 20:28:08','2026-10-26 20:28:08'),(5,'Pak Slamet','kopi@umkm.test','seller',NULL,'$2y$12$J0UucxTlrucv9vXGz2asJ.0d63r6ZpMq298/ruek88YHcQJs1GJbW',NULL,'2026-10-26 20:28:08','2026-10-26 20:28:08'),(6,'Mbak Sekar','batik@umkm.test','seller',NULL,'$2y$12$y8iN3yWs3iNX1s0ZUzuB2.c0WH4tveBfqbvKgwu28WiDYaLmd0Tci',NULL,'2026-10-26 20:28:09','2026-10-26 20:28:09'),(7,'Mas Arif','comal@umkm.test','seller',NULL,'$2y$12$EgwG7e9bn0xG5KmR0xcBHOoYrA.4ZmTUvcv6XNFOoxWQWT8eIEEzO',NULL,'2026-10-26 20:28:09','2026-10-26 20:28:09'),(8,'Bu Halimah','grombyang@umkm.test','seller',NULL,'$2y$12$k1sYakkKAbopGlq7yLy/geKe1j0v5xPSdNceeodIo1gtWZSbkrgDW',NULL,'2026-10-26 20:28:09','2026-10-26 20:28:09'),(9,'Pak Karyo','aren@umkm.test','seller',NULL,'$2y$12$RTRsPZhZRy/5JPga2wNnqOY7tGfGegbJOf227739usFB1FprWxd5i',NULL,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(10,'Bu Wartini','laut@umkm.test','seller',NULL,'$2y$12$19EUiX5TMcNFnnBWn2v1guqh8iEC79gkJXVqixsi3rCigFkPUWjni',NULL,'2026-10-26 20:28:10','2026-10-26 20:28:10'),(11,'Pak Darsono','bambu@umkm.test','seller',NULL,'$2y$12$soIVEIlIBh2NwIVElcGSbukJQdB4ltXL3aJGQnB1Fi7wKZKVnKiEy',NULL,'2026-10-26 20:28:10','2026-10-26 20:28:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-27 10:28:32
