-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table daruuri.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.brands: ~2 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`, `brand_name`, `status`, `created_at`, `updated_at`) VALUES
	(4, 'SamSung', '1', NULL, NULL),
	(5, 'Iphone', '1', NULL, NULL),
	(6, 'Asus', '1', NULL, NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table daruuri.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.cache: ~8 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('daruuri_cache_brands', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":2:{s:2:"id";i:6;s:10:"brand_name";s:4:"Asus";}i:1;O:8:"stdClass":2:{s:2:"id";i:4;s:10:"brand_name";s:7:"SamSung";}}}', 1911838240),
	('daruuri_cache_categories', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":3:{s:2:"id";i:4;s:13:"category_name";s:13:"Mobile Phones";s:13:"category_slug";s:13:"mobile-phones";}i:1;O:8:"stdClass":3:{s:2:"id";i:3;s:13:"category_name";s:11:"Phone Parts";s:13:"category_slug";s:11:"phone-parts";}}}', 1911838240),
	('daruuri_cache_faqs', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":4:{s:2:"id";i:3;s:8:"question";s:34:"How long is the Daruuri guarantee?";s:6:"answer";s:108:"All repairs are guaranteed for 3 months from the date they are undertaken. The guarantee is 100% no-quibble.";s:7:"sorting";i:1;}i:1;O:8:"stdClass":4:{s:2:"id";i:4;s:8:"question";s:30:"What does the guarantee cover?";s:6:"answer";s:51:"It covers the specific fault that Daruuri repaired.";s:7:"sorting";i:2;}}}', 1911919675),
	('daruuri_cache_highlighted_services', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":5:{s:2:"id";i:2;s:12:"service_name";s:12:"Phone Unlock";s:5:"image";s:65:"mobile-repairing-service-centres-shops-in-mumbai5f288b384ea9f.jpg";s:11:"description";s:80:"Leverage agile frameworks to provide a robust synopsis for high level overviews.";s:7:"sorting";i:1;}i:1;O:8:"stdClass":5:{s:2:"id";i:3;s:12:"service_name";s:19:"Broken Glass Repair";s:5:"image";s:38:"selection-583-500x5005f288b6c29234.png";s:11:"description";s:80:"Leverage agile frameworks to provide a robust synopsis for high level overviews.";s:7:"sorting";i:2;}}}', 1911853242),
	('daruuri_cache_pages', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":4:{s:2:"id";i:2;s:5:"title";s:31:"Mobile Hardware Repair Solution";s:5:"image";s:90:"Refurbished-Service-Repair-Service-Renew-Service-Cell-Phones-for-iPhone-85f280409989c2.jpg";s:11:"description";s:271:"Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo in consequat. Duis aute irure dolor in reprehenderit.";}i:1;O:8:"stdClass":4:{s:2:"id";i:3;s:5:"title";s:24:"Mobile Software Solution";s:5:"image";s:74:"Small-Business-Mobile-Apps-How-to-Build-Mobile-Apps-230525f28051628737.jpg";s:11:"description";s:271:"Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo in consequat. Duis aute irure dolor in reprehenderit.";}}}', 1911838277),
	('daruuri_cache_roles', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:2:{i:0;O:8:"stdClass":2:{s:2:"id";i:2;s:4:"role";s:5:"Admin";}i:1;O:8:"stdClass":2:{s:2:"id";i:6;s:4:"role";s:8:"Employee";}}}', 1912333875),
	('daruuri_cache_services', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:8:{i:0;O:8:"stdClass":2:{s:2:"id";i:2;s:12:"service_name";s:7:"Battery";}i:1;O:8:"stdClass":2:{s:2:"id";i:3;s:12:"service_name";s:11:"Charge Port";}i:2;O:8:"stdClass":2:{s:2:"id";i:1;s:12:"service_name";s:7:"Display";}i:3;O:8:"stdClass":2:{s:2:"id";i:4;s:12:"service_name";s:12:"Front Camera";}i:4;O:8:"stdClass":2:{s:2:"id";i:6;s:12:"service_name";s:10:"Microphone";}i:5;O:8:"stdClass":2:{s:2:"id";i:8;s:12:"service_name";s:20:"Program Installation";}i:6;O:8:"stdClass":2:{s:2:"id";i:5;s:12:"service_name";s:11:"Rear Camera";}i:7;O:8:"stdClass":2:{s:2:"id";i:7;s:12:"service_name";s:7:"Speaker";}}}', 1912299743),
	('daruuri_cache_sliders', 'O:29:"Illuminate\\Support\\Collection":1:{s:8:"\0*\0items";a:3:{i:0;O:8:"stdClass":6:{s:2:"id";i:1;s:5:"title";s:11:"Repair Shop";s:9:"sub_title";s:19:"Trusted Repair Shop";s:5:"image";s:50:"joel-rohland-C1r9pODhfQ4-unsplash5f28721cb02ef.jpg";s:11:"button_link";N;s:7:"sorting";i:1;}i:1;O:8:"stdClass":6:{s:2:"id";i:2;s:5:"title";s:11:"Repair Shop";s:9:"sub_title";s:19:"Trusted Repair Shop";s:5:"image";s:49:"k-i-l-i-a-n-PZLgTUAhxMM-unsplash5f28724237cb9.jpg";s:11:"button_link";s:7:"service";s:7:"sorting";i:2;}i:2;O:8:"stdClass":6:{s:2:"id";i:3;s:5:"title";s:11:"Repair Shop";s:9:"sub_title";s:19:"Trusted Repair Shop";s:5:"image";s:46:"pr-media-iuU2aZdzp_M-unsplash5f28728670210.jpg";s:11:"button_link";s:21:"product/mobile-phones";s:7:"sorting";i:3;}}}', 1911846958);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table daruuri.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_name_unique` (`category_name`),
  UNIQUE KEY `categories_category_slug_unique` (`category_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Phone Parts', 'phone-parts', '1', NULL, NULL),
	(4, 'Mobile Phones', 'mobile-phones', '1', NULL, NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table daruuri.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.contact_messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;

-- Dumping structure for table daruuri.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table daruuri.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.faqs: ~2 rows (approximately)
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` (`id`, `question`, `answer`, `sorting`, `created_at`, `updated_at`) VALUES
	(3, 'How long is the Daruuri guarantee?', 'All repairs are guaranteed for 3 months from the date they are undertaken. The guarantee is 100% no-quibble.', 1, NULL, NULL),
	(4, 'What does the guarantee cover?', 'It covers the specific fault that Daruuri repaired.', 2, NULL, NULL);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;

-- Dumping structure for table daruuri.highlighted_services
CREATE TABLE IF NOT EXISTS `highlighted_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sorting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.highlighted_services: ~2 rows (approximately)
/*!40000 ALTER TABLE `highlighted_services` DISABLE KEYS */;
INSERT INTO `highlighted_services` (`id`, `service_name`, `image`, `description`, `sorting`, `created_at`, `updated_at`) VALUES
	(2, 'Phone Unlock', 'mobile-repairing-service-centres-shops-in-mumbai5f288b384ea9f.jpg', 'Leverage agile frameworks to provide a robust synopsis for high level overviews.', 1, '2020-08-03 22:09:18', '2020-08-03 22:09:59'),
	(3, 'Broken Glass Repair', 'selection-583-500x5005f288b6c29234.png', 'Leverage agile frameworks to provide a robust synopsis for high level overviews.', 2, '2020-08-03 22:10:51', '2020-08-03 22:10:51');
/*!40000 ALTER TABLE `highlighted_services` ENABLE KEYS */;

-- Dumping structure for table daruuri.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
	(2, 'default', '{"uuid":"c172c7b1-f0c5-4db1-8673-affa7a7c83f1","displayName":"App\\\\Jobs\\\\ContactMessageJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\ContactMessageJob","command":"O:26:\\"App\\\\Jobs\\\\ContactMessageJob\\":9:{s:7:\\"\\u0000*\\u0000data\\";a:5:{s:4:\\"name\\";s:8:\\"Mohammad\\";s:5:\\"email\\";s:32:\\"mohammadarman.iiuc.cse@gmail.com\\";s:5:\\"phone\\";s:11:\\"01521225987\\";s:7:\\"subject\\";s:12:\\"Test Contact\\";s:7:\\"message\\";s:42:\\"larael skmdfkl slkmdfkls lksmdf lkmsdf sdm\\";}s:3:\\"job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2020-08-06 03:57:24.546261\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"middleware\\";a:0:{}s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1596686244, 1596685644);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table daruuri.methods
CREATE TABLE IF NOT EXISTS `methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint(20) unsigned NOT NULL,
  `method_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `methods_method_slug_unique` (`method_slug`),
  KEY `methods_module_id_foreign` (`module_id`),
  CONSTRAINT `methods_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.methods: ~91 rows (approximately)
/*!40000 ALTER TABLE `methods` DISABLE KEYS */;
INSERT INTO `methods` (`id`, `module_id`, `method_name`, `method_slug`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Dashboard Manage', 'dashboard-manage', NULL, NULL),
	(2, 5, 'Setting General', 'setting-general', NULL, NULL),
	(7, 6, 'Role Manage', 'role-manage', NULL, NULL),
	(8, 6, 'Role Add', 'role-add', NULL, NULL),
	(9, 6, 'Role Edit', 'role-edit', NULL, NULL),
	(10, 6, 'Role View', 'role-view', NULL, NULL),
	(11, 6, 'Role Delete', 'role-delete', NULL, NULL),
	(12, 6, 'Role Bulk Action Delete', 'role-bulk-action-delete', NULL, NULL),
	(13, 6, 'Role Report', 'role-report', NULL, NULL),
	(14, 7, 'Module Manage', 'module-manage', NULL, NULL),
	(15, 7, 'Module Add', 'module-add', NULL, NULL),
	(16, 7, 'Module Edit', 'module-edit', NULL, NULL),
	(17, 7, 'Module View', 'module-view', NULL, NULL),
	(18, 7, 'Module Delete', 'module-delete', NULL, NULL),
	(19, 7, 'Module Bulk Action Delete', 'module-bulk-action-delete', NULL, NULL),
	(20, 7, 'Module Report', 'module-report', NULL, NULL),
	(21, 8, 'Method Manage', 'method-manage', NULL, NULL),
	(22, 8, 'Method Add', 'method-add', NULL, NULL),
	(23, 8, 'Method Edit', 'method-edit', NULL, NULL),
	(24, 8, 'Method View', 'method-view', NULL, NULL),
	(25, 8, 'Method Delete', 'method-delete', NULL, NULL),
	(26, 8, 'Method Bulk Action Delete', 'method-bulk-action-delete', NULL, NULL),
	(27, 8, 'Method Report', 'method-report', NULL, NULL),
	(28, 2, 'User Manage', 'user-manage', NULL, NULL),
	(29, 2, 'User Add', 'user-add', NULL, NULL),
	(30, 2, 'User Edit', 'user-edit', NULL, NULL),
	(31, 2, 'User View', 'user-view', NULL, NULL),
	(32, 2, 'User Delete', 'user-delete', NULL, NULL),
	(33, 2, 'User Bulk Action Delete', 'user-bulk-action-delete', NULL, NULL),
	(34, 2, 'User Report', 'user-report', NULL, NULL),
	(35, 2, 'User Password Change', 'user-password-change', NULL, NULL),
	(37, 9, 'Brand Access', 'brand-access', NULL, NULL),
	(38, 9, 'Brand Add', 'brand-add', NULL, NULL),
	(39, 9, 'Brand Edit', 'brand-edit', NULL, NULL),
	(40, 9, 'Brand Delete', 'brand-delete', NULL, NULL),
	(41, 9, 'Brand Bulk Action Delete', 'brand-bulk-action-delete', NULL, NULL),
	(42, 9, 'Brand Report', 'brand-report', NULL, NULL),
	(43, 10, 'Phone Service Access', 'phone-service-access', NULL, NULL),
	(44, 10, 'Phone Service Add', 'phone-service-add', NULL, NULL),
	(45, 10, 'Phone Service Edit', 'phone-service-edit', NULL, NULL),
	(46, 10, 'Phone Service Delete', 'phone-service-delete', NULL, NULL),
	(47, 10, 'Phone Service Bulk Action Delete', 'phone-service-bulk-action-delete', NULL, NULL),
	(48, 10, 'Phone Service Report', 'phone-service-report', NULL, NULL),
	(49, 11, 'Phone Access', 'phone-access', NULL, NULL),
	(50, 11, 'Phone Add', 'phone-add', NULL, NULL),
	(51, 11, 'Phone Edit', 'phone-edit', NULL, NULL),
	(52, 11, 'Phone VIew', 'phone-view', NULL, NULL),
	(53, 11, 'Phone Delete', 'phone-delete', NULL, NULL),
	(54, 11, 'Phone Bulk Action Delete', 'phone-bulk-action-delete', NULL, NULL),
	(55, 11, 'Phone Report', 'phone-report', NULL, NULL),
	(56, 13, 'Product Access', 'product-access', NULL, NULL),
	(57, 13, 'Product Add', 'product-add', NULL, NULL),
	(58, 13, 'Product Edit', 'product-edit', NULL, NULL),
	(59, 13, 'Product View', 'product-view', NULL, NULL),
	(60, 13, 'Product Delete', 'product-delete', NULL, NULL),
	(61, 13, 'Product Bulk Action Delete', 'product-bulk-action-delete', NULL, NULL),
	(62, 13, 'Product Report', 'product-report', NULL, NULL),
	(63, 14, 'Category Access', 'category-access', NULL, NULL),
	(64, 14, 'Category Add', 'category-add', NULL, NULL),
	(65, 14, 'Category Edit', 'category-edit', NULL, NULL),
	(66, 14, 'Category Delete', 'category-delete', NULL, NULL),
	(67, 14, 'Category Bulk Action Delete', 'category-bulk-action-delete', NULL, NULL),
	(68, 14, 'Category Report', 'category-report', NULL, NULL),
	(69, 15, 'Highlighted Service Access', 'highlighted-service-access', NULL, NULL),
	(70, 15, 'Highlighted Service Add', 'highlighted-service-add', NULL, NULL),
	(71, 15, 'Highlighted Service Edit', 'highlighted-service-edit', NULL, NULL),
	(72, 15, 'Highlighted Service Delete', 'highlighted-service-delete', NULL, NULL),
	(73, 15, 'Highlighted Service Bulk Action Delete', 'highlighted-service-bulk-action-delete', NULL, NULL),
	(74, 15, 'Highlighted Service Report', 'highlighted-service-report', NULL, NULL),
	(75, 16, 'Slider Access', 'slider-access', NULL, NULL),
	(76, 16, 'Slider Add', 'slider-add', NULL, NULL),
	(77, 16, 'Slider Edit', 'slider-edit', NULL, NULL),
	(78, 16, 'Slider Delete', 'slider-delete', NULL, NULL),
	(79, 16, 'Slider Bulk Action Delete', 'slider-bulk-action-delete', NULL, NULL),
	(80, 16, 'Slider Report', 'slider-report', NULL, NULL),
	(81, 17, 'FAQs Access', 'faqs-access', NULL, NULL),
	(82, 17, 'FAQs Add', 'faqs-add', NULL, NULL),
	(83, 17, 'FAQs Edit', 'faqs-edit', NULL, NULL),
	(84, 17, 'FAQs Delete', 'faqs-delete', NULL, NULL),
	(85, 17, 'FAQs Bulk Action Delete', 'faqs-bulk-action-delete', NULL, NULL),
	(86, 17, 'FAQs Report', 'faqs-report', NULL, NULL),
	(87, 18, 'Customer Feedback Access', 'customer-feedback-access', NULL, NULL),
	(88, 18, 'Customer Feedback View', 'customer-feedback-view', NULL, NULL),
	(89, 18, 'Customer Feedback Delete', 'customer-feedback-delete', NULL, NULL),
	(90, 18, 'Customer Feedback Bulk Action Delete', 'customer-feedback-bulk-action-delete', NULL, NULL),
	(91, 18, 'Customer Feedback Report', 'customer-feedback-report', NULL, NULL);
/*!40000 ALTER TABLE `methods` ENABLE KEYS */;

-- Dumping structure for table daruuri.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.migrations: ~21 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_09_30_175918_create_roles_table', 1),
	(2, '2014_10_12_000000_create_users_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2020_07_30_180742_create_modules_table', 1),
	(6, '2020_07_30_180751_create_methods_table', 1),
	(7, '2020_07_30_180816_create_role_module_permissions_table', 1),
	(8, '2020_07_30_180825_create_role_method_permissions_table', 1),
	(9, '2020_07_30_181335_create_settings_table', 1),
	(10, '2020_07_31_170738_create_brands_table', 2),
	(11, '2020_07_31_170749_create_phones_table', 2),
	(12, '2020_07_31_170809_create_services_table', 2),
	(13, '2020_07_31_170847_phone_service', 2),
	(14, '2020_07_31_171049_create_categories_table', 2),
	(15, '2020_07_31_171106_create_products_table', 2),
	(16, '2020_07_31_171519_create_contact_messages_table', 2),
	(17, '2020_08_01_103819_create_cache_table', 3),
	(18, '2020_08_03_113353_create_pages_table', 4),
	(19, '2020_08_03_160334_create_faqs_table', 5),
	(20, '2020_08_03_160347_create_sliders_table', 5),
	(21, '2020_08_03_160404_create_reviews_table', 5),
	(23, '2020_08_03_211803_create_highlighted_services_table', 6),
	(24, '2020_08_06_024333_create_jobs_table', 7),
	(25, '2020_08_06_100127_create_notifications_table', 8),
	(26, '2020_08_09_005949_create_sessions_table', 9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table daruuri.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'javascript:void(0);',
  `module_icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_sequence` int(11) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.modules: ~17 rows (approximately)
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `module_name`, `module_link`, `module_icon`, `module_sequence`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, 'Dashboard', '/', 'fas fa-home', 1000, 0, NULL, NULL),
	(2, 'User', 'user', 'fas fa-users', 18000, 0, NULL, NULL),
	(4, 'Software Settings', 'javascript:void(0);', 'fas fa-cogs', 20000, 0, NULL, NULL),
	(5, 'Setting', 'setting', 'fas fa-tools', 20001, 4, NULL, NULL),
	(6, 'Role', 'role', 'fas fa-user-cog', 20002, 4, NULL, NULL),
	(7, 'Module', 'module', 'fas fa-align-left', 20003, 4, NULL, NULL),
	(8, 'Method', 'method', 'fas fa-list-ol', 20004, 4, NULL, NULL),
	(9, 'Brand', 'brand', 'fab fa-bootstrap', 2000, NULL, NULL, NULL),
	(10, 'Phone Service', 'phone-service', 'fas fa-tools', 3000, NULL, NULL, NULL),
	(11, 'Phone', 'phone', 'fas fa-mobile', 4000, NULL, NULL, NULL),
	(12, 'Manage Product', 'javascript:void(0);', 'fas fa-box', 5000, NULL, NULL, NULL),
	(13, 'Product', 'product', 'fab fa-product-hunt', 5001, 12, NULL, NULL),
	(14, 'Category', 'category', 'fas fa-list', 5002, 12, NULL, NULL),
	(15, 'Highlighted Service', 'highlighted-service', 'fas fa-tools', 6000, NULL, NULL, NULL),
	(16, 'Slider', 'slider', 'fas fa-image', 7000, NULL, NULL, NULL),
	(17, 'FAQs', 'faqs', 'fas fa-question-circle', 8000, NULL, NULL, NULL),
	(18, 'Customer Feedback', 'customer-feedback', 'fas fa-comment-dots', 9000, NULL, NULL, NULL);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;

-- Dumping structure for table daruuri.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.notifications: ~2 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('213bfa8d-de88-4fc4-9a66-a9263b1c6c8e', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 3, '{"id":9,"name":"Mr. Abdul Al Noman","phone":"01680950265","email":"noman@gmail.com","daruuri_rating":"5","communication_rating":"5","stuff_rating":"5","service_rating":"5","referal_rating":"5","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:33:21', '2020-08-10 11:33:21'),
	('40d13403-3684-4f20-949f-ab7384a18a95', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 6, '{"id":9,"name":"Mr. Abdul Al Noman","phone":"01680950265","email":"noman@gmail.com","daruuri_rating":"5","communication_rating":"5","stuff_rating":"5","service_rating":"5","referal_rating":"5","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:33:21', '2020-08-10 11:33:21'),
	('836b4f38-5740-4115-82fc-e96485148dde', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 3, '{"id":8,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"3","communication_rating":"4","stuff_rating":"5","service_rating":"2","referal_rating":"4","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:32:47', '2020-08-10 11:32:47'),
	('86e0186c-52db-4e70-98e2-4486398df261', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 2, '{"id":9,"name":"Mr. Abdul Al Noman","phone":"01680950265","email":"noman@gmail.com","daruuri_rating":"5","communication_rating":"5","stuff_rating":"5","service_rating":"5","referal_rating":"5","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:33:21', '2020-08-10 11:33:21'),
	('9788c9d5-078c-40f5-8a54-ed6dc7a82578', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 2, '{"id":8,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"3","communication_rating":"4","stuff_rating":"5","service_rating":"2","referal_rating":"4","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:32:47', '2020-08-10 11:32:47'),
	('c4992f6d-2832-41a8-860d-443743501365', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 1, '{"id":8,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"3","communication_rating":"4","stuff_rating":"5","service_rating":"2","referal_rating":"4","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-11 11:32:48', '2020-08-10 11:32:47'),
	('d26f04e3-0690-46c3-b148-1a3500611c93', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 1, '{"id":9,"name":"Mr. Abdul Al Noman","phone":"01680950265","email":"noman@gmail.com","daruuri_rating":"5","communication_rating":"5","stuff_rating":"5","service_rating":"5","referal_rating":"5","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:33:21', '2020-08-10 11:33:21'),
	('db85c3a5-3eb7-4684-b826-b22b6111a75f', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 6, '{"id":7,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"4","communication_rating":"5","stuff_rating":"4","service_rating":"4","referal_rating":"5","description":"My device functions and feels as good or better than expected after my repair The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 05:43:17', '2020-08-10 05:43:17'),
	('e41bb71c-d8ac-49e7-85a2-d85136fc27a4', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 3, '{"id":7,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"4","communication_rating":"5","stuff_rating":"4","service_rating":"4","referal_rating":"5","description":"My device functions and feels as good or better than expected after my repair The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 05:43:17', '2020-08-10 05:43:17'),
	('ea92407d-b6a9-441e-9f3a-e99a695ab62e', 'App\\Notifications\\CustomerFeedback', 'App\\Model\\User', 6, '{"id":8,"name":"Mr. Zobbar","phone":"01521225987","email":"zobbar@gmail.com","daruuri_rating":"3","communication_rating":"4","stuff_rating":"5","service_rating":"2","referal_rating":"4","description":"The store communicated expectations about my device throughout the repair process."}', NULL, '2020-08-10 11:32:47', '2020-08-10 11:32:47');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table daruuri.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.pages: ~3 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Repair Services For Your Mobile', 'about-min5f2848107b4eb.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo in consequat. Duis aute irure dolor in reprehenderit.', NULL, '2020-08-03 17:23:28'),
	(2, 'Mobile Hardware Repair Solution', 'Refurbished-Service-Repair-Service-Renew-Service-Cell-Phones-for-iPhone-85f280409989c2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo in consequat. Duis aute irure dolor in reprehenderit.', NULL, '2020-08-03 12:33:13'),
	(3, 'Mobile Software Solution', 'Small-Business-Mobile-Apps-How-to-Build-Mobile-Apps-230525f28051628737.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo in consequat. Duis aute irure dolor in reprehenderit.', NULL, '2020-08-03 12:37:39');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table daruuri.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('mohammadarman.iiuc.cse@gmail.com', '$2y$10$yyqJVaAeOptasFNLNVS/deGJVYQjSLzg7awTeqbSxh4JJrnGc.S8q', '2020-08-10 15:14:51');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table daruuri.phones
CREATE TABLE IF NOT EXISTS `phones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `phone_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_phone_name_unique` (`phone_name`),
  KEY `phones_brand_id_foreign` (`brand_id`),
  CONSTRAINT `phones_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.phones: ~1 rows (approximately)
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
INSERT INTO `phones` (`id`, `brand_id`, `phone_name`, `status`, `created_at`, `updated_at`) VALUES
	(15, 6, 'Asus Zenfone 2', '1', '2020-08-02 18:36:21', '2020-08-02 18:36:21'),
	(16, 4, 'SamSung Galaxy S12', '1', '2020-08-02 18:37:20', '2020-08-02 18:37:20');
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;

-- Dumping structure for table daruuri.phone_service
CREATE TABLE IF NOT EXISTS `phone_service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone_service_phone_id_foreign` (`phone_id`),
  KEY `phone_service_service_id_foreign` (`service_id`),
  CONSTRAINT `phone_service_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  CONSTRAINT `phone_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.phone_service: ~16 rows (approximately)
/*!40000 ALTER TABLE `phone_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone_service` ENABLE KEYS */;

-- Dumping structure for table daruuri.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_name_unique` (`product_name`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.products: ~303 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table daruuri.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `daruuri_rating` int(11) NOT NULL DEFAULT '0',
  `communication_rating` int(11) NOT NULL DEFAULT '0',
  `stuff_rating` int(11) NOT NULL DEFAULT '0',
  `service_rating` int(11) NOT NULL DEFAULT '0',
  `referal_rating` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.reviews: ~2 rows (approximately)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `name`, `phone_no`, `email`, `description`, `daruuri_rating`, `communication_rating`, `stuff_rating`, `service_rating`, `referal_rating`, `created_at`, `updated_at`) VALUES
	(8, 'Mr. Zobbar', '01521225987', 'zobbar@gmail.com', 'The store communicated expectations about my device throughout the repair process.', 3, 4, 5, 2, 4, '2020-08-11 11:32:46', '2020-08-10 11:32:46'),
	(9, 'Mr. Abdul Al Noman', '01680950265', 'noman@gmail.com', 'The store communicated expectations about my device throughout the repair process.', 5, 5, 5, 5, 5, '2020-08-10 11:33:21', '2020-08-10 11:33:21');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Dumping structure for table daruuri.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_unique` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', NULL, NULL),
	(2, 'Admin', NULL, NULL),
	(6, 'Employee', '2020-08-09 09:46:39', '2020-08-09 10:39:17');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table daruuri.role_method_permissions
CREATE TABLE IF NOT EXISTS `role_method_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `method_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_method_permissions_role_id_foreign` (`role_id`),
  KEY `role_method_permissions_method_id_foreign` (`method_id`),
  CONSTRAINT `role_method_permissions_method_id_foreign` FOREIGN KEY (`method_id`) REFERENCES `methods` (`id`),
  CONSTRAINT `role_method_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.role_method_permissions: ~103 rows (approximately)
/*!40000 ALTER TABLE `role_method_permissions` DISABLE KEYS */;
INSERT INTO `role_method_permissions` (`id`, `role_id`, `method_id`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(2, 6, 37, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(3, 6, 38, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(4, 6, 39, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(5, 6, 43, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(6, 6, 44, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(7, 6, 45, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(8, 6, 49, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(9, 6, 50, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(10, 6, 51, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(11, 6, 52, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(12, 6, 56, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(13, 6, 57, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(14, 6, 58, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(15, 6, 59, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(16, 6, 60, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(17, 6, 61, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(18, 6, 62, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(19, 6, 63, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(20, 6, 64, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(21, 6, 65, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(22, 6, 66, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(23, 6, 67, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(24, 6, 68, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(25, 6, 81, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(26, 6, 82, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(27, 6, 83, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(28, 6, 84, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(29, 6, 85, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(30, 6, 86, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(31, 6, 2, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(53, 2, 1, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(54, 2, 37, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(55, 2, 38, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(56, 2, 39, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(57, 2, 40, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(58, 2, 41, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(59, 2, 42, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(60, 2, 43, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(61, 2, 44, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(62, 2, 45, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(63, 2, 46, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(64, 2, 47, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(65, 2, 48, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(66, 2, 49, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(67, 2, 50, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(68, 2, 51, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(69, 2, 52, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(70, 2, 53, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(71, 2, 54, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(72, 2, 55, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(73, 2, 56, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(74, 2, 57, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(75, 2, 58, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(76, 2, 59, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(77, 2, 60, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(78, 2, 61, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(79, 2, 62, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(80, 2, 63, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(81, 2, 64, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(82, 2, 65, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(83, 2, 66, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(84, 2, 67, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(85, 2, 68, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(86, 2, 69, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(87, 2, 70, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(88, 2, 71, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(89, 2, 72, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(90, 2, 73, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(91, 2, 74, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(92, 2, 75, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(93, 2, 76, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(94, 2, 77, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(95, 2, 78, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(96, 2, 79, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(97, 2, 80, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(98, 2, 81, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(99, 2, 82, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(100, 2, 83, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(101, 2, 84, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(102, 2, 85, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(103, 2, 86, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(104, 2, 87, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(105, 2, 88, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(106, 2, 89, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(107, 2, 90, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(108, 2, 91, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(109, 2, 28, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(110, 2, 29, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(111, 2, 30, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(112, 2, 31, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(113, 2, 32, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(114, 2, 33, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(115, 2, 34, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(116, 2, 35, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(117, 2, 2, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(118, 2, 7, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(119, 2, 8, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(120, 2, 9, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(121, 2, 10, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(122, 2, 11, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(123, 2, 12, '2020-08-09 10:47:00', '2020-08-09 10:47:00'),
	(124, 2, 13, '2020-08-09 10:47:00', '2020-08-09 10:47:00');
/*!40000 ALTER TABLE `role_method_permissions` ENABLE KEYS */;

-- Dumping structure for table daruuri.role_module_permissions
CREATE TABLE IF NOT EXISTS `role_module_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `module_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_permissions_role_id_foreign` (`role_id`),
  KEY `role_module_permissions_module_id_foreign` (`module_id`),
  CONSTRAINT `role_module_permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  CONSTRAINT `role_module_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.role_module_permissions: ~25 rows (approximately)
/*!40000 ALTER TABLE `role_module_permissions` DISABLE KEYS */;
INSERT INTO `role_module_permissions` (`id`, `role_id`, `module_id`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(2, 6, 9, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(3, 6, 10, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(4, 6, 11, '2020-08-09 09:46:39', '2020-08-09 09:46:39'),
	(5, 6, 12, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(6, 6, 13, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(7, 6, 14, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(8, 6, 17, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(9, 6, 4, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(10, 6, 5, '2020-08-09 10:38:17', '2020-08-09 10:38:17'),
	(14, 2, 1, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(15, 2, 9, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(16, 2, 10, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(17, 2, 11, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(18, 2, 12, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(19, 2, 13, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(20, 2, 14, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(21, 2, 15, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(22, 2, 16, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(23, 2, 17, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(24, 2, 18, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(25, 2, 2, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(26, 2, 4, '2020-08-09 10:46:58', '2020-08-09 10:46:58'),
	(27, 2, 5, '2020-08-09 10:46:59', '2020-08-09 10:46:59'),
	(28, 2, 6, '2020-08-09 10:46:59', '2020-08-09 10:46:59');
/*!40000 ALTER TABLE `role_module_permissions` ENABLE KEYS */;

-- Dumping structure for table daruuri.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'service.svg',
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_service_name_unique` (`service_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.services: ~8 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `service_name`, `service_icon`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Display', 'display5f268dbbcbef5.svg', '1', '2020-08-02 09:56:11', '2020-08-02 09:56:11'),
	(2, 'Battery', 'battery5f268dca466e8.svg', '1', '2020-08-02 09:56:25', '2020-08-02 09:56:25'),
	(3, 'Charge Port', 'usb5f26910f744ab.svg', '1', '2020-08-02 10:10:20', '2020-08-02 10:10:20'),
	(4, 'Front Camera', 'selfie(1)5f26912b8f0b5.svg', '1', '2020-08-02 10:10:51', '2020-08-02 10:10:51'),
	(5, 'Rear Camera', 'back-camera5f269140828d6.svg', '1', '2020-08-02 10:11:12', '2020-08-02 10:11:12'),
	(6, 'Microphone', 'radio5f26916224f02.svg', '1', '2020-08-02 10:11:45', '2020-08-02 10:11:45'),
	(7, 'Speaker', 'loud5f26917c062df.svg', '1', '2020-08-02 10:12:11', '2020-08-02 10:12:11'),
	(8, 'Program Installation', 'driver5f26919a8a87f.svg', '1', '2020-08-02 10:12:42', '2020-08-02 10:12:42');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table daruuri.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.sessions: ~3 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('rlxtMuH1sTpcoDpeP0yyjv3N7cRDoTovuY9agJ7W', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNlVvbDVzQ2ViM3p4NXRZM3lLajA4MmdwdVU0WVhjUzdkU01RMjBMSyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vZGFydXVyaS50ZXN0L2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwZXJtaXR0ZWRfbW9kdWxlcyI7TzoyNjoiVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24iOjY6e3M6MzM6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgB0b3RhbCI7aToxMTtzOjQwOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AcGFyZW50Q29sdW1uIjtzOjk6InBhcmVudF9pZCI7czo1ODoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHJlbW92ZUl0ZW1zV2l0aE1pc3NpbmdBbmNlc3RvciI7YjoxO3M6Mzk6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBpbmRlbnRDaGFycyI7czo4OiLCoMKgwqDCoCI7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAGNoaWxkcmVuTmFtZSI7czo1OiJpdGVtcyI7czo4OiIAKgBpdGVtcyI7YToxMTp7aTowO086MzE6Ik1vZHVsZXNcQmFja2VuZFxFbnRpdGllc1xNb2R1bGUiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YTo1OntpOjA7czoxMToibW9kdWxlX25hbWUiO2k6MTtzOjExOiJtb2R1bGVfbGluayI7aToyO3M6MTE6Im1vZHVsZV9pY29uIjtpOjM7czoxNToibW9kdWxlX3NlcXVlbmNlIjtpOjQ7czo5OiJwYXJlbnRfaWQiO31zOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjc6Im1vZHVsZXMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6ODp7czoyOiJpZCI7aToxO3M6MTE6Im1vZHVsZV9uYW1lIjtzOjk6IkRhc2hib2FyZCI7czoxMToibW9kdWxlX2xpbmsiO3M6MToiLyI7czoxMToibW9kdWxlX2ljb24iO3M6MTE6ImZhcyBmYS1ob21lIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6MTAwMDtzOjk6InBhcmVudF9pZCI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMToiACoAb3JpZ2luYWwiO2E6ODp7czoyOiJpZCI7aToxO3M6MTE6Im1vZHVsZV9uYW1lIjtzOjk6IkRhc2hib2FyZCI7czoxMToibW9kdWxlX2xpbmsiO3M6MToiLyI7czoxMToibW9kdWxlX2ljb24iO3M6MTE6ImZhcyBmYS1ob21lIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6MTAwMDtzOjk6InBhcmVudF9pZCI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YToxOntzOjg6ImNoaWxkcmVuIjtPOjI2OiJUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbiI6Njp7czozMzoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHRvdGFsIjtpOjA7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHBhcmVudENvbHVtbiI7czo5OiJwYXJlbnRfaWQiO3M6NTg6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgByZW1vdmVJdGVtc1dpdGhNaXNzaW5nQW5jZXN0b3IiO2I6MTtzOjM5OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AaW5kZW50Q2hhcnMiO3M6ODoiwqDCoMKgwqAiO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBjaGlsZHJlbk5hbWUiO3M6NToiaXRlbXMiO3M6ODoiACoAaXRlbXMiO2E6MDp7fX19czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319aToxO086MzE6Ik1vZHVsZXNcQmFja2VuZFxFbnRpdGllc1xNb2R1bGUiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YTo1OntpOjA7czoxMToibW9kdWxlX25hbWUiO2k6MTtzOjExOiJtb2R1bGVfbGluayI7aToyO3M6MTE6Im1vZHVsZV9pY29uIjtpOjM7czoxNToibW9kdWxlX3NlcXVlbmNlIjtpOjQ7czo5OiJwYXJlbnRfaWQiO31zOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjc6Im1vZHVsZXMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7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O3M6MTE6Im1vZHVsZV9pY29uIjtzOjEyOiJmYXMgZmEtdG9vbHMiO3M6MTU6Im1vZHVsZV9zZXF1ZW5jZSI7aTozMDAwO3M6OToicGFyZW50X2lkIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMToiACoAb3JpZ2luYWwiO2E6ODp7czoyOiJpZCI7aToxMDtzOjExOiJtb2R1bGVfbmFtZSI7czoxMzoiUGhvbmUgU2VydmljZSI7czoxMToibW9kdWxlX2xpbmsiO3M6MTM6InBob25lLXNlcnZpY2UiO3M6MTE6Im1vZHVsZV9pY29uIjtzOjEyOiJmYXMgZmEtdG9vbHMiO3M6MTU6Im1vZHVsZV9zZXF1ZW5jZSI7aTozMDAwO3M6OToicGFyZW50X2lkIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YToxOntzOjg6ImNoaWxkcmVuIjtPOjI2OiJUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbiI6Njp7czozMzoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHRvdGFsIjtpOjA7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHBhcmVudENvbHVtbiI7czo5OiJwYXJlbnRfaWQiO3M6NTg6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgByZW1vdmVJdGVtc1dpdGhNaXNzaW5nQW5jZXN0b3IiO2I6MTtzOjM5OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AaW5kZW50Q2hhcnMiO3M6ODoiwqDCoMKgwqAiO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBjaGlsZHJlbk5hbWUiO3M6NToiaXRlbXMiO3M6ODoiACoAaXRlbXMiO2E6MDp7fX19czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319aTozO086MzE6Ik1vZHVsZXNcQmFja2VuZFxFbnRpdGllc1xNb2R1bGUiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YTo1OntpOjA7czoxMToibW9kdWxlX25hbWUiO2k6MTtzOjExOiJtb2R1bGVfbGluayI7aToyO3M6MTE6Im1vZHVsZV9pY29uIjtpOjM7czoxNToibW9kdWxlX3NlcXVlbmNlIjtpOjQ7czo5OiJwYXJlbnRfaWQiO31zOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjc6Im1vZHVsZXMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6ODp7czoyOiJpZCI7aToxMTtzOjExOiJtb2R1bGVfbmFtZSI7czo1OiJQaG9uZSI7czoxMToibW9kdWxlX2xpbmsiO3M6NToicGhvbmUiO3M6MTE6Im1vZHVsZV9pY29uIjtzOjEzOiJmYXMgZmEtbW9iaWxlIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6NDAwMDtzOjk6InBhcmVudF9pZCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MjoiaWQiO2k6MTE7czoxMToibW9kdWxlX25hbWUiO3M6NToiUGhvbmUiO3M6MTE6Im1vZHVsZV9saW5rIjtzOjU6InBob25lIjtzOjExOiJtb2R1bGVfaWNvbiI7czoxMzoiZmFzIGZhLW1vYmlsZSI7czoxNToibW9kdWxlX3NlcXVlbmNlIjtpOjQwMDA7czo5OiJwYXJlbnRfaWQiO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtOO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjA6e31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czo4OiIAKgBkYXRlcyI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjE6e3M6ODoiY2hpbGRyZW4iO086MjY6IlR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uIjo2OntzOjMzOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AdG90YWwiO2k6MDtzOjQwOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AcGFyZW50Q29sdW1uIjtzOjk6InBhcmVudF9pZCI7czo1ODoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHJlbW92ZUl0ZW1zV2l0aE1pc3NpbmdBbmNlc3RvciI7YjoxO3M6Mzk6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBpbmRlbnRDaGFycyI7czo4OiLCoMKgwqDCoCI7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAGNoaWxkcmVuTmFtZSI7czo1OiJpdGVtcyI7czo4OiIAKgBpdGVtcyI7YTowOnt9fX1zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fX1pOjQ7TzozMToiTW9kdWxlc1xCYWNrZW5kXEVudGl0aWVzXE1vZHVsZSI6Mjc6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjU6e2k6MDtzOjExOiJtb2R1bGVfbmFtZSI7aToxO3M6MTE6Im1vZHVsZV9saW5rIjtpOjI7czoxMToibW9kdWxlX2ljb24iO2k6MztzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6NDtzOjk6InBhcmVudF9pZCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NzoibW9kdWxlcyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YTo4OntzOjI6ImlkIjtpOjEyO3M6MTE6Im1vZHVsZV9uYW1lIjtzOjE0OiJNYW5hZ2UgUHJvZHVjdCI7czoxMToibW9kdWxlX2xpbmsiO3M6MTk6ImphdmFzY3JpcHQ6dm9pZCgwKTsiO3M6MTE6Im1vZHVsZV9pY29uIjtzOjEwOiJmYXMgZmEtYm94IjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6NTAwMDtzOjk6InBhcmVudF9pZCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MjoiaWQiO2k6MTI7czoxMToibW9kdWxlX25hbWUiO3M6MTQ6Ik1hbmFnZSBQcm9kdWN0IjtzOjExOiJtb2R1bGVfbGluayI7czoxOToiamF2YXNjcmlwdDp2b2lkKDApOyI7czoxMToibW9kdWxlX2ljb24iO3M6MTA6ImZhcyBmYS1ib3giO3M6MTU6Im1vZHVsZV9zZXF1ZW5jZSI7aTo1MDAwO3M6OToicGFyZW50X2lkIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YToxOntzOjg6ImNoaWxkcmVuIjtPOjI2OiJUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbiI6Njp7czozMzoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHRvdGFsIjtpOjI7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHBhcmVudENvbHVtbiI7czo5OiJwYXJlbnRfaWQiO3M6NTg6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgByZW1vdmVJdGVtc1dpdGhNaXNzaW5nQW5jZXN0b3IiO2I6MTtzOjM5OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AaW5kZW50Q2hhcnMiO3M6ODoiwqDCoMKgwqAiO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBjaGlsZHJlbk5hbWUiO3M6NToiaXRlbXMiO3M6ODoiACoAaXRlbXMiO2E6Mjp7aTowO086MzE6Ik1vZHVsZXNcQmFja2VuZFxFbnRpdGllc1xNb2R1bGUiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YTo1OntpOjA7czoxMToibW9kdWxlX25hbWUiO2k6MTtzOjExOiJtb2R1bGVfbGluayI7aToyO3M6MTE6Im1vZHVsZV9pY29uIjtpOjM7czoxNToibW9kdWxlX3NlcXVlbmNlIjtpOjQ7czo5OiJwYXJlbnRfaWQiO31zOjEz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TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjE6e3M6ODoiY2hpbGRyZW4iO086MjY6IlR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uIjo2OntzOjMzOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AdG90YWwiO2k6MDtzOjQwOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AcGFyZW50Q29sdW1uIjtzOjk6InBhcmVudF9pZCI7czo1ODoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHJlbW92ZUl0ZW1zV2l0aE1pc3NpbmdBbmNlc3RvciI7YjoxO3M6Mzk6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBpbmRlbnRDaGFycyI7czo4OiLCoMKgwqDCoCI7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAGNoaWxkcmVuTmFtZSI7czo1OiJpdGVtcyI7czo4OiIAKgBpdGVtcyI7YTowOnt9fX1zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fX1pOjY7TzozMToiTW9kdWxlc1xCYWNrZW5kXEVudGl0aWVzXE1vZHVsZSI6Mjc6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjU6e2k6MDtzOjExOiJtb2R1bGVfbmFtZSI7aToxO3M6MTE6Im1vZHVsZV9saW5rIjtpOjI7czoxMToibW9kdWxlX2ljb24iO2k6MztzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6NDtzOjk6InBhcmVudF9pZCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NzoibW9kdWxlcyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czox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Im1vZHVsZV9pY29uIjtzOjE5OiJmYXMgZmEtY29tbWVudC1kb3RzIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6OTAwMDtzOjk6InBhcmVudF9pZCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MjoiaWQiO2k6MTg7czoxMToibW9kdWxlX25hbWUiO3M6MTc6IkN1c3RvbWVyIEZlZWRiYWNrIjtzOjExOiJtb2R1bGVfbGluayI7czoxNzoiY3VzdG9tZXItZmVlZGJhY2siO3M6MTE6Im1vZHVsZV9pY29uIjtzOjE5OiJmYXMgZmEtY29tbWVudC1kb3RzIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6OTAwMDtzOjk6InBhcmVudF9pZCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjg6IgAqAGRhdGVzIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MTp7czo4OiJjaGlsZHJlbiI7TzoyNjoiVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24iOjY6e3M6MzM6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgB0b3RhbCI7aTowO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBwYXJlbnRDb2x1bW4iO3M6OToicGFyZW50X2lkIjtzOjU4OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AcmVtb3ZlSXRlbXNXaXRoTWlzc2luZ0FuY2VzdG9yIjtiOjE7czozOToiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAGluZGVudENoYXJzIjtzOjg6IsKgwqDCoMKgIjtzOjQwOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AY2hpbGRyZW5OYW1lIjtzOjU6Iml0ZW1zIjtzOjg6IgAqAGl0ZW1zIjthOjA6e319fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fWk6OTtPOjMxOiJNb2R1bGVzXEJhY2tlbmRcRW50aXRpZXNcTW9kdWxlIjoyNzp7czoxMToiACoAZmlsbGFibGUiO2E6NTp7aTowO3M6MTE6Im1vZHVsZV9uYW1lIjtpOjE7czoxMToibW9kdWxlX2xpbmsiO2k6MjtzOjExOiJtb2R1bGVfaWNvbiI7aTozO3M6MTU6Im1vZHVsZV9zZXF1ZW5jZSI7aTo0O3M6OToicGFyZW50X2lkIjt9czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo3OiJtb2R1bGVzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjg6e3M6MjoiaWQiO2k6MjtzOjExOiJtb2R1bGVfbmFtZSI7czo0OiJVc2VyIjtzOjExOiJtb2R1bGVfbGluayI7czo0OiJ1c2VyIjtzOjExOiJtb2R1bGVfaWNvbiI7czoxMjoiZmFzIGZhLXVzZXJzIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6MTgwMDA7czo5OiJwYXJlbnRfaWQiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MjoiaWQiO2k6MjtzOjExOiJtb2R1bGVfbmFtZSI7czo0OiJVc2VyIjtzOjExOiJtb2R1bGVfbGluayI7czo0OiJ1c2VyIjtzOjExOiJtb2R1bGVfaWNvbiI7czoxMjoiZmFzIGZhLXVzZXJzIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6MTgwMDA7czo5OiJwYXJlbnRfaWQiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjg6IgAqAGRhdGVzIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MTp7czo4OiJjaGlsZHJlbiI7TzoyNjoiVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24iOjY6e3M6MzM6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgB0b3RhbCI7aTowO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBwYXJlbnRDb2x1bW4iO3M6OToicGFyZW50X2lkIjtzOjU4OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AcmVtb3ZlSXRlbXNXaXRoTWlzc2luZ0FuY2VzdG9yIjtiOjE7czozOToiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAGluZGVudENoYXJzIjtzOjg6IsKgwqDCoMKgIjtzOjQwOiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AY2hpbGRyZW5OYW1lIjtzOjU6Iml0ZW1zIjtzOjg6IgAqAGl0ZW1zIjthOjA6e319fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fWk6MTA7TzozMToiTW9kdWxlc1xCYWNrZW5kXEVudGl0aWVzXE1vZHVsZSI6Mjc6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjU6e2k6MDtzOjExOiJtb2R1bGVfbmFtZSI7aToxO3M6MTE6Im1vZHVsZV9saW5rIjtpOjI7czoxMToibW9kdWxlX2ljb24iO2k6MztzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6NDtzOjk6InBhcmVudF9pZCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NzoibW9kdWxlcyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YTo4OntzOjI6ImlkIjtpOjQ7czoxMToibW9kdWxlX25hbWUiO3M6MTc6IlNvZnR3YXJlIFNldHRpbmdzIjtzOjExOiJtb2R1bGVfbGluayI7czoxOToiamF2YXNjcmlwdDp2b2lkKDApOyI7czoxMToibW9kdWxlX2ljb24iO3M6MTE6ImZhcyBmYS1jb2dzIjtzOjE1OiJtb2R1bGVfc2VxdWVuY2UiO2k6MjAwMDA7czo5OiJwYXJlbnRfaWQiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MjoiaWQiO2k6NDtzOjExOiJtb2R1bGVfbmFtZSI7czoxNzoiU29mdHdhcmUgU2V0dGluZ3MiO3M6MTE6Im1vZHVsZV9saW5rIjtzOjE5OiJqYXZhc2NyaXB0OnZvaWQoMCk7IjtzOjExOiJtb2R1bGVfaWNvbiI7czoxMToiZmFzIGZhLWNvZ3MiO3M6MTU6Im1vZHVsZV9zZXF1ZW5jZSI7aToyMDAwMDtzOjk6InBhcmVudF9pZCI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7Tjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YToxOntzOjg6ImNoaWxkcmVuIjtPOjI2OiJUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbiI6Njp7czozMzoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHRvdGFsIjtpOjQ7czo0MDoiAFR5cGlDTVNcTmVzdGFibGVDb2xsZWN0aW9uAHBhcmVudENvbHVtbiI7czo5OiJwYXJlbnRfaWQiO3M6NTg6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgByZW1vdmVJdGVtc1dpdGhNaXNzaW5nQW5jZXN0b3IiO2I6MTtzOjM5OiIAVHlwaUNNU1xOZXN0YWJsZUNvbGxlY3Rpb24AaW5kZW50Q2hhcnMiO3M6ODoiwqDCoMKgwqAiO3M6NDA6IgBUeXBpQ01TXE5lc3RhYmxlQ29sbGVjdGlvbgBjaGlsZHJlbk5hbWUiO3M6NToiaXRlbXMiO3M6ODoiACoAaXRlbXMiO2E6NDp7aTowO086MzE6Ik1vZHVsZXNcQmFja2VuZFxFbnRpdGllc1xNb2R1bGUiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YTo1OntpOjA7czoxMToibW9kdWxlX25hbWUiO2k6MTtzOjExOiJtb2R1bGVfbGluayI7aToyO3M6MTE6Im1vZHVsZV9pY29uIjtpOjM7czoxNToibW9kdWxlX3NlcXVlbmNl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OjExO3M6MTU6ImNhdGVnb3J5LXJlcG9ydCI7aToxMjtzOjI0OiJjdXN0b21lci1mZWVkYmFjay1hY2Nlc3MiO2k6MTM7czozNjoiY3VzdG9tZXItZmVlZGJhY2stYnVsay1hY3Rpb24tZGVsZXRlIjtpOjE0O3M6MjQ6ImN1c3RvbWVyLWZlZWRiYWNrLWRlbGV0ZSI7aToxNTtzOjI0OiJjdXN0b21lci1mZWVkYmFjay1yZXBvcnQiO2k6MTY7czoyMjoiY3VzdG9tZXItZmVlZGJhY2stdmlldyI7aToxNztzOjE2OiJkYXNoYm9hcmQtbWFuYWdlIjtpOjE4O3M6MTE6ImZhcXMtYWNjZXNzIjtpOjE5O3M6ODoiZmFxcy1hZGQiO2k6MjA7czoyMzoiZmFxcy1idWxrLWFjdGlvbi1kZWxldGUiO2k6MjE7czoxMToiZmFxcy1kZWxldGUiO2k6MjI7czo5OiJmYXFzLWVkaXQiO2k6MjM7czoxMToiZmFxcy1yZXBvcnQiO2k6MjQ7czoyNjoiaGlnaGxpZ2h0ZWQtc2VydmljZS1hY2Nlc3MiO2k6MjU7czoyMzoiaGlnaGxpZ2h0ZWQtc2VydmljZS1hZGQiO2k6MjY7czozODoiaGlnaGxpZ2h0ZWQtc2VydmljZS1idWxrLWFjdGlvbi1kZWxldGUiO2k6Mjc7czoyNjoiaGlnaGxpZ2h0ZWQtc2VydmljZS1kZWxldGUiO2k6Mjg7czoyNDoiaGlnaGxpZ2h0ZWQtc2VydmljZS1lZGl0IjtpOjI5O3M6MjY6ImhpZ2hsaWdodGVkLXNlcnZpY2UtcmVwb3J0IjtpOjMwO3M6MTA6Im1ldGhvZC1hZGQiO2k6MzE7czoyNToibWV0aG9kLWJ1bGstYWN0aW9uLWRlbGV0ZSI7aTozMjtzOjEzOiJtZXRob2QtZGVsZXRlIjtpOjMzO3M6MTE6Im1ldGhvZC1lZGl0IjtpOjM0O3M6MTM6Im1ldGhvZC1tYW5hZ2UiO2k6MzU7czoxMzoibWV0aG9kLXJlcG9ydCI7aTozNjtzOjExOiJtZXRob2QtdmlldyI7aTozNztzOjEwOiJtb2R1bGUtYWRkIjtpOjM4O3M6MjU6Im1vZHVsZS1idWxrLWFjdGlvbi1kZWxldGUiO2k6Mzk7czoxMzoibW9kdWxlLWRlbGV0ZSI7aTo0MDtzOjExOiJtb2R1bGUtZWRpdCI7aTo0MTtzOjEzOiJtb2R1bGUtbWFuYWdlIjtpOjQyO3M6MTM6Im1vZHVsZS1yZXBvcnQiO2k6NDM7czoxMToibW9kdWxlLXZpZXciO2k6NDQ7czoxMjoicGhvbmUtYWNjZXNzIjtpOjQ1O3M6OToicGhvbmUtYWRkIjtpOjQ2O3M6MjQ6InBob25lLWJ1bGstYWN0aW9uLWRlbGV0ZSI7aTo0NztzOjEyOiJwaG9uZS1kZWxldGUiO2k6NDg7czoxMDoicGhvbmUtZWRpdCI7aTo0OTtzOjEyOiJwaG9uZS1yZXBvcnQiO2k6NTA7czoyMDoicGhvbmUtc2VydmljZS1hY2Nlc3MiO2k6NTE7czoxNzoicGhvbmUtc2VydmljZS1hZGQiO2k6NTI7czozMjoicGhvbmUtc2VydmljZS1idWxrLWFjdGlvbi1kZWxldGUiO2k6NTM7czoyMDoicGhvbmUtc2VydmljZS1kZWxldGUiO2k6NTQ7czoxODoicGhvbmUtc2VydmljZS1lZGl0IjtpOjU1O3M6MjA6InBob25lLXNlcnZpY2UtcmVwb3J0IjtpOjU2O3M6MTA6InBob25lLXZpZXciO2k6NTc7czoxNDoicHJvZHVjdC1hY2Nlc3MiO2k6NTg7czoxMToicHJvZHVjdC1hZGQiO2k6NTk7czoyNjoicHJvZHVjdC1idWxrLWFjdGlvbi1kZWxldGUiO2k6NjA7czoxNDoicHJvZHVjdC1kZWxldGUiO2k6NjE7czoxMjoicHJvZHVjdC1lZGl0IjtpOjYyO3M6MTQ6InByb2R1Y3QtcmVwb3J0IjtpOjYzO3M6MTI6InByb2R1Y3QtdmlldyI7aTo2NDtzOjg6InJvbGUtYWRkIjtpOjY1O3M6MjM6InJvbGUtYnVsay1hY3Rpb24tZGVsZXRlIjtpOjY2O3M6MTE6InJvbGUtZGVsZXRlIjtpOjY3O3M6OToicm9sZS1lZGl0IjtpOjY4O3M6MTE6InJvbGUtbWFuYWdlIjtpOjY5O3M6MTE6InJvbGUtcmVwb3J0IjtpOjcwO3M6OToicm9sZS12aWV3IjtpOjcxO3M6MTU6InNldHRpbmctZ2VuZXJhbCI7aTo3MjtzOjEzOiJzbGlkZXItYWNjZXNzIjtpOjczO3M6MTA6InNsaWRlci1hZGQiO2k6NzQ7czoyNToic2xpZGVyLWJ1bGstYWN0aW9uLWRlbGV0ZSI7aTo3NTtzOjEzOiJzbGlkZXItZGVsZXRlIjtpOjc2O3M6MTE6InNsaWRlci1lZGl0IjtpOjc3O3M6MTM6InNsaWRlci1yZXBvcnQiO2k6Nzg7czo4OiJ1c2VyLWFkZCI7aTo3OTtzOjIzOiJ1c2VyLWJ1bGstYWN0aW9uLWRlbGV0ZSI7aTo4MDtzOjExOiJ1c2VyLWRlbGV0ZSI7aTo4MTtzOjk6InVzZXItZWRpdCI7aTo4MjtzOjExOiJ1c2VyLW1hbmFnZSI7aTo4MztzOjIwOiJ1c2VyLXBhc3N3b3JkLWNoYW5nZSI7aTo4NDtzOjExOiJ1c2VyLXJlcG9ydCI7aTo4NTtzOjk6InVzZXItdmlldyI7fX0=', 1597074844),
	('uyG77bFMSg0xpruR3kTvI5865po2YHIWSsIp0JTc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVBPQlNLM2lpczJFa2JucjhPeXpQMUhiUXc5UzlXakk0VnFHeTZUYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9kYXJ1dXJpLnRlc3QvcGFzc3dvcmQvcmVzZXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI1OiJodHRwOi8vZGFydXVyaS50ZXN0L2FkbWluIjt9fQ==', 1597072491);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table daruuri.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.settings: ~17 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'site_title', 'Daruuri', NULL, NULL),
	(2, 'email_address', 'kylife.bd@gmail.com', NULL, NULL),
	(3, 'contact_number', '+8801521225987', NULL, '2020-08-02 20:18:20'),
	(4, 'contact_address', 'Lorem ipsum dollar serum torum nnautia klfkld lkskdf', NULL, '2020-08-02 20:18:20'),
	(5, 'google_map_iframe', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.6489723996438!2d91.79919361471535!3d22.32911168530864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd8d230aa220d%3A0x3148f72010b590cb!2sAgrabad%20Access%20Rd%2C%20Chittagong!5e0!3m2!1sen!2sbd!4v1596399459586!5m2!1sen!2sbd" allowfullscreen="" width="2600" height="600" frameborder="0" style="border:0;" aria-hidden="false" tabindex="0"></iframe>', NULL, NULL),
	(6, 'site_logo', 'logo.png', NULL, '2020-08-02 20:13:12'),
	(7, 'site_favicon', 'daruuri-favicon5f271e5828a49.ico', NULL, '2020-08-02 20:13:12'),
	(8, 'footer_copyright_text', '', NULL, NULL),
	(9, 'footer_description', 'Lorem ipsum dollar serum torum nnautia', NULL, NULL),
	(10, 'seo_meta_title', 'Daruuri - Mobile Repair Shop', NULL, '2020-08-02 20:23:26'),
	(11, 'seo_meta_description', 'lorem ipsum dollar lkdfkg dfngldk', NULL, '2020-08-02 20:23:26'),
	(12, 'currency_symbol', '$', NULL, NULL),
	(13, 'social_facebook', 'https://www.facebook.com/', NULL, NULL),
	(14, 'social_twitter', NULL, NULL, NULL),
	(15, 'social_instagram', NULL, NULL, NULL),
	(16, 'social_linkedin', NULL, NULL, NULL),
	(17, 'social_whatsapp', NULL, NULL, NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table daruuri.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.sliders: ~4 rows (approximately)
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `title`, `sub_title`, `image`, `button_link`, `sorting`, `created_at`, `updated_at`) VALUES
	(1, 'Repair Shop', 'Trusted Repair Shop', 'joel-rohland-C1r9pODhfQ4-unsplash5f28721cb02ef.jpg', NULL, 1, '2020-08-03 20:21:50', '2020-08-03 20:22:52'),
	(2, 'Repair Shop', 'Trusted Repair Shop', 'k-i-l-i-a-n-PZLgTUAhxMM-unsplash5f28724237cb9.jpg', 'service', 2, '2020-08-03 20:23:29', '2020-08-03 20:23:29'),
	(3, 'Repair Shop', 'Trusted Repair Shop', 'pr-media-iuU2aZdzp_M-unsplash5f28728670210.jpg', 'product/mobile-phones', 3, '2020-08-03 20:24:38', '2020-08-03 20:24:38');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table daruuri.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table daruuri.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Mohammad Arman', 'mohammadarman.iiuc.cse@gmail.com', '$2y$10$ZZf12JOWOhtmIemffatXJuSzi9YVsWVUhqNQm/UL2aIs8yI98GAf6', NULL, '1', 'paN78VCdjdtjLGAVscSKVaaoz4ONdQPfXaa3HAlVODib3tfgPTZ7rvp1rvPL', '2020-07-31 08:35:21', '2020-07-31 08:35:21'),
	(2, 2, 'Foreman', 'foreman@gmail.com', '$2y$10$ZZf12JOWOhtmIemffatXJuSzi9YVsWVUhqNQm/UL2aIs8yI98GAf6', NULL, '1', NULL, NULL, NULL),
	(3, 2, 'Mr. Rahman', 'rahman.ali@gmail.com', '$2y$10$57FxHSeRCuPRKnO73xGB5utAjE663HeLwIw4wgMptrbTX.TcNtOAW', 'vuejs-logo-17D586B587-seeklogo.com5f2f44621768e.png', '2', NULL, '2020-08-08 19:36:57', '2020-08-09 00:33:38'),
	(6, 2, 'Mr. Abdul Al Noman', 'noman@gmail.com', '$2y$10$cle07R9l0DQVG8/tEg2wlepXuqCWZlWQJTZe3kgpH3rdIZEFjWPO2', NULL, '1', NULL, '2020-08-08 20:17:31', '2020-08-09 11:53:47'),
	(7, 6, 'Mr. Zobbar', 'zobbar@gmail.com', '$2y$10$lDTWrMxkFYoL9Cv2NCjwL.gFMKyEA5HgP2Qetn2nzNvmLMyxUqlwG', NULL, '1', NULL, '2020-08-08 20:19:36', '2020-08-09 11:51:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
