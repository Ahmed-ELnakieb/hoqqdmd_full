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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `generate_sample_keys`$$
CREATE PROCEDURE `generate_sample_keys` ()   BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE key_val VARCHAR(50);
    
    -- Generate 10 keys for product 1
    WHILE i < 10 DO
        SET key_val = CONCAT('HOQQ1-', LPAD(FLOOR(RAND() * 99999), 5, '0'), '-', 
                            LPAD(FLOOR(RAND() * 99999), 5, '0'), '-',
                            LPAD(FLOOR(RAND() * 99999), 5, '0'));
        INSERT IGNORE INTO license_keys (key_value, product_id, status) 
        VALUES (key_val, 1, 'available');
        SET i = i + 1;
    END WHILE;
    
    -- Generate 10 keys for product 2
    SET i = 0;
    WHILE i < 10 DO
        SET key_val = CONCAT('HOQQ2-', LPAD(FLOOR(RAND() * 99999), 5, '0'), '-', 
                            LPAD(FLOOR(RAND() * 99999), 5, '0'), '-',
                            LPAD(FLOOR(RAND() * 99999), 5, '0'));
        INSERT IGNORE INTO license_keys (key_value, product_id, status) 
        VALUES (key_val, 2, 'available');
        SET i = i + 1;
    END WHILE;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `generate_license_key`$$
CREATE FUNCTION `generate_license_key` () RETURNS VARCHAR(50) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci DETERMINISTIC BEGIN
    DECLARE chars VARCHAR(62) DEFAULT 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    DECLARE result VARCHAR(50) DEFAULT '';
    DECLARE i INT DEFAULT 0;
    DECLARE segment INT DEFAULT 0;
    
    WHILE segment < 5 DO
        SET i = 0;
        IF segment > 0 THEN
            SET result = CONCAT(result, '-');
        END IF;
        WHILE i < 5 DO
            SET result = CONCAT(result, SUBSTRING(chars, FLOOR(1 + RAND() * 36), 1));
            SET i = i + 1;
        END WHILE;
        SET segment = segment + 1;
    END WHILE;
    
    RETURN result;
END$$

DELIMITER ;

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
(3, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/categories/wildrift_hero.jpg', 'shop.php?product=wildrift-champion', 1, 1, 3, '2025-09-12 16:44:44'),
(4, 'HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/categories/hok_hero.jpg', 'shop.php?product=ultimate', 1, 1, 1, '2025-09-12 16:50:52'),
(5, 'MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/categories/mlbb_hero.jpg', 'shop.php?product=mlbb-pro', 1, 1, 2, '2025-09-12 16:50:52'),
(6, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/categories/wildrift_hero.jpg', 'shop.php?product=wildrift-champion', 1, 1, 3, '2025-09-12 16:50:52'),
(7, 'HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/categories/hok_hero.jpg', 'shop.php?product=ultimate', 1, 1, 1, '2025-09-12 16:50:57'),
(8, 'MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/categories/mlbb_hero.jpg', 'shop.php?product=mlbb-pro', 1, 1, 2, '2025-09-12 16:50:57'),
(9, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/categories/wildrift_hero.jpg', 'shop.php?product=wildrift-champion', 1, 1, 3, '2025-09-12 16:50:57'),
(10, 'HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/categories/hok_hero.jpg', 'shop.php?product=ultimate', 1, 1, 1, '2025-09-12 16:51:26'),
(11, 'MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/categories/mlbb_hero.jpg', 'shop.php?product=mlbb-pro', 1, 1, 2, '2025-09-12 16:51:26'),
(12, 'Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/categories/wildrift_hero.jpg', 'shop.php?product=wildrift-champion', 1, 1, 3, '2025-09-12 16:51:26');

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
(4, 'pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 1, 4, '2025-09-12 16:44:44'),
(5, 'hok', 'Honor of Kings', 'Premium HOK hacking tools and features', 'img/categories/hok_hero.jpg', 'shop.php?category=hok', 1, 1, '2025-09-12 16:50:52'),
(6, 'mlbb', 'Mobile Legends', 'Advanced MLBB hacking solutions', 'img/categories/mlbb_hero.jpg', 'shop.php?category=mlbb', 1, 2, '2025-09-12 16:50:52'),
(7, 'wildrift', 'Wild Rift', 'Professional Wild Rift hacking tools', 'img/categories/wildrift_hero.jpg', 'shop.php?category=wildrift', 1, 3, '2025-09-12 16:50:52'),
(8, 'pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 1, 4, '2025-09-12 16:50:52'),
(9, 'hok', 'Honor of Kings', 'Premium HOK hacking tools and features', 'img/categories/hok_hero.jpg', 'shop.php?category=hok', 1, 1, '2025-09-12 16:50:57'),
(10, 'mlbb', 'Mobile Legends', 'Advanced MLBB hacking solutions', 'img/categories/mlbb_hero.jpg', 'shop.php?category=mlbb', 1, 2, '2025-09-12 16:50:57'),
(11, 'wildrift', 'Wild Rift', 'Professional Wild Rift hacking tools', 'img/categories/wildrift_hero.jpg', 'shop.php?category=wildrift', 1, 3, '2025-09-12 16:50:57'),
(12, 'pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 1, 4, '2025-09-12 16:50:57'),
(13, 'hok', 'Honor of Kings', 'Premium HOK hacking tools and features', 'img/categories/hok_hero.jpg', 'shop.php?category=hok', 1, 1, '2025-09-12 16:51:26'),
(14, 'mlbb', 'Mobile Legends', 'Advanced MLBB hacking solutions', 'img/categories/mlbb_hero.jpg', 'shop.php?category=mlbb', 1, 2, '2025-09-12 16:51:26'),
(15, 'wildrift', 'Wild Rift', 'Professional Wild Rift hacking tools', 'img/categories/wildrift_hero.jpg', 'shop.php?category=wildrift', 1, 3, '2025-09-12 16:51:26'),
(16, 'pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 1, 4, '2025-09-12 16:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `home_sections`
--

DROP TABLE IF EXISTS `home_sections`;
CREATE TABLE IF NOT EXISTS `home_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_name` (`section_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sections`
--

INSERT INTO `home_sections` (`id`, `section_name`, `title`, `subtitle`, `description`, `button_text`, `button_link`, `image_url`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 'hero_section_1', 'Honor of Kings Hack', 'Professional Gaming Tools', 'Get the ultimate advantage in Honor of Kings with our premium hacking tools and features.', 'Get Hacks Now', 'shop.php', 'img/categories/hok_hero.jpg', 1, 1, '2025-09-12 16:44:44'),
(2, 'hero_section_2', 'Mobile Legends Hack', 'Dominate Every Match', 'Unleash your potential with advanced MLBB hacking tools and strategic advantages.', 'View Hacks', 'shop.php?category=mlbb', 'img/categories/mlbb_hero.jpg', 1, 2, '2025-09-12 16:44:44'),
(3, 'hero_section_3', 'Wild Rift Hack', 'Champion Level Skills', 'Experience the power of professional-grade Wild Rift hacking tools.', 'Explore Hacks', 'shop.php?category=wildrift', 'img/categories/wildrift_hero.jpg', 1, 3, '2025-09-12 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `key_logs`
--

DROP TABLE IF EXISTS `key_logs`;
CREATE TABLE IF NOT EXISTS `key_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_id` int NOT NULL,
  `user_id` int NOT NULL,
  `action` enum('activated','used','suspended','expired','hwid_changed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hwid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_log_key` (`key_id`),
  KEY `idx_log_action` (`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `activated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('available','active','expired','suspended','revoked') COLLATE utf8mb4_unicode_ci DEFAULT 'available',
  `hwid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used` timestamp NULL DEFAULT NULL,
  `usage_count` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_value` (`key_value`),
  KEY `product_id` (`product_id`),
  KEY `idx_key_status` (`status`),
  KEY `idx_key_user` (`user_id`),
  KEY `idx_key_expires` (`expires_at`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_keys`
--

INSERT INTO `license_keys` (`id`, `key_value`, `product_id`, `user_id`, `created_at`, `activated_at`, `expires_at`, `status`, `hwid`, `last_used`, `usage_count`) VALUES
(1, 'HOQQ1-47544-62908-71907', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(2, 'HOQQ1-70814-38352-79317', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(3, 'HOQQ1-81533-69715-03975', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(4, 'HOQQ1-10730-41726-76440', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(5, 'HOQQ1-57025-55804-07947', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(6, 'HOQQ1-72321-37768-71878', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(7, 'HOQQ1-46089-14811-35787', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(8, 'HOQQ1-34503-65154-22262', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(9, 'HOQQ1-15851-12466-14781', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(10, 'HOQQ1-36505-38184-81406', 1, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(11, 'HOQQ2-92482-18192-13514', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(12, 'HOQQ2-12995-24433-83182', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(13, 'HOQQ2-42614-63522-89772', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(14, 'HOQQ2-58293-22152-35879', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(15, 'HOQQ2-12940-57064-46501', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(16, 'HOQQ2-61314-67069-51405', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(17, 'HOQQ2-55816-24870-56898', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(18, 'HOQQ2-09884-78725-63977', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(19, 'HOQQ2-83708-26612-81937', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0),
(20, 'HOQQ2-29849-03435-27629', 2, NULL, '2025-09-12 01:06:08', NULL, NULL, 'available', NULL, NULL, 0);

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
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `product_id`, `period`, `price`, `discount_percentage`, `is_active`) VALUES
(1, 1, 'day', 9.99, 0, 1),
(2, 1, 'week', 49.99, 0, 1),
(3, 1, 'month', 149.99, 0, 1),
(4, 1, 'year', 999.99, 0, 1),
(5, 2, 'day', 14.99, 0, 1),
(6, 2, 'week', 69.99, 0, 1),
(7, 2, 'month', 199.99, 0, 1),
(8, 2, 'year', 1299.99, 0, 1),
(9, 1, 'day', 9.99, 0, 1),
(10, 1, 'week', 49.99, 0, 1),
(11, 1, 'month', 149.99, 0, 1),
(12, 1, 'year', 999.99, 0, 1),
(13, 2, 'day', 14.99, 0, 1),
(14, 2, 'week', 69.99, 0, 1),
(15, 2, 'month', 199.99, 0, 1),
(16, 2, 'year', 1299.99, 0, 1);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `description`, `features`, `status`, `created_at`) VALUES
(1, 'MapaHack + Drone View Premium', 'mapahack_drone', 'Complete ESP functions with jungle timer and enemy information', 'Jungle monster spawn timers|Enemy skill visibility|Dragon HP tracking|Complete map awareness|Advanced ESP functions', 'active', '2025-09-12 01:06:08'),
(2, 'Drone View + Smart Skill + Skin Unlocker', 'drone_smart_skin', 'Enhanced gameplay with skin unlocker and smart skill assistance', 'Drone view camera|Smart skill targeting|All skins unlocked|Enhanced graphics|Auto-aim assistance', 'active', '2025-09-12 01:06:08'),
(3, 'MapaHack + Drone View Premium', 'mapahack_drone', 'Complete ESP functions with jungle timer and enemy information', 'Jungle monster spawn timers|Enemy skill visibility|Dragon HP tracking|Complete map awareness|Advanced ESP functions', 'active', '2025-09-12 16:51:19'),
(4, 'Drone View + Smart Skill + Skin Unlocker', 'drone_smart_skin', 'Enhanced gameplay with skin unlocker and smart skill assistance', 'Drone view camera|Smart skill targeting|All skins unlocked|Enhanced graphics|Auto-aim assistance', 'active', '2025-09-12 16:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `display_name`, `description`, `icon`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'drone', 'Drone View', 'Get the drone view feature separately with season-based pricing', 'fas fa-eye', 1, 1, '2025-09-12 14:53:38'),
(2, 'map', 'Map Hack', 'Complete map visibility and enemy tracking features', 'fas fa-map', 2, 1, '2025-09-12 14:53:38'),
(3, 'full', 'Full Mod Menu', 'Complete mod menu with all advanced functions', 'fas fa-cogs', 3, 1, '2025-09-12 14:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_usd` decimal(10,2) NOT NULL,
  `price_brl` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` text COLLATE utf8mb4_unicode_ci,
  `badge` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `type_id`, `name`, `period`, `price_usd`, `price_brl`, `description`, `features`, `badge`, `is_popular`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 1, 'Drone View - Initial', 'Initial Payment', 10.00, 50.00, 'Get the drone view feature separately. Pay once initially, then 70% of the amount at each season restart.', 'Full drone view access|Instant activation|Setup assistance|24/7 support', 'Initial Payment', 1, 1, 1, '2025-09-12 14:53:38'),
(2, 1, 'Drone View - Update', 'Season Update', 7.00, 35.00, 'Renewal pricing for each season restart or major game update.', 'Each season restart|Major game updates|Continued support|Renewal pricing', 'Season Update', 0, 1, 2, '2025-09-12 14:53:38'),
(3, 2, 'Map Hack - 3 Days', '3 Days', 5.00, 30.00, 'Perfect for testing the map hack features with full functionality.', 'Complete map visibility|Enemy tracking|Instant activation|Professional support', 'Trial', 0, 1, 1, '2025-09-12 14:53:38'),
(4, 2, 'Map Hack - 7 Days', '7 Days', 10.00, 65.00, 'Best value for a week of enhanced gameplay with map hack features.', 'Complete map visibility|Enemy tracking|Priority support|Custom configurations', 'Popular', 1, 1, 2, '2025-09-12 14:53:38'),
(5, 2, 'Map Hack - 14 Days', '14 Days', 14.00, 100.00, 'Extended access to map hack features with VIP support and custom setup.', 'Complete map visibility|Enemy tracking|VIP support|Custom setup|Free minor updates', 'Extended', 0, 1, 3, '2025-09-12 14:53:38'),
(6, 3, 'Full Mod Menu - 3 Days', '3 Days', 5.00, 30.00, 'Test all features with complete mod menu, map hack, drone view, and advanced functions.', 'Complete mod menu|Map hack|Drone view|All advanced features|Professional support', 'Trial', 0, 1, 1, '2025-09-12 14:53:38'),
(7, 3, 'Full Mod Menu - 7 Days', '7 Days', 10.00, 65.00, 'Weekly access to all premium features with priority support and custom configurations.', 'Complete mod menu|All advanced features|Priority support|Custom configurations', 'Weekly', 0, 1, 2, '2025-09-12 14:53:38'),
(8, 3, 'Full Mod Menu - 31 Days', '31 Days', 30.00, 185.00, 'Ultimate gaming experience with all features, premium VIP support, and personal assistance.', 'Complete mod menu|All advanced features|Premium VIP support|All updates included|Personal assistance|Best value', 'Best Value', 1, 1, 3, '2025-09-12 14:53:38');

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
  `key_id` int NOT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL,
  `status` enum('active','expired','suspended','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `auto_renew` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `pricing_id` (`pricing_id`),
  KEY `key_id` (`key_id`),
  KEY `idx_sub_user` (`user_id`),
  KEY `idx_sub_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `completed_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `subscription_id` (`subscription_id`),
  KEY `idx_transaction_user` (`user_id`),
  KEY `idx_transaction_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `balance` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_user_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `created_at`, `last_login`, `is_active`, `role`, `balance`) VALUES
(1, 'mafojujobo', 'tynibafo@mailinator.com', '$2y$10$Pvg/tU5/jh0Mv6Wa70DXsunIhmNJqyXYDt5Rh3sUfgPbXhAZcaUAm', '+1 (618) 543-8219', '2025-09-12 01:06:55', NULL, 1, 'user', 0.00),
(2, 'cokahyxiwa', 'vevycany@mailinator.com', '$2y$10$bGNef9yuuKu/p674vsS9x.QaK3VpoBum3gB8LuxV5Uh39MTyuQ/pK', '+1 (143) 961-2515', '2025-09-12 13:17:52', NULL, 1, 'user', 0.00),
(3, 'xacuko', 'juru@mailinator.com', '$2y$10$YZClkhbMkKPQJayIqx/q1eImOmIyTrLidAy.BKKTMUQ6k1u6xb03O', '+1 (239) 776-5532', '2025-09-12 13:23:20', NULL, 1, 'user', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

DROP TABLE IF EXISTS `user_reviews`;
CREATE TABLE IF NOT EXISTS `user_reviews` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `reviewer_name` varchar(100) NOT NULL,
  `reviewer_avatar` varchar(255) DEFAULT NULL,
  `rating` int NOT NULL,
  `review_date` date NOT NULL,
  `review_text` text NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_rating` (`rating`),
  KEY `idx_date` (`review_date`)
) ;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `reviewer_name`, `reviewer_avatar`, `rating`, `review_date`, `review_text`, `product_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alex Johnson', NULL, 5, '2023-12-15', 'The Honor of Kings hack is incredible! I\'ve been using it for months and it\'s still undetected. The drone view feature gives me a huge advantage in battle.', 'Honor of Kings Pro Hack', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39'),
(2, 'Sarah Miller', NULL, 4, '2023-12-10', 'Great hack with excellent features. The ESP is very accurate and helps me spot enemies easily. Customer support is also very responsive.', 'Honor of Kings ESP Hack', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39'),
(3, 'Mike Chen', NULL, 5, '2023-12-05', 'Best hack I\'ve ever used! The aimbot is incredibly smooth and the auto headshot feature is a game-changer. Highly recommend to anyone looking to dominate.', 'Honor of Kings Aimbot', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39'),
(4, 'Emma Wilson', NULL, 4, '2023-11-28', 'This hack has significantly improved my gameplay. The aim assist is very natural and doesn\'t feel robotic at all.', 'Honor of Kings Aimbot', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39'),
(5, 'David Kim', NULL, 5, '2023-11-20', 'The anti-ban system is excellent. I\'ve been using this for over 2 months without any issues. Very satisfied with the purchase.', 'Honor of Kings Anti-Ban', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39'),
(6, 'Jessica Brown', NULL, 3, '2023-11-15', 'Good overall but had some issues with mobile compatibility. The desktop version works perfectly though.', 'Honor of Kings Mobile Support', 'active', '2025-09-12 21:30:39', '2025-09-12 21:30:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
