-- database umkm_shop (Oleh-Oleh Pemalang)
-- import: mysql -u root -p umkm_shop < umkm_shop.sql

SET FOREIGN_KEY_CHECKS = 0;

-- tabel user (admin, staff, seller, customer)
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','staff','seller','customer') NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES (1,'Admin Platform','admin@umkm.test','admin',NULL,'$2y$12$I8uWvqXni0E/dNr0EdSnr..BkAweD8eRc/HnHsuIiyU7Y6JlNpXXi',NULL,'2026-10-29 01:16:30','2026-10-29 01:16:30');
INSERT INTO `users` VALUES (2,'Staff Moderator','staff@umkm.test','staff',NULL,'$2y$12$wSdMS6m9lyOjIWlS.JJeQOeWISLB1UYAu16ZHujrW065IV9dIuCXq',NULL,'2026-10-29 01:16:30','2026-10-29 01:16:30');
INSERT INTO `users` VALUES (3,'Budi Perantau','customer@umkm.test','customer',NULL,'$2y$12$igaGiypMVdIphKS7LTGyWuMthtC/YHJwuUlex6T9HrmqwsT8tcwre',NULL,'2026-10-29 01:16:31','2026-10-29 01:16:31');
INSERT INTO `users` VALUES (4,'Pak Slamet','kopi@umkm.test','seller',NULL,'$2y$12$LaM6r9im05WJmGYav5kcRuqh8MoWA4BsQ7NTRR0ZQT98qajzU/x1.',NULL,'2026-10-29 01:16:31','2026-10-29 01:16:31');
INSERT INTO `users` VALUES (5,'Mbak Sekar','batik@umkm.test','seller',NULL,'$2y$12$Yyr4kKp8o3a9O6aOrF09yuMK9uI/mc/QLF5tUs6htaI03jlbgAkyy',NULL,'2026-10-29 01:16:31','2026-10-29 01:16:31');
INSERT INTO `users` VALUES (6,'Mas Arif','comal@umkm.test','seller',NULL,'$2y$12$c8JGQg.cMwwQT4Y8CZ4Jk.8RYZFaEfPA8h1RRf0r455F1UyN2JDge',NULL,'2026-10-29 01:16:32','2026-10-29 01:16:32');
INSERT INTO `users` VALUES (7,'Bu Halimah','grombyang@umkm.test','seller',NULL,'$2y$12$uPwxvVKh.fvgSvNcu5dISesTtUaW.8HJO4CIqKnLzfogWrXX3WGp.',NULL,'2026-10-29 01:16:32','2026-10-29 01:16:32');
INSERT INTO `users` VALUES (8,'Pak Karyo','aren@umkm.test','seller',NULL,'$2y$12$wtCek8iqB0XVbnt2IIhbSuHebeG5rWz0chhxhCZXUevwAMNxfURoC',NULL,'2026-10-29 01:16:32','2026-10-29 01:16:32');
INSERT INTO `users` VALUES (9,'Bu Wartini','laut@umkm.test','seller',NULL,'$2y$12$OINay9lKjGIhbo6jenpdAeypZu/TWuAlJXOgh.viZp9k.rPLC9H0O',NULL,'2026-10-29 01:16:33','2026-10-29 01:16:33');
INSERT INTO `users` VALUES (10,'Pak Darsono','bambu@umkm.test','seller',NULL,'$2y$12$zpf5EEycQS7fbGzyXhHdW.GehKQjgghydxYwwTOaJlGPM4tJ94XVG',NULL,'2026-10-29 01:16:33','2026-10-29 01:16:33');
INSERT INTO `users` VALUES (11,'Admin Penguji','demo.admin@umkm.test','admin',NULL,'$2y$12$FGE9JXu1d1i4Km4JWDmVy.6cwokiPLxHsB2D5ikEuTzq0kAvwFq2m',NULL,'2026-10-29 01:16:34','2026-10-29 01:18:25');
INSERT INTO `users` VALUES (12,'Bu Darmi','demo.seller@umkm.test','seller',NULL,'$2y$12$FGE9JXu1d1i4Km4JWDmVy.6cwokiPLxHsB2D5ikEuTzq0kAvwFq2m',NULL,'2026-10-29 01:16:34','2026-10-29 01:18:25');
INSERT INTO `users` VALUES (13,'Pembeli Penguji','demo.customer@umkm.test','customer',NULL,'$2y$12$FGE9JXu1d1i4Km4JWDmVy.6cwokiPLxHsB2D5ikEuTzq0kAvwFq2m',NULL,'2026-10-29 01:16:34','2026-10-29 01:18:25');

-- tabel toko, 1 seller punya 1 toko
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  `place_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_user_id_unique` (`user_id`),
  UNIQUE KEY `stores_slug_unique` (`slug`),
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stores` VALUES (1,12,'Camilan Mbok Darmi','camilan-mbok-darmi','Kerupuk usek dan camilan rumahan dari perajin Kalimas, dijual di kios Pasar Randudongkal.','images/stores/camilan-mbok-darmi.webp','Pasar Randudongkal','Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah',-7.1036051,109.3244742,'081200000001',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (2,4,'Kopi & Teh Lereng Moga','kopi-teh-lereng-moga','Kopi robusta petani lereng Gunung Slamet (Pulosari) dan manisan pepaya Moga.','images/stores/kopi-teh-lereng-moga.webp','Pasar Moga','Kios di Pasar Moga, Jl. Raya Moga - Pulosari, Kec. Moga, Kab. Pemalang, Jawa Tengah',-7.1235743,109.2463483,'081200000002',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (3,5,'Batik Canting Lestari','batik-canting-lestari','Batik tulis dan cap motif Pemalangan dari perajin Taman, kiosnya di los sandang Pasar Pagi Pemalang.','images/stores/batik-canting-lestari.webp','Pasar Pagi Pemalang','Kios di Pasar Pagi Pemalang, Jl. Mawar, Kel. Mulyoharjo, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8890280,109.3911390,'081200000003',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (4,6,'Dapur Oleh-Oleh Comal','dapur-oleh-oleh-comal','Kue kering, jajanan tradisional, dan paket hampers dari kios di Pasar Comal.','images/stores/dapur-oleh-oleh-comal.webp','Pasar Comal','Kios di Pasar Comal, Posongan, Kel. Purwoharjo, Kec. Comal, Kab. Pemalang, Jawa Tengah',-6.9057000,109.5334000,'081200000004',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (5,7,'Grombyang & Kamir Semeru','grombyang-kamir-semeru','Paket nasi grombyang dan kue kamir, lapak kuliner di kawasan Alun-Alun Pemalang.','images/stores/grombyang-kamir-semeru.webp','Alun-Alun Pemalang','Kios di Alun-Alun Pemalang, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8902901,109.3806267,'081200000005',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (6,8,'Gula Aren Lestari Watukumpul','gula-aren-lestari-watukumpul','Gula aren cetak dan cair dari perajin Bongas, Watukumpul, plus nanas madu Belik, dijual di Pasar Belik.','images/stores/gula-aren-lestari-watukumpul.webp','Pasar Belik','Kios di Pasar Belik, Jl. Raya Belik - Pulosari, Kec. Belik, Kab. Pemalang, Jawa Tengah',-7.1870190,109.3295400,'081200000006',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (7,9,'Hasil Laut Tanjungsari','hasil-laut-tanjungsari','Ikan asin, terasi, dan kerupuk udang dari nelayan TPI Tanjungsari.','images/stores/hasil-laut-tanjungsari.webp','TPI Tanjungsari Pemalang','Kios di TPI Tanjungsari Pemalang, Jl. Yos Sudarso, Kel. Sugihwaras, Kec. Pemalang, Kab. Pemalang, Jawa Tengah',-6.8685483,109.3684456,'081200000007',1,'2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `stores` VALUES (8,10,'Anyaman Bambu Randudongkal','anyaman-bambu-randudongkal','Bakul dan wadah anyaman bambu buatan tangan, dijual di Pasar Randudongkal.','images/stores/anyaman-bambu-randudongkal.webp','Pasar Randudongkal','Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah',-7.1036051,109.3244742,'081200000008',0,'2026-10-29 01:16:34','2026-10-29 01:16:34');

-- kategori produk
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` VALUES (1,'Camilan & Kerupuk','camilan-kerupuk','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (2,'Kopi & Teh','kopi-teh','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (3,'Batik Pemalang','batik-pemalang','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (4,'Hampers & Kue','hampers-kue','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (5,'Siap Saji','siap-saji','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (6,'Gula & Manisan','gula-manisan','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (7,'Olahan Laut','olahan-laut','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `categories` VALUES (8,'Kerajinan Bambu','kerajinan-bambu','2026-10-29 01:16:34','2026-10-29 01:16:34');

-- produk yang dijual tiap toko
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(12,2) NOT NULL,
  `stock` int unsigned NOT NULL DEFAULT '0',
  `weight_grams` int unsigned NOT NULL DEFAULT '0',
  `shelf_life_days` smallint unsigned DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_store_id_foreign` (`store_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` VALUES (1,1,1,'Grontol Jagung Gurih','grontol-jagung-gurih','Jagung pipil rebus dengan parutan kelapa dan sedikit garam. Paling enak dimakan hari itu juga.',15000.00,40,250,5,1,'images/products/grontol-jagung-gurih.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (2,1,1,'Kerupuk Usek Mentah','kerupuk-usek-mentah','Kerupuk usek: adonan tepung tapioka berbumbu bawang putih yang dikukus, dijemur, lalu digoreng dengan pasir panas tanpa minyak. Teman makan sayur, soto, atau bakso.',13000.00,60,500,90,1,'images/products/kerupuk-usek-mentah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (3,1,1,'Keripik Tempe Renyah','keripik-tempe-renyah','Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.',20000.00,35,200,30,0,'images/products/keripik-tempe-renyah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (4,1,1,'Emping Melinjo Mentah','emping-melinjo-mentah','Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.',35000.00,25,250,120,0,'images/products/emping-melinjo-mentah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (5,2,2,'Kopi Robusta Pulosari Bubuk 250g','kopi-robusta-pulosari-bubuk-250g','Robusta dari petani lereng Gunung Slamet di Kecamatan Pulosari, sangrai medium, giling halus, tanpa campuran.',25000.00,30,250,180,1,'images/products/kopi-robusta-pulosari-bubuk-250g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (6,2,2,'Kopi Robusta Pulosari Biji Sangrai 500g','kopi-robusta-pulosari-biji-sangrai-500g','Biji robusta Pulosari sangrai utuh untuk yang suka menggiling sendiri.',45000.00,20,500,180,0,'images/products/kopi-robusta-pulosari-biji-sangrai-500g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (7,2,2,'Teh Tubruk Melati Gaya Poci','teh-tubruk-melati-gaya-poci','Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.',12000.00,80,100,365,1,'images/products/teh-tubruk-melati-gaya-poci.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (8,2,2,'Gula Batu Kristal 500g','gula-batu-kristal-500g','Pasangan wajib teh tubruk.',15000.00,50,500,365,0,'images/products/gula-batu-kristal-500g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (9,3,3,'Kain Batik Cap Motif Pemalangan','kain-batik-cap-motif-pemalangan','Kain batik cap 2 meter motif Pemalangan (misalnya Gemek Setekem atau Sawat Rante).',150000.00,15,400,NULL,1,'images/products/kain-batik-cap-motif-pemalangan.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (10,3,3,'Kemeja Batik Pria Lengan Panjang','kemeja-batik-pria-lengan-panjang','Kemeja katun batik lengan panjang, ukuran M sampai XL.',175000.00,12,350,NULL,0,'images/products/kemeja-batik-pria-lengan-panjang.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (11,3,3,'Selendang Batik Tulis','selendang-batik-tulis','Selendang batik tulis halus, cocok untuk hadiah.',210000.00,6,150,NULL,0,'images/products/selendang-batik-tulis.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (12,4,4,'Paket Hampers Oleh-Oleh Pemalang','paket-hampers-oleh-oleh-pemalang','Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.',150000.00,10,1500,30,0,'images/products/paket-hampers-oleh-oleh-pemalang.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (13,4,4,'Rengginang Ketan 250g','rengginang-ketan-250g','Rengginang ketan mentah, tinggal goreng.',17000.00,30,250,60,0,'images/products/rengginang-ketan-250g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (14,5,5,'Paket Nasi Grombyang Siap Saji','paket-nasi-grombyang-siap-saji','Paket untuk 2 porsi: daging sapi, kuah kluwek berempah dalam kemasan terpisah, serundeng, dan bawang goreng. Simpan di kulkas, panaskan kuah sampai mendidih lalu siram ke nasi. Tahan 3 hari di kulkas.',40000.00,20,900,3,1,'images/products/paket-nasi-grombyang-siap-saji.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (15,5,4,'Kue Kamir Original isi 10','kue-kamir-original-isi-10','Kue kamir khas Pemalang dari adonan terigu, telur, dan mentega dengan tape. Manis, legit, sedikit gosong di pinggir. Tahan sekitar 4 hari.',20000.00,30,600,4,1,'images/products/kue-kamir-original-isi-10.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (16,5,4,'Apem Kukus Daun Pisang','apem-kukus-daun-pisang','Apem tepung beras dan santan yang dikukus beralas daun pisang. Isi 10.',15000.00,25,400,2,0,'images/products/apem-kukus-daun-pisang.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (17,5,4,'Kue Putu Ayu isi 12','kue-putu-ayu-isi-12','Kue putu ayu pandan dengan taburan kelapa parut.',18000.00,20,350,2,0,'images/products/kue-putu-ayu-isi-12.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (18,4,4,'Wajik Ketan Gula Merah','wajik-ketan-gula-merah','Wajik dari beras ketan dan gula merah, legit dan wangi daun pandan.',22000.00,25,400,7,0,'images/products/wajik-ketan-gula-merah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (19,4,4,'Jenang Ketan Bungkus Klobot','jenang-ketan-bungkus-klobot','Jenang ketan santan gula merah, dibungkus kulit jagung (klobot).',25000.00,20,500,14,0,'images/products/jenang-ketan-bungkus-klobot.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (20,4,4,'Dodol Aneka Rasa 500g','dodol-aneka-rasa-500g','Dodol bungkus kecil rasa original, durian, dan nangka.',30000.00,30,500,60,0,'images/products/dodol-aneka-rasa-500g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (21,4,4,'Kue Lidah Kucing Toples','kue-lidah-kucing-toples','Kue kering lidah kucing tipis dan renyah dalam toples.',45000.00,20,300,60,0,'images/products/kue-lidah-kucing-toples.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (22,4,4,'Nastar Selai Nanas Toples','nastar-selai-nanas-toples','Nastar lembut dengan selai nanas buatan sendiri.',65000.00,20,400,45,1,'images/products/nastar-selai-nanas-toples.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (23,4,4,'Kastengel Keju Toples','kastengel-keju-toples','Kastengel keju edam, gurih dan wangi.',70000.00,15,400,45,0,'images/products/kastengel-keju-toples.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (24,4,4,'Kembang Goyang Renyah','kembang-goyang-renyah','Kembang goyang tepung beras, manis gurih.',25000.00,30,250,60,0,'images/products/kembang-goyang-renyah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (25,4,4,'Kue Satu Kacang Hijau','kue-satu-kacang-hijau','Kue satu dari tepung kacang hijau yang dicetak dan dijemur.',20000.00,30,250,30,0,'images/products/kue-satu-kacang-hijau.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (26,4,4,'Semprong Gulung Wijen','semprong-gulung-wijen','Kue semprong gulung tipis dengan wijen.',28000.00,25,250,60,0,'images/products/semprong-gulung-wijen.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (27,4,4,'Semprong Lipat Kelapa','semprong-lipat-kelapa','Semprong lipat dengan aroma kelapa.',28000.00,25,250,60,0,'images/products/semprong-lipat-kelapa.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (28,4,1,'Kue Bawang Stik','kue-bawang-stik','Stik bawang gurih untuk teman ngeteh.',20000.00,40,250,60,0,'images/products/kue-bawang-stik.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (29,1,1,'Rempeyek Kacang Tanah','rempeyek-kacang-tanah','Rempeyek tepung beras dengan kacang tanah, renyah dan gurih.',20000.00,40,200,30,0,'images/products/rempeyek-kacang-tanah.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (30,1,1,'Kacang Bawang Gurih','kacang-bawang-gurih','Kacang tanah kupas goreng dengan bawang putih.',18000.00,40,250,60,0,'images/products/kacang-bawang-gurih.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (31,1,1,'Keripik Singkong Original','keripik-singkong-original','Keripik singkong tipis, asin gurih.',15000.00,50,250,60,0,'images/products/keripik-singkong-original.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (32,1,1,'Keripik Singkong Balado','keripik-singkong-balado','Keripik singkong dengan bumbu balado pedas manis.',17000.00,50,250,60,0,'images/products/keripik-singkong-balado.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (33,1,1,'Keripik Pisang Manis','keripik-pisang-manis','Keripik pisang tanduk dengan lapisan gula tipis.',18000.00,40,250,60,0,'images/products/keripik-pisang-manis.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (34,1,1,'Opak Singkong Bakar','opak-singkong-bakar','Opak singkong mentah, dibakar atau digoreng sebelum disantap.',15000.00,40,250,60,0,'images/products/opak-singkong-bakar.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (35,1,1,'Kerupuk Kulit Rambak','kerupuk-kulit-rambak','Kerupuk kulit sapi yang renyah, cocok untuk teman makan.',25000.00,30,150,60,0,'images/products/kerupuk-kulit-rambak.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (36,1,1,'Emping Jagung Manis','emping-jagung-manis','Emping jagung pipih dengan rasa manis.',16000.00,40,250,60,0,'images/products/emping-jagung-manis.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (37,1,1,'Kue Keciput Wijen','kue-keciput-wijen','Bola-bola kecil tepung ketan berbalut wijen.',20000.00,30,250,60,0,'images/products/kue-keciput-wijen.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (38,2,6,'Manisan Pepaya Moga','manisan-pepaya-moga','Manisan pepaya kering dari Moga, manis dan kenyal.',20000.00,30,250,30,1,'images/products/manisan-pepaya-moga.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (39,2,2,'Wedang Jahe Instan','wedang-jahe-instan','Serbuk jahe merah dan gula untuk wedang jahe hangat.',18000.00,50,200,365,0,'images/products/wedang-jahe-instan.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (40,6,6,'Nanas Madu Belik','nanas-madu-belik','Nanas madu segar dari kebun Belik, sentra nanas Pemalang. Harga per buah.',15000.00,40,1200,7,0,'images/products/nanas-madu-belik.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (41,6,6,'Gula Aren Cetak Bongas 1kg','gula-aren-cetak-bongas-1kg','Gula aren padat dari Desa Bongas, Watukumpul. Dimasak dengan kayu bakar tanpa campuran, isi 5 linting.',32000.00,50,1000,180,1,'images/products/gula-aren-cetak-bongas-1kg.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (42,6,6,'Gula Aren Cair 250ml','gula-aren-cair-250ml','Gula aren cair untuk kopi, es, dan kue.',25000.00,40,300,180,0,'images/products/gula-aren-cair-250ml.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (43,7,7,'Ikan Asin Teri Nasi 250g','ikan-asin-teri-nasi-250g','Teri nasi asin kering, kecil dan gurih.',30000.00,30,250,90,0,'images/products/ikan-asin-teri-nasi-250g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (44,7,7,'Ikan Asin Jambal 250g','ikan-asin-jambal-250g','Ikan asin jambal kering untuk digoreng atau dibakar.',40000.00,25,250,90,0,'images/products/ikan-asin-jambal-250g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (45,7,7,'Terasi Udang Rebon','terasi-udang-rebon','Terasi dari udang rebon untuk sambal dan masakan.',15000.00,40,200,180,0,'images/products/terasi-udang-rebon.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (46,7,7,'Kerupuk Udang Mentah 500g','kerupuk-udang-mentah-500g','Kerupuk udang mentah, mekar besar saat digoreng.',35000.00,30,500,120,0,'images/products/kerupuk-udang-mentah-500g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (47,4,7,'Abon Sapi 100g','abon-sapi-100g','Abon daging sapi manis gurih.',35000.00,25,100,90,0,'images/products/abon-sapi-100g.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (48,3,3,'Sarung Batik Cap','sarung-batik-cap','Sarung batik cap katun, nyaman untuk sehari-hari.',135000.00,15,450,NULL,0,'images/products/sarung-batik-cap.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (49,3,3,'Kain Batik Tulis 2 Meter','kain-batik-tulis-2-meter','Kain batik tulis halus, panjang 2 meter.',250000.00,8,400,NULL,0,'images/products/kain-batik-tulis-2-meter.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (50,3,3,'Blangkon Batik','blangkon-batik','Blangkon batik untuk acara adat atau koleksi.',60000.00,15,150,NULL,0,'images/products/blangkon-batik.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');
INSERT INTO `products` VALUES (51,8,8,'Bakul Anyaman Bambu','bakul-anyaman-bambu','Bakul bambu anyaman tangan untuk nasi atau wadah serbaguna.',35000.00,20,400,NULL,0,'images/products/bakul-anyaman-bambu.webp','2026-10-29 01:16:34','2026-10-29 01:16:34');

-- transaksi / pesanan
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned DEFAULT NULL,
  `invoice_code` varchar(255) NOT NULL,
  `total` decimal(14,2) NOT NULL,
  `status` enum('pending','paid','shipped','done','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_invoice_code_unique` (`invoice_code`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_store_id_foreign` (`store_id`),
  CONSTRAINT `transactions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- detail barang per transaksi
DROP TABLE IF EXISTS `transaction_items`;
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

-- tabel bawaan laravel
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- tabel bawaan laravel
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- tabel bawaan laravel
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` VALUES ('G7bd0w5v1NJPl0CV3skOnWT7OfKoosWevUBgipRV',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Safari/605.1.15','eyJfdG9rZW4iOiI0R2p5VzQzaVdTVUdvSEJjbmlaOVliUzBpaVVXMzg1RjhNZmpWSHZHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793237391);

-- tabel bawaan laravel
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- tabel bawaan laravel
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- tabel bawaan laravel
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- tabel bawaan laravel
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- riwayat migration laravel
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2026_10_27_020313_add_role_to_users_table',1);
INSERT INTO `migrations` VALUES (5,'2026_10_27_020314_create_categories_table',1);
INSERT INTO `migrations` VALUES (6,'2026_10_27_020316_create_products_table',1);
INSERT INTO `migrations` VALUES (7,'2026_10_27_020317_create_transactions_table',1);
INSERT INTO `migrations` VALUES (8,'2026_10_27_020318_create_transaction_items_table',1);
INSERT INTO `migrations` VALUES (9,'2026_10_27_100000_add_seller_role_to_users_table',1);
INSERT INTO `migrations` VALUES (10,'2026_10_27_100001_create_stores_table',1);
INSERT INTO `migrations` VALUES (11,'2026_10_27_100002_add_marketplace_fields_to_products_table',1);
INSERT INTO `migrations` VALUES (12,'2026_10_27_100003_add_store_id_to_transactions_table',1);
INSERT INTO `migrations` VALUES (13,'2026_10_27_110000_add_photo_and_location_to_stores_table',1);
INSERT INTO `migrations` VALUES (14,'2026_10_27_120000_add_place_name_to_stores_table',1);

SET FOREIGN_KEY_CHECKS = 1;
