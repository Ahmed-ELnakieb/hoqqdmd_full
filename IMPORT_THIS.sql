-- =========================================
-- HOQQDMD Complete Database Setup
-- Import this file in phpMyAdmin
-- =========================================

-- Drop database if exists (for clean install)
DROP DATABASE IF EXISTS hoqqdmd_db;

-- Create database
CREATE DATABASE hoqqdmd_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hoqqdmd_db;

-- =========================================
-- TABLES CREATION
-- =========================================

-- 1. Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    role ENUM('user', 'admin') DEFAULT 'user',
    balance DECIMAL(10,2) DEFAULT 0.00,
    INDEX idx_user_email (email),
    INDEX idx_user_username (username)
) ENGINE=InnoDB;

-- 2. Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('mapahack_drone', 'drone_smart_skin') NOT NULL,
    description TEXT,
    features TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_product_status (status),
    INDEX idx_product_type (type)
) ENGINE=InnoDB;

-- 3. Pricing plans table
CREATE TABLE pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    period ENUM('day', 'week', 'month', 'year') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount_percentage INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_pricing_product (product_id),
    INDEX idx_pricing_active (is_active)
) ENGINE=InnoDB;

-- 4. License Keys table
CREATE TABLE license_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_value VARCHAR(50) UNIQUE NOT NULL,
    product_id INT NOT NULL,
    user_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activated_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    status ENUM('available', 'active', 'expired', 'suspended', 'revoked') DEFAULT 'available',
    hwid VARCHAR(100) DEFAULT NULL,
    last_used TIMESTAMP NULL,
    usage_count INT DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_key_status (status),
    INDEX idx_key_user (user_id),
    INDEX idx_key_expires (expires_at),
    INDEX idx_key_product (product_id)
) ENGINE=InnoDB;

-- 5. User subscriptions table
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    pricing_id INT NOT NULL,
    key_id INT DEFAULT NULL,
    license_key VARCHAR(50) DEFAULT NULL,
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_date TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'expired', 'suspended', 'cancelled') DEFAULT 'active',
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    auto_renew BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (pricing_id) REFERENCES pricing(id) ON DELETE CASCADE,
    FOREIGN KEY (key_id) REFERENCES license_keys(id) ON DELETE SET NULL,
    INDEX idx_sub_user (user_id),
    INDEX idx_sub_status (status),
    INDEX idx_sub_product (product_id),
    INDEX idx_sub_created (created_at)
) ENGINE=InnoDB;

-- 6. Payment transactions table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subscription_id INT DEFAULT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    payment_method VARCHAR(50),
    payment_gateway VARCHAR(50),
    transaction_id VARCHAR(100) UNIQUE,
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON DELETE SET NULL,
    INDEX idx_transaction_user (user_id),
    INDEX idx_transaction_status (status),
    INDEX idx_transaction_created (created_at)
) ENGINE=InnoDB;

-- 7. Key usage logs table
CREATE TABLE key_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_id INT NOT NULL,
    user_id INT NOT NULL,
    action ENUM('activated', 'used', 'suspended', 'expired', 'hwid_changed') NOT NULL,
    ip_address VARCHAR(45),
    hwid VARCHAR(100),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (key_id) REFERENCES license_keys(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_log_key (key_id),
    INDEX idx_log_user (user_id),
    INDEX idx_log_action (action),
    INDEX idx_log_created (created_at)
) ENGINE=InnoDB;

-- 8. Admin logs table
CREATE TABLE admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    target_type VARCHAR(50),
    target_id INT,
    details TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_admin_log_admin (admin_id),
    INDEX idx_admin_log_created (created_at)
) ENGINE=InnoDB;

-- 9. User favorites table
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorite (user_id, product_id),
    INDEX idx_favorite_user (user_id)
) ENGINE=InnoDB;

-- =========================================
-- INSERT DEFAULT DATA
-- =========================================

-- Insert products
INSERT INTO products (name, type, description, features) VALUES
('MapaHack + Drone View Premium', 'mapahack_drone', 
 'Complete ESP functions with jungle timer and enemy information. See everything on the map including enemy positions, jungle timers, and hidden information.',
 'Jungle monster spawn timers|Enemy skill visibility|Dragon/Turtle HP tracking|Complete map awareness|Advanced ESP functions|Enemy ultimate cooldowns|Tower range indicators|Bush vision|Item tracker'),
 
('Drone View + Smart Skill + Skin Unlocker', 'drone_smart_skin', 
 'Enhanced gameplay with skin unlocker and smart skill assistance. Get all skins and smart targeting assistance.',
 'Drone view camera|Smart skill targeting|All skins unlocked|Enhanced graphics|Auto-aim assistance|Skill prediction|Smart combo execution|Anti-miss technology|VIP effects');

-- Insert pricing plans
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

-- =========================================
-- GENERATE SAMPLE LICENSE KEYS
-- =========================================

-- Generate 20 sample keys for Product 1 (MapaHack)
INSERT INTO license_keys (key_value, product_id, status) VALUES
('HOQQ1-A1B2C-3D4E5-F6G7H', 1, 'available'),
('HOQQ1-I8J9K-0L1M2-N3O4P', 1, 'available'),
('HOQQ1-Q5R6S-7T8U9-V0W1X', 1, 'available'),
('HOQQ1-Y2Z3A-4B5C6-D7E8F', 1, 'available'),
('HOQQ1-G9H0I-1J2K3-L4M5N', 1, 'available'),
('HOQQ1-O6P7Q-8R9S0-T1U2V', 1, 'available'),
('HOQQ1-W3X4Y-5Z6A7-B8C9D', 1, 'available'),
('HOQQ1-E0F1G-2H3I4-J5K6L', 1, 'available'),
('HOQQ1-M7N8O-9P0Q1-R2S3T', 1, 'available'),
('HOQQ1-U4V5W-6X7Y8-Z9A0B', 1, 'available');

-- Generate 20 sample keys for Product 2 (Smart Skill)
INSERT INTO license_keys (key_value, product_id, status) VALUES
('HOQQ2-C1D2E-3F4G5-H6I7J', 2, 'available'),
('HOQQ2-K8L9M-0N1O2-P3Q4R', 2, 'available'),
('HOQQ2-S5T6U-7V8W9-X0Y1Z', 2, 'available'),
('HOQQ2-A2B3C-4D5E6-F7G8H', 2, 'available'),
('HOQQ2-I9J0K-1L2M3-N4O5P', 2, 'available'),
('HOQQ2-Q6R7S-8T9U0-V1W2X', 2, 'available'),
('HOQQ2-Y3Z4A-5B6C7-D8E9F', 2, 'available'),
('HOQQ2-G0H1I-2J3K4-L5M6N', 2, 'available'),
('HOQQ2-O7P8Q-9R0S1-T2U3V', 2, 'available'),
('HOQQ2-W4X5Y-6Z7A8-B9C0D', 2, 'available');

-- =========================================
-- CREATE STORED PROCEDURES
-- =========================================

DELIMITER //

-- Procedure to generate random license key
CREATE PROCEDURE GenerateRandomKey(IN product_id INT)
BEGIN
    DECLARE key_val VARCHAR(50);
    DECLARE key_exists INT DEFAULT 1;
    DECLARE prefix VARCHAR(5);
    
    SET prefix = IF(product_id = 1, 'HOQQ1', 'HOQQ2');
    
    WHILE key_exists > 0 DO
        SET key_val = CONCAT(
            prefix, '-',
            LPAD(CONV(FLOOR(RAND() * 99999), 10, 36), 5, '0'), '-',
            LPAD(CONV(FLOOR(RAND() * 99999), 10, 36), 5, '0'), '-',
            LPAD(CONV(FLOOR(RAND() * 99999), 10, 36), 5, '0')
        );
        
        SELECT COUNT(*) INTO key_exists 
        FROM license_keys 
        WHERE key_value = key_val;
    END WHILE;
    
    INSERT INTO license_keys (key_value, product_id, status) 
    VALUES (key_val, product_id, 'available');
    
    SELECT key_val as generated_key;
END//

-- Procedure to clean expired keys
CREATE PROCEDURE CleanExpiredKeys()
BEGIN
    UPDATE license_keys 
    SET status = 'expired' 
    WHERE status = 'active' 
    AND expires_at < NOW();
    
    UPDATE subscriptions 
    SET status = 'expired' 
    WHERE status = 'active' 
    AND end_date < NOW();
    
    SELECT ROW_COUNT() as updated_rows;
END//

-- Procedure to assign key to user
CREATE PROCEDURE AssignKeyToUser(
    IN p_user_id INT,
    IN p_product_id INT,
    IN p_pricing_id INT,
    IN p_days INT
)
BEGIN
    DECLARE v_key_id INT;
    DECLARE v_key_value VARCHAR(50);
    DECLARE v_end_date TIMESTAMP;
    
    -- Calculate end date
    SET v_end_date = DATE_ADD(NOW(), INTERVAL p_days DAY);
    
    -- Find available key
    SELECT id, key_value INTO v_key_id, v_key_value
    FROM license_keys
    WHERE product_id = p_product_id 
    AND status = 'available'
    AND user_id IS NULL
    LIMIT 1
    FOR UPDATE;
    
    IF v_key_id IS NOT NULL THEN
        -- Update key
        UPDATE license_keys
        SET user_id = p_user_id,
            activated_at = NOW(),
            expires_at = v_end_date,
            status = 'active'
        WHERE id = v_key_id;
        
        -- Create subscription
        INSERT INTO subscriptions (
            user_id, product_id, pricing_id, key_id, 
            license_key, end_date, status, payment_status
        ) VALUES (
            p_user_id, p_product_id, p_pricing_id, v_key_id,
            v_key_value, v_end_date, 'active', 'completed'
        );
        
        SELECT v_key_value as license_key, LAST_INSERT_ID() as subscription_id;
    ELSE
        SELECT 'No keys available' as error;
    END IF;
END//

DELIMITER ;

-- =========================================
-- CREATE SAMPLE ADMIN USER
-- =========================================

-- Admin password: admin123 (you should change this!)
-- This is the bcrypt hash for 'admin123'
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@hoqqdmd.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- =========================================
-- CREATE DEMO USER WITH SUBSCRIPTION
-- =========================================

-- Demo user password: demo123
INSERT INTO users (username, email, password, role) VALUES
('demo', 'demo@hoqqdmd.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Assign a key to demo user (30-day subscription to Product 1)
UPDATE license_keys 
SET user_id = 2, 
    activated_at = NOW(), 
    expires_at = DATE_ADD(NOW(), INTERVAL 30 DAY),
    status = 'active'
WHERE key_value = 'HOQQ1-A1B2C-3D4E5-F6G7H';

INSERT INTO subscriptions (
    user_id, product_id, pricing_id, key_id, license_key,
    end_date, status, payment_status
) VALUES (
    2, 1, 3, 1, 'HOQQ1-A1B2C-3D4E5-F6G7H',
    DATE_ADD(NOW(), INTERVAL 30 DAY), 'active', 'completed'
);

-- Add demo transaction
INSERT INTO transactions (
    user_id, subscription_id, amount, payment_method, 
    transaction_id, status, completed_at
) VALUES (
    2, 1, 149.99, 'PayPal', 
    'TXN-DEMO-001', 'completed', NOW()
);

-- =========================================
-- DISPLAY SUCCESS MESSAGE
-- =========================================

SELECT 'Database setup complete!' as Status,
       'Admin login: admin@hoqqdmd.com / admin123' as Admin_Credentials,
       'Demo login: demo@hoqqdmd.com / demo123' as Demo_Credentials,
       (SELECT COUNT(*) FROM license_keys WHERE status = 'available') as Available_Keys;
