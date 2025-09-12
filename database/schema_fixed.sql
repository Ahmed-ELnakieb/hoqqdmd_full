-- HOQQDMD Database Schema (Fixed for MySQL index limitations)
-- Database: hoqqdmd_db

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS hoqqdmd_db;
USE hoqqdmd_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- Products table (HOK hacks)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    features TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE
);

-- Pricing plans
CREATE TABLE IF NOT EXISTS pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    duration_days INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    plan_name VARCHAR(50),
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- User subscriptions (Fixed: reduced license_key length)
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    pricing_id INT NOT NULL,
    license_key VARCHAR(100) UNIQUE NOT NULL,  -- Reduced from 255 to 100
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
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    payment_method VARCHAR(50),
    payment_gateway VARCHAR(50),
    transaction_id VARCHAR(100) UNIQUE,
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (subscription_id) REFERENCES subscriptions(id)
);

-- Admin logs for tracking
CREATE TABLE IF NOT EXISTS admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    target_type VARCHAR(50),
    target_id INT,
    details TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

-- Insert sample products
INSERT INTO products (name, description, category, features) VALUES
('HOK ESP Hack', 'Advanced ESP features for Honor of Kings including player positions, health bars, and item tracking', 'ESP', 'Player ESP, Item ESP, Health Bars, Distance Tracking, Customizable Colors'),
('HOK Aimbot Pro', 'Professional aimbot solution with smooth targeting and anti-detection', 'Aimbot', 'Smooth Aim, FOV Settings, Target Priority, Anti-Detection, Customizable Hotkeys');

-- Insert pricing plans for products
INSERT INTO pricing (product_id, duration_days, price, plan_name) VALUES
-- ESP Hack pricing
(1, 1, 9.99, 'Daily'),
(1, 7, 49.99, 'Weekly'),
(1, 30, 149.99, 'Monthly'),
-- Aimbot Pro pricing
(2, 1, 14.99, 'Daily'),
(2, 7, 74.99, 'Weekly'),
(2, 30, 199.99, 'Monthly');

-- Create indexes for better performance
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_subscriptions_user ON subscriptions(user_id);
CREATE INDEX idx_subscriptions_status ON subscriptions(status);
CREATE INDEX idx_transactions_user ON transactions(user_id);
CREATE INDEX idx_transactions_status ON transactions(status);

-- Sample admin user (password: admin123 - hashed)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@hoqqdmd.com', '$2y$10$YourHashedPasswordHere', 'admin');
