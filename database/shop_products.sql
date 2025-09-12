-- Shop Products Database Schema for HOQQDMD
-- This creates tables specifically for the shop page products

USE hoqqdmd_db;

-- Product Types table
CREATE TABLE IF NOT EXISTS product_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    display_name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table (updated for shop)
CREATE TABLE IF NOT EXISTS shop_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    period VARCHAR(50) NOT NULL,
    price_usd DECIMAL(10,2) NOT NULL,
    price_brl DECIMAL(10,2) NOT NULL,
    description TEXT,
    features TEXT,
    badge VARCHAR(50),
    is_popular BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (type_id) REFERENCES product_types(id)
);

-- Insert product types
INSERT INTO product_types (name, display_name, description, icon, sort_order) VALUES
('drone', 'Drone View', 'Get the drone view feature separately with season-based pricing', 'fas fa-eye', 1),
('map', 'Map Hack', 'Complete map visibility and enemy tracking features', 'fas fa-map', 2),
('full', 'Full Mod Menu', 'Complete mod menu with all advanced functions', 'fas fa-cogs', 3);

-- You can add more product types dynamically:
-- INSERT INTO product_types (name, display_name, description, icon, sort_order) VALUES
-- ('premium', 'Premium Package', 'Ultimate gaming experience', 'fas fa-crown', 4),
-- ('basic', 'Basic Package', 'Essential features for beginners', 'fas fa-star', 5);

-- Insert Drone View products
INSERT INTO shop_products (type_id, name, period, price_usd, price_brl, description, features, badge, is_popular, sort_order) VALUES
(1, 'Drone View - Initial', 'Initial Payment', 10.00, 50.00, 'Get the drone view feature separately. Pay once initially, then 70% of the amount at each season restart.', 'Full drone view access|Instant activation|Setup assistance|24/7 support', 'Initial Payment', TRUE, 1),
(1, 'Drone View - Update', 'Season Update', 7.00, 35.00, 'Renewal pricing for each season restart or major game update.', 'Each season restart|Major game updates|Continued support|Renewal pricing', 'Season Update', FALSE, 2);

-- Insert Map Hack products
INSERT INTO shop_products (type_id, name, period, price_usd, price_brl, description, features, badge, is_popular, sort_order) VALUES
(2, 'Map Hack - 3 Days', '3 Days', 5.00, 30.00, 'Perfect for testing the map hack features with full functionality.', 'Complete map visibility|Enemy tracking|Instant activation|Professional support', 'Trial', FALSE, 1),
(2, 'Map Hack - 7 Days', '7 Days', 10.00, 65.00, 'Best value for a week of enhanced gameplay with map hack features.', 'Complete map visibility|Enemy tracking|Priority support|Custom configurations', 'Popular', TRUE, 2),
(2, 'Map Hack - 14 Days', '14 Days', 14.00, 100.00, 'Extended access to map hack features with VIP support and custom setup.', 'Complete map visibility|Enemy tracking|VIP support|Custom setup|Free minor updates', 'Extended', FALSE, 3);

-- Insert Full Mod Menu products
INSERT INTO shop_products (type_id, name, period, price_usd, price_brl, description, features, badge, is_popular, sort_order) VALUES
(3, 'Full Mod Menu - 3 Days', '3 Days', 5.00, 30.00, 'Test all features with complete mod menu, map hack, drone view, and advanced functions.', 'Complete mod menu|Map hack|Drone view|All advanced features|Professional support', 'Trial', FALSE, 1),
(3, 'Full Mod Menu - 7 Days', '7 Days', 10.00, 65.00, 'Weekly access to all premium features with priority support and custom configurations.', 'Complete mod menu|All advanced features|Priority support|Custom configurations', 'Weekly', FALSE, 2),
(3, 'Full Mod Menu - 31 Days', '31 Days', 30.00, 185.00, 'Ultimate gaming experience with all features, premium VIP support, and personal assistance.', 'Complete mod menu|All advanced features|Premium VIP support|All updates included|Personal assistance|Best value', 'Best Value', TRUE, 3);
