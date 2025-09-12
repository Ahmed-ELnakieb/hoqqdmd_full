-- Home Page Content Database Schema
-- This creates tables for dynamic home page content

USE hoqqdmd_db;

-- Home page sections table
CREATE TABLE IF NOT EXISTS home_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_name VARCHAR(100) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(500),
    description TEXT,
    button_text VARCHAR(100),
    button_link VARCHAR(255),
    image_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Game categories for Popular Categories section
CREATE TABLE IF NOT EXISTS game_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    display_name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    link_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Featured products section
CREATE TABLE IF NOT EXISTS featured_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    original_price DECIMAL(10,2),
    discount_price DECIMAL(10,2),
    discount_percentage INT,
    image_url VARCHAR(255),
    link_url VARCHAR(255),
    is_special_offer BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert home page sections
INSERT INTO home_sections (section_name, title, subtitle, description, button_text, button_link, image_url, sort_order) VALUES
('hero_section_1', 'Honor of Kings Hack', 'Professional Gaming Tools', 'Get the ultimate advantage in Honor of Kings with our premium hacking tools and features.', 'Get Hacks Now', 'shop.php', 'img/slider/hok_hero1.jpg', 1),
('hero_section_2', 'Mobile Legends Hack', 'Dominate Every Match', 'Unleash your potential with advanced MLBB hacking tools and strategic advantages.', 'View Hacks', 'shop.php?category=mlbb', 'img/slider/mlbb_hero1.jpg', 2),
('hero_section_3', 'Wild Rift Hack', 'Champion Level Skills', 'Experience the power of professional-grade Wild Rift hacking tools.', 'Explore Hacks', 'shop.php?category=wildrift', 'img/slider/wildrift_hero1.jpg', 3);

-- Insert game categories
INSERT INTO game_categories (name, display_name, description, image_url, link_url, sort_order) VALUES
('hok', 'Honor of Kings', 'Premium HOK hacking tools and features', 'img/categories/hok_hero.jpg', 'shop.php?category=hok', 1),
('mlbb', 'Mobile Legends', 'Advanced MLBB hacking solutions', 'img/categories/mlbb_hero.jpg', 'shop.php?category=mlbb', 2),
('wildrift', 'Wild Rift', 'Professional Wild Rift hacking tools', 'img/categories/wildrift_hero.jpg', 'shop.php?category=wildrift', 3),
('pubg', 'PUBG Mobile', 'Ultimate PUBG Mobile hacking experience', 'img/categories/pubg_hero.jpg', 'shop.php?category=pubg', 4);

-- Insert featured products
INSERT INTO featured_products (name, description, original_price, discount_price, discount_percentage, image_url, link_url, is_special_offer, sort_order) VALUES
('HOK Ultimate Hack Pack', 'Complete Honor of Kings hacking suite with all premium features', 99.99, 64.99, 35, 'img/featured/hok_ultimate.jpg', 'shop.php?product=ultimate', TRUE, 1),
('MLBB Pro Hack Tools', 'Professional Mobile Legends hacking tools with advanced features', 79.99, 51.99, 35, 'img/featured/mlbb_pro.jpg', 'shop.php?product=mlbb-pro', TRUE, 2),
('Wild Rift Champion Pack', 'Elite Wild Rift hacking package for competitive players', 89.99, 58.49, 35, 'img/featured/wildrift_champion.jpg', 'shop.php?product=wildrift-champion', TRUE, 3);

