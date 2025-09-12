-- HOQQDMD Database Schema for Testing
-- Honor of Kings Service Platform

-- Create database
CREATE DATABASE IF NOT EXISTS hoqqdmd_db;
USE hoqqdmd_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    balance DECIMAL(10,2) DEFAULT 0.00
);

-- Product types (2 hack types)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('mapahack_drone', 'drone_smart_skin') NOT NULL,
    description TEXT,
    features TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Subscription periods and pricing
CREATE TABLE IF NOT EXISTS pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    period ENUM('day', 'week', 'month', 'year') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount_percentage INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- User subscriptions
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    pricing_id INT NOT NULL,
    license_key VARCHAR(255) UNIQUE NOT NULL,
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_date TIMESTAMP NOT NULL,
    status ENUM('active', 'expired', 'suspended', 'cancelled') DEFAULT 'active',
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (pricing_id) REFERENCES pricing(id)
);

-- Payment transactions
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subscription_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50),
    transaction_id VARCHAR(100),
    status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (subscription_id) REFERENCES subscriptions(id)
);

-- User favorites
CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    UNIQUE KEY unique_favorite (user_id, product_id)
);

-- Insert default products
INSERT INTO products (name, type, description, features) VALUES
('MapaHack + Drone View Premium', 'mapahack_drone', 
 'Complete ESP functions with jungle timer and enemy information',
 'Jungle monster spawn timers|Enemy skill visibility|Dragon HP tracking|Complete map awareness|Advanced ESP functions'),
('Drone View + Smart Skill + Skin Unlocker', 'drone_smart_skin', 
 'Enhanced gameplay with skin unlocker and smart skill assistance',
 'Drone view camera|Smart skill targeting|All skins unlocked|Enhanced graphics|Auto-aim assistance');

-- Insert pricing for products
INSERT INTO pricing (product_id, period, price) VALUES
-- MapaHack + Drone View pricing
(1, 'day', 9.99),
(1, 'week', 49.99),
(1, 'month', 149.99),
(1, 'year', 999.99),
-- Drone View + Smart Skill + Skin pricing
(2, 'day', 14.99),
(2, 'week', 69.99),
(2, 'month', 199.99),
(2, 'year', 1299.99);

-- Create indexes for better performance
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_subscription_user ON subscriptions(user_id);
CREATE INDEX idx_subscription_status ON subscriptions(status);
CREATE INDEX idx_transaction_user ON transactions(user_id);
