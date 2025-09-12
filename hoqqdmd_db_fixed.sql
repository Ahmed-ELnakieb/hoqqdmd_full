-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2025 at 10:59 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoqqdmd_db`
--

-- Stored procedures and functions removed to avoid privilege issues on shared hosting

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE IF NOT EXISTS `admin_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_id` int DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_favorite` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

DROP TABLE IF EXISTS `featured_products`;
CREATE TABLE IF NOT EXISTS `featured_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `discount_percentage` int DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_special_offer` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`id`, `name`, `description`, `original_price`, `discount_price`, `discount_percentage`, `image_url`, `link_url`, `is_special_offer`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 'HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/categories/hok_hero.jpg', 'shop.php?product=ultimate', 1, 1, 1, '2025-09-12 16:44:44'),
(2, 'MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/categories/mlbb_hero.jpg', 'shop.php?product=mlbb-pro', 1, 1, 2, '2025-09-12 16:44:44'),
(3, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/categories/wildrift_hero.jpg', 'shop.php?product=wildrift-champion', 1, 1, 3, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `game_categories`
--

DROP TABLE IF EXISTS `game_categories`;
CREATE TABLE IF NOT EXISTS `game_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_categories`
--

INSERT INTO `game_categories` (`id`, `name`, `display_name`, `description`, `image_url`, `link_url`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 'hok', 'Honor of Kings', 'Premium HOK hacking tools and features', 'img/categories/hok_hero.jpg', 'shop.php?category=hok', 1, 1, '2025-09-12 16:44:44'),
(2, 'mlbb', 'Mobile Legends', 'Advanced MLBB hacking solutions', 'img/categories/mlbb_hero.jpg', 'shop.php?category=mlbb', 1, 2, '2025-09-12 16:44:44'),
(3, 'wildrift', 'Wild Rift', 'Professional Wild Rift hacking tools', 'img/categories/wildrift_hero.jpg', 'shop.php?category=wildrift', 1, 3, '2025-09-12 16:44:44'),
(4, 'pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 1, 4, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `home_content`
--

DROP TABLE IF EXISTS `home_content`;
CREATE TABLE IF NOT EXISTS `home_content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_content`
--

INSERT INTO `home_content` (`id`, `section`, `title`, `content`, `image_url`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'hero', 'Welcome to HOQQDMD', 'Premium gaming tools and hacks for Honor of Kings, Mobile Legends, Wild Rift, and more. Elevate your gameplay with our advanced solutions.', 'img/hero-bg.jpg', 1, 1, '2025-09-12 16:44:44'),
(2, 'features', 'Why Choose Us', 'With over 5 years in the gaming industry, we provide the most reliable and secure hacking tools. Our solutions are undetectable and regularly updated.', 'img/features-bg.jpg', 1, 1, '2025-09-12 16:44:44'),
(3, 'testimonials', 'What Our Users Say', 'Join thousands of satisfied gamers who have enhanced their gameplay with our tools. Experience the difference today!', 'img/testimonials-bg.jpg', 1, 1, '2025-09-12 16:44:44'),
(4, 'cta', 'Get Started Today', 'Ready to elevate your gaming experience? Browse our products and find the perfect solution for your needs.', 'img/cta-bg.jpg', 1, 1, '2025-09-12 16:44:44'),
(5, 'faq', 'Frequently Asked Questions', 'Find answers to common questions about our products, services, and security measures.', 'img/faq-bg.jpg', 1, 1, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `license_keys`
--

DROP TABLE IF EXISTS `license_keys`;
CREATE TABLE IF NOT EXISTS `license_keys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_value` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `activated_at` timestamp NULL,
  `expires_at` timestamp NULL,
  `status` enum('available','active','expired','suspended','revoked') COLLATE utf8mb4_unicode_ci DEFAULT 'available',
  `hwid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used` timestamp NULL,
  `usage_count` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_value` (`key_value`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_keys`
--

INSERT INTO `license_keys` (`id`, `key_value`, `product_id`, `user_id`, `created_at`, `activated_at`, `expires_at`, `status`, `hwid`, `last_used`, `usage_count`) VALUES
(1, 'HOQQ1-A1B2C-3D4E5-F6G7H', 1, 2, '2025-09-12 16:44:44', '2025-09-12 16:51:26', '2025-10-12 16:51:26', 'active', NULL, NULL, 0),
(2, 'HOQQ1-I8J9K-0L1M2-N3O4P', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(3, 'HOQQ1-Q5R6S-7T8U9-V0W1X', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(4, 'HOQQ1-Y2Z3A-4B5C6-D7E8F', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(5, 'HOQQ1-G9H0I-1J2K3-L4M5N', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(6, 'HOQQ1-O6P7Q-8R9S0-T1U2V', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(7, 'HOQQ1-W3X4Y-5Z6A7-B8C9D', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(8, 'HOQQ1-E0F1G-2H3I4-J5K6L', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(9, 'HOQQ1-M7N8O-9P0Q1-R2S3T', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(10, 'HOQQ1-U4V5W-6X7Y8-Z9A0B', 1, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(11, 'HOQQ2-C1D2E-3F4G5-H6I7J', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(12, 'HOQQ2-K8L9M-0N1O2-P3Q4R', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(13, 'HOQQ2-S5T6U-7V8W9-X0Y1Z', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(14, 'HOQQ2-A2B3C-4D5E6-F7G8H', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(15, 'HOQQ2-I9J0K-1L2M3-N4O5P', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(16, 'HOQQ2-Q6R7S-8T9U0-V1W2X', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(17, 'HOQQ2-Y3Z4A-5B6C7-D8E9F', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(18, 'HOQQ2-G0H1I-2J3K4-L5M6N', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(19, 'HOQQ2-O7P8Q-9R0S1-T2U3V', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0),
(20, 'HOQQ2-W4X5Y-6Z7A8-B9C0D', 2, NULL, '2025-09-12 16:44:44', NULL, NULL, 'available', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
CREATE TABLE IF NOT EXISTS `pricing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `period` enum('day','week','month','year') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_percentage` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `is_active` (`is_active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `product_id`, `period`, `price`, `discount_percentage`, `is_active`, `created_at`) VALUES
(1, 1, 'day', 9.99, 0, 1, '2025-09-12 16:44:44'),
(2, 1, 'week', 49.99, 0, 1, '2025-09-12 16:44:44'),
(3, 1, 'month', 149.99, 0, 1, '2025-09-12 16:44:44'),
(4, 1, 'year', 999.99, 0, 1, '2025-09-12 16:44:44'),
(5, 2, 'day', 14.99, 0, 1, '2025-09-12 16:44:44'),
(6, 2, 'week', 69.99, 0, 1, '2025-09-12 16:44:44'),
(7, 2, 'month', 199.99, 0, 1, '2025-09-12 16:44:44'),
(8, 2, 'year', 1299.99, 0, 1, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('mapahack_drone','drone_smart_skin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `description`, `features`, `status`, `created_at`) VALUES
(1, 'MapaHack + Drone View Premium', 'mapahack_drone', 'Complete ESP functions with jungle timer and enemy information. See everything on the map including enemy positions, jungle timers, and hidden information.', 'Jungle monster spawn timers|Enemy skill visibility|Dragon/Turtle HP tracking|Complete map awareness|Advanced ESP functions|Enemy ultimate cooldowns|Tower range indicators|Bush vision|Item tracker', 'active', '2025-09-12 16:44:44'),
(2, 'Drone View + Smart Skill + Skin Unlocker', 'drone_smart_skin', 'Enhanced gameplay with skin unlocker and smart skill assistance. Get all skins and smart targeting assistance.', 'Drone view camera|Smart skill targeting|All skins unlocked|Enhanced graphics|Auto-aim assistance|Skill prediction|Smart combo execution|Anti-miss technology|VIP effects', 'active', '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `discount_percentage` int DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `name`, `description`, `price`, `discount_price`, `discount_percentage`, `image_url`, `category`, `features`, `is_featured`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 'HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/products/hok-ultimate.jpg', 'hok', 'ESP functions|Jungle timers|Enemy positions|Skill cooldowns|Map awareness', 1, 1, 1, '2025-09-12 16:44:44'),
(2, 'MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/products/mlbb-pro.jpg', 'mlbb', 'Auto-aim|ESP|Skill prediction|Combo assist|Anti-ban', 1, 1, 2, '2025-09-12 16:44:44'),
(3, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/products/wildrift-champion.jpg', 'wildrift', 'Champion mastery|Map hacks|Skill prediction|Auto-play|Anti-detection', 1, 1, 3, '2025-09-12 16:44:44'),
(4, 'PUBG Mobile Elite', 'Ultimate PUBG Mobile hacking experience with all features', 119.99, 77.99, 35, 'img/products/pubg-elite.jpg', 'pubg', 'Aimbot|ESP|No recoil|Instant kill|Anti-ban', 1, 1, 4, '2025-09-12 16:44:44'),
(5, 'HOK Basic Hack', 'Essential HOK hacking tools for beginners', 49.99, 32.49, 35, 'img/products/hok-basic.jpg', 'hok', 'Basic ESP|Minimap hack|Simple aim assist', 0, 1, 5, '2025-09-12 16:44:44'),
(6, 'MLBB Basic Tools', 'Entry-level MLBB hacking tools', 39.99, 25.99, 35, 'img/products/mlbb-basic.jpg', 'mlbb', 'Basic ESP|Simple aim|No root required', 0, 1, 6, '2025-09-12 16:44:44'),
(7, 'Wild Rift Starter', 'Beginner-friendly Wild Rift hacking tools', 59.99, 38.99, 35, 'img/products/wildrift-starter.jpg', 'wildrift', 'Basic map awareness|Simple ESP|Auto-level', 0, 1, 7, '2025-09-12 16:44:44'),
(8, 'PUBG Mobile Basic', 'Basic PUBG Mobile hacking tools for casual players', 69.99, 45.49, 35, 'img/products/pubg-basic.jpg', 'pubg', 'Basic aim|Simple ESP|No recoil', 0, 1, 8, '2025-09-12 16:44:44'),
(9, 'HOK Pro Pack', 'Professional-grade HOK hacking tools for serious players', 149.99, 97.49, 35, 'img/products/hok-pro.jpg', 'hok', 'Advanced ESP|Jungle timers|Enemy positions|Skill cooldowns|Map awareness|Anti-detection', 0, 1, 9, '2025-09-12 16:44:44'),
(10, 'MLBB Elite Package', 'Premium MLBB hacking tools for competitive play', 129.99, 84.49, 35, 'img/products/mlbb-elite.jpg', 'mlbb', 'Advanced aimbot|Full ESP|Skill prediction|Combo assist|Anti-ban|No root', 0, 1, 10, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `pricing_id` int NOT NULL,
  `key_id` int DEFAULT NULL,
  `license_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','expired','suspended','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `auto_renew` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `product_id` (`product_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `product_id`, `pricing_id`, `key_id`, `license_key`, `start_date`, `end_date`, `created_at`, `status`, `payment_method`, `payment_status`, `auto_renew`) VALUES
(1, 2, 1, 3, 1, 'HOQQ1-A1B2C-3D4E5-F6G7H', '2025-09-12 16:51:26', '2025-10-12 16:51:26', '2025-09-12 16:51:26', 'active', 'PayPal', 'completed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subscription_id` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT 'USD',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','completed','failed','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` timestamp NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `subscription_id`, `amount`, `currency`, `payment_method`, `payment_gateway`, `transaction_id`, `status`, `created_at`, `completed_at`, `notes`) VALUES
(1, 2, 1, 149.99, 'USD', 'PayPal', 'PayPal', 'TXN-DEMO-001', 'completed', '2025-09-12 16:51:26', '2025-09-12 16:51:26', 'Demo transaction for testing');

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

DROP TABLE IF EXISTS `user_reviews`;
CREATE TABLE IF NOT EXISTS `user_reviews` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `reviewer_name` varchar(100) NOT NULL,
  `reviewer_avatar` varchar(255),
  `rating` int NOT NULL CHECK (rating >= 1 AND rating <= 5),
  `review_date` date NOT NULL,
  `review_text` text NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_status (`status`),
  INDEX idx_rating (`rating`),
  INDEX idx_date (`review_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`reviewer_name`, `reviewer_avatar`, `rating`, `review_date`, `review_text`, `product_name`) VALUES
('ProGamer123', 'img/avatars/user1.jpg', 5, '2025-09-01', 'Amazing product! The ESP functions work perfectly and I''ve been dominating the game. Worth every penny!', 'HOK Ultimate Hack Pack'),
('MLBBMaster', 'img/avatars/user2.jpg', 4, '2025-09-02', 'Great tools for Mobile Legends. The aimbot is accurate and the anti-ban system works well. Highly recommended!', 'MLBB Pro Hack Tools'),
('WildRiftPro', 'img/avatars/user3.jpg', 5, '2025-09-03', 'Best Wild Rift hacking tools I''ve used. The champion mastery feature is a game-changer!', 'Wild Rift Champion Pack'),
('PubgElite', 'img/avatars/user4.jpg', 4, '2025-09-04', 'Solid PUBG Mobile hack with good aimbot and ESP. Would be perfect with more customization options.', 'PUBG Mobile Elite'),
('HOKBeginner', 'img/avatars/user5.jpg', 5, '2025-09-05', 'As a beginner, this made a huge difference in my gameplay. Easy to use and very effective!', 'HOK Basic Hack'),
('MLBBNewbie', 'img/avatars/user6.jpg', 4, '2025-09-06', 'Great entry-level tools for MLBB. No root required is a big plus for me.', 'MLBB Basic Tools'),
('RiftStarter', 'img/avatars/user7.jpg', 3, '2025-09-07', 'Good basic tools for Wild Rift. The auto-level feature is helpful for beginners.', 'Wild Rift Starter'),
('CasualPubg', 'img/avatars/user8.jpg', 4, '2025-09-08', 'Simple but effective PUBG Mobile hack. Perfect for casual players like me.', 'PUBG Mobile Basic'),
('CompetitiveHOK', 'img/avatars/user9.jpg', 5, '2025-09-09', 'The pro pack is worth the investment. The anti-detection system is top-notch.', 'HOK Pro Pack'),
('MLBBChampion', 'img/avatars/user10.jpg', 5, '2025-09-10', 'Elite package helped me reach rank challenger. The combo assist feature is incredible!', 'MLBB Elite Package');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(50) UNIQUE NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50),
  `last_name` varchar(50),
  `phone` varchar(20),
  `address` text,
  `city` varchar(50),
  `state` varchar(50),
  `country` varchar(50),
  `zip_code` varchar(20),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `role` enum('user','admin') DEFAULT 'user',
  `balance` decimal(10,2) DEFAULT '0.00',
  INDEX idx_user_email (email),
  INDEX idx_user_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `last_login`, `is_active`, `role`, `balance`) VALUES
('admin', 'admin@hoqqdmd.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', '1234567890', '123 Admin St', 'Admin City', 'Admin State', 'Admin Country', '12345', '2025-09-12 16:44:44', '2025-09-12 16:51:26', 1, 'admin', '0.00'),
('demo', 'demo@hoqqdmd.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Demo', 'User', '0987654321', '456 Demo Rd', 'Demo City', 'Demo State', 'Demo Country', '54321', '2025-09-12 16:51:26', '2025-09-12 16:51:26', 1, 'user', '0.00');

COMMIT;
