-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table petshop.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int DEFAULT '0',
  `confirm_address` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.accounts: ~1 rows (approximately)
INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `fullname`, `address`, `level`, `confirm_address`, `created_at`, `updated_at`) VALUES
	(34, 'thanhben01', 'nben19732@gmail.com', '$2y$10$nqApiruar3aWLjHnGPhazetook6whLwG/RJhrex2ncE5Uz0e3GS/m', 'Nguyễn Hồ Thanh Bền', 'An Bình', 0, 0, '2023-02-21 03:52:15', '2023-02-21 03:52:15');

-- Dumping structure for table petshop.address_payment
CREATE TABLE IF NOT EXISTS `address_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` bigint unsigned NOT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '',
  `address` longtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table petshop.address_payment: ~0 rows (approximately)
INSERT INTO `address_payment` (`id`, `uid`, `fullname`, `address`, `phone`) VALUES
	(3, 1, 'ben ben', '3119 Doctors Drive', '0772841374'),
	(4, 12, 'Nguyễn Hồ Thanh Bền', 'An Bình', '+841222841374');

-- Dumping structure for table petshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_user_id_foreign` (`user_id`),
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.cart: ~3 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(20, 34, '2023-02-24 18:08:19', '2023-02-24 18:08:19');

-- Dumping structure for table petshop.detail_carts
CREATE TABLE IF NOT EXISTS `detail_carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `cartId` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `detail_carts_product_id_foreign` (`product_id`),
  CONSTRAINT `detail_carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.detail_carts: ~7 rows (approximately)
INSERT INTO `detail_carts` (`id`, `product_id`, `quantity`, `total`, `cartId`, `created_at`, `updated_at`, `status`) VALUES
	(27, 5, 1, 5034570, 20, '2023-02-24 18:08:19', '2023-02-24 18:08:19', 0),
	(28, 6, 1, 6908413, 20, '2023-02-24 18:08:19', '2023-02-24 18:08:19', 0);

-- Dumping structure for table petshop.discounts
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percent` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.discounts: ~3 rows (approximately)
INSERT INTO `discounts` (`id`, `name`, `discount_percent`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'KM 50%', 50, 1, NULL, NULL),
	(2, 'KM Tết', 90, 1, NULL, NULL),
	(3, 'KM 20%', 20, 1, NULL, NULL);

-- Dumping structure for table petshop.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.jobs: ~0 rows (approximately)

-- Dumping structure for table petshop.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2023_01_06_095346_create_products_category_table', 2),
	(3, '2023_01_06_095357_create_products_inventory_table', 2),
	(4, '2023_01_06_102022_create_discount_table', 2),
	(5, '2023_01_06_095310_create_products_table', 3),
	(7, '2023_01_15_061325_create_account_table', 5),
	(8, '2023_01_15_061325_create_accounts_table', 6),
	(13, '2023_01_14_090409_create_cart_table', 7),
	(14, '2023_02_02_113518_create_detail_carts_table', 7),
	(15, '2023_02_06_080056_create_wishlists_table', 8),
	(16, '2023_02_21_104024_create_jobs_table', 9),
	(17, '2023_02_23_125236_create_payments_table', 10);

-- Dumping structure for table petshop.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_code` int NOT NULL,
  `amount` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vnpay_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_payment` timestamp NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_cart_id_foreign` (`cart_id`),
  CONSTRAINT `payments_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.payments: ~0 rows (approximately)

-- Dumping structure for table petshop.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table petshop.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `inventory_id` bigint unsigned NOT NULL,
  `discount_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_inventory_id_foreign` (`inventory_id`),
  KEY `products_discount_id_foreign` (`discount_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`),
  CONSTRAINT `products_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`),
  CONSTRAINT `products_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `product_inventories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.products: ~25 rows (approximately)
INSERT INTO `products` (`id`, `name`, `desc`, `category_id`, `inventory_id`, `discount_id`, `image`, `price`, `created_at`, `updated_at`) VALUES
	(2, 'Kẹo Ngọt', '123', 7, 2, 1, 'avatarProduct/ZT4RNN3JINdUNCraSgcxmBlCXIX8MLRHmYAJO68H.webp', 1500000, NULL, '2023-01-12 23:43:17'),
	(5, 'Dicta.', 'Deserunt qui id voluptatem.', 10, 3, 3, 'avatarProduct/KlItDsIF4x3JbPsViM8g9FOReRFxuFfk5p5UTYgl.webp', 5034570, '2023-01-06 22:23:43', '2023-01-12 23:45:44'),
	(6, 'Mollitia.', 'Perferendis aut atque at.', 9, 3, 1, 'avatarProduct/NR92p31y7mjHoDJIailIjpou5xk3OXGXIbgCYBII.webp', 6908413, '2023-01-06 22:23:43', '2023-01-12 23:52:07'),
	(7, 'Et illo.', 'Incidunt dolorum et quos.', 3, 2, 2, 'avatarProduct/1qL5QdExszQSRYbtoyUKlFDGfpl3MSiuppVsx9gK.webp', 3574682, '2023-01-06 22:23:43', '2023-01-14 01:18:31'),
	(8, 'Eos amet.', 'In quos possimus natus.', 1, 2, 2, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 1173687, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(9, 'Officia.', 'Sint adipisci quia magnam.', 1, 3, 2, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 3595897, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(10, 'Officiis.', 'Eum corrupti cumque iusto.', 6, 3, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 7917473, '2023-01-06 22:23:43', '2023-01-11 06:10:29'),
	(11, 'Qui.', 'Minus quae quos quo repellat.', 5, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 8077545, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(12, 'Odio.', 'A at et et asperiores.', 10, 2, 2, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 9978730, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(13, 'Iusto est.', 'Ex rem at minima quia.', 9, 3, 3, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 6069102, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(14, 'Ullam est.', 'Maiores autem quia placeat.', 5, 2, 3, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 2345126, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(15, 'Accusamus.', 'Enim neque illo quia quis.', 3, 3, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 9505208, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(16, 'Modi et.', 'Corrupti aut enim voluptates.', 5, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 8602555, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(17, 'Dolores.', 'Est reiciendis at omnis.', 9, 2, 2, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 6982144, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(18, 'Eos culpa.', 'Est et labore est ut.', 4, 3, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 3140130, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(19, 'Eum.', 'Ea sed quae et deleniti.', 6, 1, 3, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 5633528, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(20, 'Autem sed.', 'Iste et mollitia quasi.', 5, 1, 3, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 5402558, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(21, 'Esse est.', 'Sunt impedit at vero.', 10, 2, 2, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 1066879, '2023-01-06 22:23:43', '2023-01-06 22:23:43'),
	(23, 'Nguyễn Hồ Thanh Bền', 'zacx', 11, 2, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 1200, '2023-01-11 03:54:00', '2023-01-11 03:54:00'),
	(24, 'Ben Nguyen123', 'zacx', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-11 04:45:36', '2023-01-11 04:45:36'),
	(25, 'Nguyễn Hồ Thanh Bền12231231', '432234234', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-11 06:09:05', '2023-01-11 06:09:05'),
	(26, 'Nhãn Lồng123123', '3123123123', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:05:17', '2023-01-12 22:05:17'),
	(27, 'Nhãn Lồng123123333', '3123123123', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:07:09', '2023-01-12 22:07:09'),
	(28, 'cxvxcv', 'àdsdfsdf3432', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:09:04', '2023-01-12 22:09:04'),
	(29, 'cxvxcv123', 'àdsdfsdf3432', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:09:33', '2023-01-12 22:09:33'),
	(30, 'Ben Nguyen123xsf', 'fdsfsd', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:40:09', '2023-01-12 22:40:09'),
	(31, 'Ben Nguyen123xsfccc', 'fdsfsd', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 22:46:08', '2023-01-12 22:46:08'),
	(32, 'Nguyễn Hồ Thanh Bền53463', 'zacx', 1, 1, 1, 'avatarProduct/ZKqnEJnn8NIeI1vERNRHHFpWiV5wsS4RTVmjH2SC.webp', 200000, '2023-01-12 23:11:02', '2023-01-12 23:11:02');

-- Dumping structure for table petshop.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.product_categories: ~11 rows (approximately)
INSERT INTO `product_categories` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'Một', 'SDFSDGGDFG', NULL, NULL),
	(2, 'Ottilie Cartwright', 'Adam Cruickshank IV', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(3, 'Rosetta Morissette PhD', 'Zelma Crist', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(4, 'Dr. Jovani Hill DDS', 'Ms. Chelsea Romaguera', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(5, 'Joelle Blick', 'Meghan Johns', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(6, 'Miss Estella Wyman', 'Yessenia Jast', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(7, 'Hank Lemke', 'Dr. Brendan Dickens', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(8, 'Ellis Eichmann MD', 'Dr. Jerel Pouros', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(9, 'Prof. Marcellus Hagenes I', 'Mercedes Hills', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(10, 'Ivah Dicki', 'Howell Morissette', '2023-01-06 07:35:44', '2023-01-06 07:35:44'),
	(11, 'Prof. Serena Funk DVM', 'Jonatan Cummings', '2023-01-06 07:35:44', '2023-01-06 07:35:44');

-- Dumping structure for table petshop.product_inventories
CREATE TABLE IF NOT EXISTS `product_inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity` smallint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.product_inventories: ~2 rows (approximately)
INSERT INTO `product_inventories` (`id`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 10, NULL, NULL),
	(2, 20, NULL, NULL),
	(3, 3, NULL, NULL);

-- Dumping structure for table petshop.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  KEY `wishlists_uid_foreign` (`uid`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `wishlists_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petshop.wishlists: ~2 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
