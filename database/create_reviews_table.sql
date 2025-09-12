-- Create reviews table for the reviews page
CREATE TABLE IF NOT EXISTS user_reviews (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reviewer_name VARCHAR(100) NOT NULL,
    reviewer_avatar VARCHAR(255),
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_date DATE NOT NULL,
    review_text TEXT NOT NULL,
    product_name VARCHAR(200) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_rating (rating),
    INDEX idx_date (review_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample reviews
INSERT INTO user_reviews (reviewer_name, reviewer_avatar, rating, review_date, review_text, product_name) VALUES
('Alex Johnson', NULL, 5, '2023-12-15', 'The Honor of Kings hack is incredible! I''ve been using it for months and it''s still undetected. The drone view feature gives me a huge advantage in battle.', 'Honor of Kings Pro Hack'),
('Sarah Miller', NULL, 4, '2023-12-10', 'Great hack with excellent features. The ESP is very accurate and helps me spot enemies easily. Customer support is also very responsive.', 'Honor of Kings ESP Hack'),
('Mike Chen', NULL, 5, '2023-12-05', 'Best hack I''ve ever used! The aimbot is incredibly smooth and the auto headshot feature is a game-changer. Highly recommend to anyone looking to dominate.', 'Honor of Kings Aimbot'),
('Emma Wilson', NULL, 4, '2023-11-28', 'This hack has significantly improved my gameplay. The aim assist is very natural and doesn''t feel robotic at all.', 'Honor of Kings Aimbot'),
('David Kim', NULL, 5, '2023-11-20', 'The anti-ban system is excellent. I''ve been using this for over 2 months without any issues. Very satisfied with the purchase.', 'Honor of Kings Anti-Ban'),
('Jessica Brown', NULL, 3, '2023-11-15', 'Good overall but had some issues with mobile compatibility. The desktop version works perfectly though.', 'Honor of Kings Mobile Support');
