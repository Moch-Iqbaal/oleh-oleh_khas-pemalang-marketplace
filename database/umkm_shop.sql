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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Camilan & Kerupuk','camilan-kerupuk','2026-10-26 19:58:45','2026-10-26 19:58:45'),(2,'Kopi & Teh','kopi-teh','2026-10-26 19:58:45','2026-10-26 19:58:45'),(3,'Batik Pemalang','batik-pemalang','2026-10-26 19:58:45','2026-10-26 19:58:45'),(4,'Hampers & Kue','hampers-kue','2026-10-26 19:58:45','2026-10-26 19:58:45'),(5,'Siap Saji','siap-saji','2026-10-26 19:58:45','2026-10-26 19:58:45'),(6,'Gula & Manisan','gula-manisan','2026-10-26 19:58:45','2026-10-26 19:58:45'),(7,'Olahan Laut','olahan-laut','2026-10-26 19:58:45','2026-10-26 19:58:45'),(8,'Kerajinan Bambu','kerajinan-bambu','2026-10-26 19:58:45','2026-10-26 19:58:45');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_020313_add_role_to_users_table',1),(5,'2026_10_27_020314_create_categories_table',1),(6,'2026_10_27_020316_create_products_table',1),(7,'2026_10_27_020317_create_transactions_table',1),(8,'2026_10_27_020318_create_transaction_items_table',1),(9,'2026_10_27_100000_add_seller_role_to_users_table',1),(10,'2026_10_27_100001_create_stores_table',1),(11,'2026_10_27_100002_add_marketplace_fields_to_products_table',1),(12,'2026_10_27_100003_add_store_id_to_transactions_table',1),(13,'2026_10_27_110000_add_photo_and_location_to_stores_table',1);
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
INSERT INTO `products` VALUES (1,1,1,'Grontol Jagung Gurih','grontol-jagung-gurih','Jagung pipil rebus dengan parutan kelapa dan sedikit garam. Paling enak dimakan hari itu juga.',15000.00,40,250,5,1,'images/products/grontol-jagung-gurih.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(2,1,1,'Kerupuk Pasir (Usek) Mentah','kerupuk-pasir-usek-mentah','Kerupuk yang digoreng pakai pasir, tanpa minyak. Dijual mentah, tinggal goreng sangrai di rumah.',18000.00,60,500,90,1,'images/products/kerupuk-pasir-usek-mentah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(3,1,1,'Keripik Tempe Renyah','keripik-tempe-renyah','Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.',20000.00,35,200,30,0,'images/products/keripik-tempe-renyah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(4,1,1,'Emping Melinjo Mentah','emping-melinjo-mentah','Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.',35000.00,25,250,120,0,'images/products/emping-melinjo-mentah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(5,2,2,'Kopi Robusta Moga Bubuk 250g','kopi-robusta-moga-bubuk-250g','Robusta dari kebun rakyat di lereng selatan Pemalang, sangrai medium, giling halus.',45000.00,30,250,180,1,'images/products/kopi-robusta-moga-bubuk-250g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(6,2,2,'Kopi Robusta Biji Sangrai 500g','kopi-robusta-biji-sangrai-500g','Biji kopi sangrai utuh untuk yang suka menggiling sendiri.',80000.00,20,500,180,0,'images/products/kopi-robusta-biji-sangrai-500g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(7,2,2,'Teh Tubruk Melati Gaya Poci','teh-tubruk-melati-gaya-poci','Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.',12000.00,80,100,365,1,'images/products/teh-tubruk-melati-gaya-poci.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(8,2,2,'Gula Batu Kristal 500g','gula-batu-kristal-500g','Pasangan wajib teh tubruk.',15000.00,50,500,365,0,'images/products/gula-batu-kristal-500g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(9,3,3,'Kain Batik Cap Motif Pemalangan','kain-batik-cap-motif-pemalangan','Kain batik cap 2 meter dengan motif dan warna khas pesisir Pemalang.',125000.00,15,400,NULL,1,'images/products/kain-batik-cap-motif-pemalangan.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(10,3,3,'Kemeja Batik Pria Lengan Panjang','kemeja-batik-pria-lengan-panjang','Kemeja katun batik lengan panjang, ukuran M sampai XL.',175000.00,12,350,NULL,0,'images/products/kemeja-batik-pria-lengan-panjang.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(11,3,3,'Selendang Batik Tulis','selendang-batik-tulis','Selendang batik tulis halus, cocok untuk hadiah.',210000.00,6,150,NULL,0,'images/products/selendang-batik-tulis.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(12,4,4,'Paket Hampers Oleh-Oleh Pemalang','paket-hampers-oleh-oleh-pemalang','Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.',150000.00,10,1500,30,0,'images/products/paket-hampers-oleh-oleh-pemalang.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(13,4,4,'Rengginang Ketan 250g','rengginang-ketan-250g','Rengginang ketan mentah, tinggal goreng.',17000.00,30,250,60,0,'images/products/rengginang-ketan-250g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(14,5,5,'Paket Nasi Grombyang Siap Saji','paket-nasi-grombyang-siap-saji','Paket untuk 2 porsi: daging sapi, kuah kluwek berempah dalam kemasan terpisah, serundeng, dan bawang goreng. Simpan di kulkas, panaskan kuah sampai mendidih lalu siram ke nasi. Tahan 3 hari di kulkas.',45000.00,20,900,3,1,'images/products/paket-nasi-grombyang-siap-saji.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(15,5,4,'Kue Kamir Original isi 10','kue-kamir-original-isi-10','Kue kamir khas Pemalang dari adonan terigu, telur, dan mentega dengan tape. Manis, legit, sedikit gosong di pinggir. Tahan sekitar 4 hari.',25000.00,30,600,4,1,'images/products/kue-kamir-original-isi-10.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(16,5,4,'Apem Kukus Daun Pisang','apem-kukus-daun-pisang','Apem tepung beras dan santan yang dikukus beralas daun pisang. Isi 10.',15000.00,25,400,2,0,'images/products/apem-kukus-daun-pisang.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(17,5,4,'Kue Putu Ayu isi 12','kue-putu-ayu-isi-12','Kue putu ayu pandan dengan taburan kelapa parut.',18000.00,20,350,2,0,'images/products/kue-putu-ayu-isi-12.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(18,4,4,'Wajik Ketan Gula Merah','wajik-ketan-gula-merah','Wajik dari beras ketan dan gula merah, legit dan wangi daun pandan.',22000.00,25,400,7,0,'images/products/wajik-ketan-gula-merah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(19,4,4,'Jenang Ketan Bungkus Klobot','jenang-ketan-bungkus-klobot','Jenang ketan santan gula merah, dibungkus kulit jagung (klobot).',25000.00,20,500,14,0,'images/products/jenang-ketan-bungkus-klobot.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(20,4,4,'Dodol Aneka Rasa 500g','dodol-aneka-rasa-500g','Dodol bungkus kecil rasa original, durian, dan nangka.',30000.00,30,500,60,0,'images/products/dodol-aneka-rasa-500g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(21,4,4,'Kue Lidah Kucing Toples','kue-lidah-kucing-toples','Kue kering lidah kucing tipis dan renyah dalam toples.',45000.00,20,300,60,0,'images/products/kue-lidah-kucing-toples.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(22,4,4,'Nastar Selai Nanas Toples','nastar-selai-nanas-toples','Nastar lembut dengan selai nanas buatan sendiri.',65000.00,20,400,45,1,'images/products/nastar-selai-nanas-toples.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(23,4,4,'Kastengel Keju Toples','kastengel-keju-toples','Kastengel keju edam, gurih dan wangi.',70000.00,15,400,45,0,'images/products/kastengel-keju-toples.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(24,4,4,'Kembang Goyang Renyah','kembang-goyang-renyah','Kembang goyang tepung beras, manis gurih.',25000.00,30,250,60,0,'images/products/kembang-goyang-renyah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(25,4,4,'Kue Satu Kacang Hijau','kue-satu-kacang-hijau','Kue satu dari tepung kacang hijau yang dicetak dan dijemur.',20000.00,30,250,30,0,'images/products/kue-satu-kacang-hijau.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(26,4,4,'Semprong Gulung Wijen','semprong-gulung-wijen','Kue semprong gulung tipis dengan wijen.',28000.00,25,250,60,0,'images/products/semprong-gulung-wijen.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(27,4,4,'Semprong Lipat Kelapa','semprong-lipat-kelapa','Semprong lipat dengan aroma kelapa.',28000.00,25,250,60,0,'images/products/semprong-lipat-kelapa.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(28,4,1,'Kue Bawang Stik','kue-bawang-stik','Stik bawang gurih untuk teman ngeteh.',20000.00,40,250,60,0,'images/products/kue-bawang-stik.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(29,1,1,'Rempeyek Kacang Tanah','rempeyek-kacang-tanah','Rempeyek tepung beras dengan kacang tanah, renyah dan gurih.',20000.00,40,200,30,0,'images/products/rempeyek-kacang-tanah.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(30,1,1,'Kacang Bawang Gurih','kacang-bawang-gurih','Kacang tanah kupas goreng dengan bawang putih.',18000.00,40,250,60,0,'images/products/kacang-bawang-gurih.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(31,1,1,'Keripik Singkong Original','keripik-singkong-original','Keripik singkong tipis, asin gurih.',15000.00,50,250,60,0,'images/products/keripik-singkong-original.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(32,1,1,'Keripik Singkong Balado','keripik-singkong-balado','Keripik singkong dengan bumbu balado pedas manis.',17000.00,50,250,60,0,'images/products/keripik-singkong-balado.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(33,1,1,'Keripik Pisang Manis','keripik-pisang-manis','Keripik pisang tanduk dengan lapisan gula tipis.',18000.00,40,250,60,0,'images/products/keripik-pisang-manis.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(34,1,1,'Opak Singkong Bakar','opak-singkong-bakar','Opak singkong mentah, dibakar atau digoreng sebelum disantap.',15000.00,40,250,60,0,'images/products/opak-singkong-bakar.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(35,1,1,'Kerupuk Kulit Rambak','kerupuk-kulit-rambak','Kerupuk kulit sapi yang renyah, cocok untuk teman makan.',25000.00,30,150,60,0,'images/products/kerupuk-kulit-rambak.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(36,1,1,'Emping Jagung Manis','emping-jagung-manis','Emping jagung pipih dengan rasa manis.',16000.00,40,250,60,0,'images/products/emping-jagung-manis.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(37,1,1,'Kue Keciput Wijen','kue-keciput-wijen','Bola-bola kecil tepung ketan berbalut wijen.',20000.00,30,250,60,0,'images/products/kue-keciput-wijen.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(38,2,6,'Manisan Pepaya Moga','manisan-pepaya-moga','Manisan pepaya kering dari Moga, manis dan kenyal.',20000.00,30,250,30,1,'images/products/manisan-pepaya-moga.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(39,2,2,'Wedang Jahe Instan','wedang-jahe-instan','Serbuk jahe merah dan gula untuk wedang jahe hangat.',18000.00,50,200,365,0,'images/products/wedang-jahe-instan.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(40,2,6,'Nanas Madu Pemalang','nanas-madu-pemalang','Nanas madu segar yang manis, harga per buah.',15000.00,40,1200,7,0,'images/products/nanas-madu-pemalang.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(41,6,6,'Gula Aren Cetak Bongas 1kg','gula-aren-cetak-bongas-1kg','Gula aren padat dari Desa Bongas, Watukumpul. Dimasak dengan kayu bakar tanpa campuran, isi 5 linting.',30000.00,50,1000,180,1,'images/products/gula-aren-cetak-bongas-1kg.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(42,6,6,'Gula Aren Cair 250ml','gula-aren-cair-250ml','Gula aren cair untuk kopi, es, dan kue.',25000.00,40,300,180,0,'images/products/gula-aren-cair-250ml.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(43,7,7,'Ikan Asin Teri Nasi 250g','ikan-asin-teri-nasi-250g','Teri nasi asin kering, kecil dan gurih.',30000.00,30,250,90,0,'images/products/ikan-asin-teri-nasi-250g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(44,7,7,'Ikan Asin Jambal 250g','ikan-asin-jambal-250g','Ikan asin jambal kering untuk digoreng atau dibakar.',40000.00,25,250,90,0,'images/products/ikan-asin-jambal-250g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(45,7,7,'Terasi Udang Rebon','terasi-udang-rebon','Terasi dari udang rebon untuk sambal dan masakan.',15000.00,40,200,180,0,'images/products/terasi-udang-rebon.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(46,7,7,'Kerupuk Udang Mentah 500g','kerupuk-udang-mentah-500g','Kerupuk udang mentah, mekar besar saat digoreng.',35000.00,30,500,120,0,'images/products/kerupuk-udang-mentah-500g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(47,7,7,'Abon Sapi 100g','abon-sapi-100g','Abon daging sapi manis gurih.',35000.00,25,100,90,0,'images/products/abon-sapi-100g.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(48,3,3,'Sarung Batik Cap','sarung-batik-cap','Sarung batik cap katun, nyaman untuk sehari-hari.',135000.00,15,450,NULL,0,'images/products/sarung-batik-cap.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(49,3,3,'Kain Batik Tulis 2 Meter','kain-batik-tulis-2-meter','Kain batik tulis halus, panjang 2 meter.',250000.00,8,400,NULL,0,'images/products/kain-batik-tulis-2-meter.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(50,3,3,'Blangkon Batik','blangkon-batik','Blangkon batik untuk acara adat atau koleksi.',60000.00,15,150,NULL,0,'images/products/blangkon-batik.webp','2026-10-26 19:58:45','2026-10-26 19:58:45'),(51,8,8,'Bakul Anyaman Bambu','bakul-anyaman-bambu','Bakul bambu anyaman tangan untuk nasi atau wadah serbaguna.',35000.00,20,400,NULL,0,'images/products/bakul-anyaman-bambu.webp','2026-10-26 19:58:45','2026-10-26 19:58:45');
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
INSERT INTO `sessions` VALUES ('5AhNhuSAOXJ8hyoKdSxvSzwLHJcN6ntGz4yXpYWh',NULL,'127.0.0.1','curl/8.7.1','eyJfdG9rZW4iOiJUTVdsRDIySGhYMk41WWtiRXg5UWdTd2NKRks5bFVwc2xvTzhueTdnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793069948),('GBqmUI99ILO9AGgnuJEGPWiZR4cGDtxUQoZ6vpI9',NULL,'127.0.0.1','curl/8.7.1','eyJfdG9rZW4iOiJXemliSTBpUHlxUjJBaGt0cVFxOHhOOWltMjFIcXNzNGZLSU9zd3lPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793069948),('i5d7xBAo3YriKnmFDYIujGLFBcOS8atOnBtWHPu5',NULL,'127.0.0.1','curl/8.7.1','eyJfdG9rZW4iOiJWOVlDYzE5dWNNdnhTQUVVbEJxVGl1TExheGFNUG05TzljTGQ1blBBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC90b2tvXC9hbnlhbWFuLWJhbWJ1LXJhbmR1ZG9uZ2thbCIsInJvdXRlIjoic2hvcC5zdG9yZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1793069948),('UZuyo3FU6jcKvjZ4rNCdR9i8HXSZ0y20QkC6wX8q',NULL,'127.0.0.1','curl/8.7.1','eyJfdG9rZW4iOiJyZmVROTlQQmtnYW1LSEVBQmFyQUlNQXhLSlJ4QzlTVDVsa3E3TkdsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWtcL3Bha2V0LW5hc2ktZ3JvbWJ5YW5nLXNpYXAtc2FqaSIsInJvdXRlIjoic2hvcC5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793069948),('xyRLLhx1xKVVbf1pAuJIqUR39jZaDLG9fxJMWfCm',NULL,'127.0.0.1','curl/8.7.1','eyJfdG9rZW4iOiI2TDlMRVBmcVV1NFl4UWtkaDZLTXdHRUtyU0dGUzZnMG5TbzcwU3o0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC90b2tvXC93YXJ1bmctZ3JvbWJ5YW5nLWthbWlyLWthdW1hbiIsInJvdXRlIjoic2hvcC5zdG9yZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1793069948);
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
INSERT INTO `stores` VALUES (1,4,'Camilan Mbok Darmi','camilan-mbok-darmi','Camilan rumahan dan kerupuk, digoreng tiap pagi.','images/stores/camilan-mbok-darmi.webp','Desa Taman, Kec. Taman, Kab. Pemalang, Jawa Tengah',-6.9013234,109.4057555,'081200000001',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(2,5,'Kopi & Teh Lereng Moga','kopi-teh-lereng-moga','Kopi robusta dari kebun rakyat di lereng selatan Pemalang, teh tubruk, dan manisan pepaya.','images/stores/kopi-teh-lereng-moga.webp','Kec. Moga, Kab. Pemalang, Jawa Tengah',-7.1159719,109.2459363,'081200000002',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(3,6,'Batik Sekar Pemalang','batik-sekar-pemalang','Batik cap dan tulis karya perajin lokal.','images/stores/batik-sekar-pemalang.webp','Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8960000,109.3780000,'081200000003',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(4,7,'Dapur Oleh-Oleh Comal','dapur-oleh-oleh-comal','Kue kering, jajanan tradisional, dan paket hampers untuk kiriman keluarga.','images/stores/dapur-oleh-oleh-comal.webp','Kec. Comal, Kab. Pemalang, Jawa Tengah',-6.9063768,109.5331389,'081200000004',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(5,8,'Warung Grombyang & Kamir Kauman','warung-grombyang-kamir-kauman','Paket nasi grombyang siap saji dan kue kamir buatan rumahan.','images/stores/warung-grombyang-kamir-kauman.webp','Kel. Kauman, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8873513,109.3882311,'081200000005',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(6,9,'Gula Aren Lestari Watukumpul','gula-aren-lestari-watukumpul','Gula aren cetak dan cair dari nira pohon aren, dimasak dengan kayu bakar.','images/stores/gula-aren-lestari-watukumpul.webp','Kec. Watukumpul, Kab. Pemalang, Jawa Tengah',-7.1567969,109.4201937,'081200000006',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(7,10,'Hasil Laut Ulujami','hasil-laut-ulujami','Ikan asin, terasi, dan kerupuk udang dari pesisir Pemalang timur.','images/stores/hasil-laut-ulujami.webp','Kec. Ulujami, Kab. Pemalang, Jawa Tengah',-6.8835112,109.5655788,'081200000007',1,'2026-10-26 19:58:45','2026-10-26 19:58:45'),(8,11,'Anyaman Bambu Randudongkal','anyaman-bambu-randudongkal','Bakul dan wadah anyaman bambu buatan tangan.','images/stores/anyaman-bambu-randudongkal.webp','Kec. Randudongkal, Kab. Pemalang, Jawa Tengah',-7.0999072,109.3235966,'081200000008',0,'2026-10-26 19:58:45','2026-10-26 19:58:45');
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
INSERT INTO `users` VALUES (1,'Admin Platform','admin@umkm.test','admin',NULL,'$2y$12$F39srchmvsXk5xdd.QdyHOQ/sh3GRrSiXjxBQI3yHqv7KtiF/iBVC',NULL,'2026-10-26 19:58:41','2026-10-26 19:58:41'),(2,'Staff Moderator','staff@umkm.test','staff',NULL,'$2y$12$Q1oiGCxWHw4qXn8gHyLoCOMvCQJDAHhehWbgc6lysB4s.mbeR2qay',NULL,'2026-10-26 19:58:41','2026-10-26 19:58:41'),(3,'Budi Perantau','customer@umkm.test','customer',NULL,'$2y$12$V8gdobGg83FbP83m0z.KBOxpAH5kRDhD7mVJWtJPawcLfxS1bkoLO',NULL,'2026-10-26 19:58:42','2026-10-26 19:58:42'),(4,'Bu Darmi','seller@umkm.test','seller',NULL,'$2y$12$0y8o/fH/rTSB9RVAq0lmT.TTULI.hP/1NtJU8wMQMc9UIvSuhX56i',NULL,'2026-10-26 19:58:42','2026-10-26 19:58:42'),(5,'Pak Slamet','kopi@umkm.test','seller',NULL,'$2y$12$/UbVtH.Jb/cbUfx/9a/wYeSMNQBorJ4BtjUXKvCIOoJZkc4Wxvip2',NULL,'2026-10-26 19:58:43','2026-10-26 19:58:43'),(6,'Mbak Sekar','batik@umkm.test','seller',NULL,'$2y$12$dV9i3iOj4iMXRj..A88Lw.ky3.GbLOZV196QPvBQQXOtc994WxBDi',NULL,'2026-10-26 19:58:43','2026-10-26 19:58:43'),(7,'Mas Arif','comal@umkm.test','seller',NULL,'$2y$12$1jR2LQzo3QzqjSsLdFdyqenaJ2ckVZXua1KrNyfivrl6H68MjdEWG',NULL,'2026-10-26 19:58:43','2026-10-26 19:58:43'),(8,'Bu Halimah','grombyang@umkm.test','seller',NULL,'$2y$12$dGzrI2UIktz86LRfCuSN0OoTLgiYKcTeXj1RRhUWz410igxso2IWe',NULL,'2026-10-26 19:58:44','2026-10-26 19:58:44'),(9,'Pak Karyo','aren@umkm.test','seller',NULL,'$2y$12$g9R1XUbZ6BnARFiB2iucUu1DgMyMQ7nJCtp4i12SvjGRy6ORMkmAi',NULL,'2026-10-26 19:58:44','2026-10-26 19:58:44'),(10,'Bu Wartini','laut@umkm.test','seller',NULL,'$2y$12$lmUZfuZrfxoejSwsk3zSIOboaevzSFo7PcE2O01DU2P/iySHQN6ne',NULL,'2026-10-26 19:58:44','2026-10-26 19:58:44'),(11,'Pak Darsono','bambu@umkm.test','seller',NULL,'$2y$12$Jf0kgO/KAs8ym5o/NKv6Iemyg/I/lZDBUNEZ3t444lPJGXJlmniWW',NULL,'2026-10-26 19:58:45','2026-10-26 19:58:45');
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

-- Dump completed on 2026-10-27  9:59:19
