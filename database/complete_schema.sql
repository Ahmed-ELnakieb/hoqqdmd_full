-- HOQQDMD Complete Database Schema with Keys Management
-- Database: hoqqdmd_db

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
    role ENUM('user', 'admin') DEFAULT 'user',
    balance DECIMAL(10,2) DEFAULT 0.00
);

-- Products table (HOK hacks)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('mapahack_drone', 'drone_smart_skin') NOT NULL,
    description TEXT,
    features TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pricing plans
CREATE TABLE IF NOT EXISTS pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    period ENUM('day', 'week', 'month', 'year') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount_percentage INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- License Keys table (separate for better management)
CREATE TABLE IF NOT EXISTS license_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_value VARCHAR(50) UNIQUE NOT NULL,  -- Reduced size to avoid MySQL error
    product_id INT NOT NULL,
    user_id INT DEFAULT NULL,  -- NULL means unassigned
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activated_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    status ENUM('available', 'active', 'expired', 'suspended', 'revoked') DEFAULT 'available',
    hwid VARCHAR(100) DEFAULT NULL,  -- Hardware ID binding for anti-sharing
    last_used TIMESTAMP NULL,
    usage_count INT DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    INDEX idx_key_status (status),
    INDEX idx_key_user (user_id),
    INDEX idx_key_expires (expires_at)
);

-- User subscriptions (linked to keys)
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    pricing_id INT NOT NULL,
    key_id INT NOT NULL,  -- Link to license_keys table
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_date TIMESTAMP NOT NULL,
    status ENUM('active', 'expired', 'suspended', 'cancelled') DEFAULT 'active',
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    auto_renew BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (pricing_id) REFERENCES pricing(id),
    FOREIGN KEY (key_id) REFERENCES license_keys(id),
    INDEX idx_sub_user (user_id),
    INDEX idx_sub_status (status)
);

-- Payment transactions
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subscription_id INT,
    amount DECIMAL(10,2) NOT NULL,
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

-- Key usage logs (for tracking)
CREATE TABLE IF NOT EXISTS key_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_id INT NOT NULL,
    user_id INT NOT NULL,
    action ENUM('activated', 'used', 'suspended', 'expired', 'hwid_changed') NOT NULL,
    ip_address VARCHAR(45),
    hwid VARCHAR(100),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (key_id) REFERENCES license_keys(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    INDEX idx_log_key (key_id),
    INDEX idx_log_action (action)
);

-- Admin logs
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

-- Function to generate random license keys (for testing)
DELIMITER $$
CREATE FUNCTION generate_license_key() 
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
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

-- Create some sample license keys for testing
DELIMITER $$
CREATE PROCEDURE generate_sample_keys()
BEGIN
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
DELIMITER ;

-- Call the procedure to generate sample keys
CALL generate_sample_keys();

-- Create indexes for better performance
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_transaction_user ON transactions(user_id);
CREATE INDEX idx_transaction_status ON transactions(status);
