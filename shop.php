<?php
// Set page title and description for SEO
$page_title = "Store - HOK Gaming Tools";
$page_description = "Premium HOK gaming tools and cheats with instant delivery. Contact us via Telegram or WhatsApp for purchase.";

// Include header
require_once 'includes/header.php';

?>

<style>
/* Store-specific styles */
.store-hero {
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('img/bg/header_background.jpg');
    background-size: cover;
    background-position: center;
    padding: 150px 0 100px;
    text-align: center;
    position: relative;
}

.store-hero-content {
    position: relative;
    z-index: 2;
}

.store-hero h1 {
    font-size: 48px;
    color: #c8ff0b;
    margin-bottom: 20px;
    text-transform: uppercase;
    font-weight: 700;
}

.store-hero p {
    font-size: 18px;
    color: #aaa;
    max-width: 600px;
    margin: 0 auto 30px;
}

.products-section {
    padding: 80px 0;
    background: #0a0a0a;
}

.product-section {
    margin-bottom: 30px;
}

.product-section-header {
    background: linear-gradient(135deg, rgba(31, 32, 41, 0.95), rgba(20, 21, 30, 0.9));
    border: 2px solid #1a1b24;
    border-radius: 15px;
    padding: 25px 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.product-section-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #00d4ff, #0099cc);
}

.product-section-header:hover {
    border-color: #c8ff0b;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(200, 255, 11, 0.2);
}

.product-section-header.active {
    border-color: #c8ff0b;
    box-shadow: 0 5px 15px rgba(200, 255, 11, 0.3);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 28px;
    color: #fff;
    font-weight: 700;
    margin: 0;
}

.section-title i {
    color: #c8ff0b;
    font-size: 32px;
}

.section-badge {
    background: linear-gradient(135deg, #c8ff0b, #a6d409);
    color: #000;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    margin-left: 15px;
}

.toggle-icon {
    color: #c8ff0b;
    font-size: 20px;
    transition: transform 0.3s ease;
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}

.product-content {
    margin-top: 20px;
    transition: all 0.3s ease;
}

.product-card {
    background: linear-gradient(135deg, rgba(31, 32, 41, 0.95), rgba(20, 21, 30, 0.9));
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    border: 2px solid #1a1b24;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #00d4ff, #0099cc);
}

.product-card:hover {
    transform: translateY(-10px);
    border-color: #c8ff0b;
    box-shadow: 0 20px 60px rgba(200, 255, 11, 0.3);
}

.product-header {
    text-align: center;
    margin-bottom: 30px;
}

.product-title {
    font-size: 32px;
    color: #c8ff0b;
    margin-bottom: 10px;
    font-weight: 700;
}

.product-badge {
    display: inline-block;
    background: linear-gradient(135deg, #c8ff0b, #a6d409);
    color: #000;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.product-description {
    color: #aaa;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
    text-align: center;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.feature-item {
    background: rgba(0,0,0,0.3);
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #333;
    transition: all 0.3s;
}

.feature-item:hover {
    border-color: #c8ff0b;
    background: rgba(200, 255, 11, 0.05);
}

.feature-item i {
    color: #c8ff0b;
    font-size: 24px;
    margin-bottom: 15px;
}

.feature-item h4 {
    color: #fff;
    font-size: 18px;
    margin-bottom: 10px;
}

.feature-item p {
    color: #888;
    font-size: 14px;
    margin: 0;
}

.pricing-section {
    background: rgba(0,0,0,0.4);
    border-radius: 15px;
    padding: 30px;
    margin-top: 30px;
}

.pricing-title {
    color: #fff;
    font-size: 24px;
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.price-card {
    background: rgba(31, 32, 41, 0.95);
    border: 2px solid #333;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    position: relative;
    transition: all 0.3s;
}

.price-card:hover {
    border-color: #c8ff0b;
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(200, 255, 11, 0.2);
}

.price-card.popular {
    border-color: #c8ff0b;
    background: linear-gradient(135deg, rgba(200, 255, 11, 0.1), rgba(31, 32, 41, 0.95));
}

.price-card.popular::before {
    content: 'RECOMMENDED';
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: #c8ff0b;
    color: #000;
    padding: 5px 20px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 700;
}

.price-period {
    color: #888;
    font-size: 16px;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 1px;
}

.price-amount {
    font-size: 36px;
    color: #c8ff0b;
    font-weight: 700;
    margin-bottom: 10px;
}

.price-currency {
    color: #aaa;
    font-size: 18px;
    margin-bottom: 20px;
}

.price-features {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
}

.price-features li {
    color: #aaa;
    padding: 8px 0;
    border-bottom: 1px solid #333;
}

.price-features li:last-child {
    border-bottom: none;
}

.buy-button {
    background: linear-gradient(135deg, #c8ff0b, #a6d409);
    color: #000;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    text-decoration: none;
    display: inline-block;
}

.buy-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(200, 255, 11, 0.4);
    color: #000;
    text-decoration: none;
}

.contact-section {
    background: linear-gradient(135deg, rgba(200, 255, 11, 0.1), rgba(31, 32, 41, 0.9));
    border-radius: 15px;
    padding: 40px;
    margin-top: 50px;
    text-align: center;
}

.contact-title {
    color: #c8ff0b;
    font-size: 28px;
    margin-bottom: 20px;
}

.contact-description {
    color: #aaa;
    font-size: 16px;
    margin-bottom: 30px;
}

.contact-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: #fff;
    padding: 15px 30px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.contact-btn.telegram {
    background: linear-gradient(135deg, #0088cc, #006bb3);
}

.contact-btn.youtube {
    background: linear-gradient(135deg, #ff0000, #cc0000);
}

.contact-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    color: #fff;
    text-decoration: none;
}

.security-badges {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid #333;
    flex-wrap: wrap;
}

.security-badge {
    text-align: center;
    color: #888;
}

.security-badge i {
    font-size: 32px;
    color: #c8ff0b;
    margin-bottom: 10px;
    display: block;
}

.security-badge h4 {
    color: #fff;
    font-size: 16px;
    margin-bottom: 5px;
}

.security-badge p {
    font-size: 12px;
    margin: 0;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: #1f2029;
    border-radius: 15px;
    padding: 40px;
    max-width: 500px;
    width: 90%;
    text-align: center;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    color: #888;
    font-size: 24px;
    cursor: pointer;
}

.modal-close:hover {
    color: #fff;
}

@media (max-width: 768px) {
    .store-hero h1 {
        font-size: 32px;
    }
    
    .product-card {
        padding: 20px;
    }
    
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .security-badges {
        flex-direction: column;
        gap: 20px;
    }
}
</style>

<!-- Store Hero Section -->
<section class="store-hero">
    <div class="container">
        <div class="store-hero-content">
            <h1>HOK Premium Tools</h1>
            <p>Professional gaming tools for Honor of Kings with instant delivery and 24/7 support</p>
            <div class="contact-buttons">
                <a href="https://t.me/hoqqdmdhack" class="contact-btn telegram" target="_blank">
                    <i class="fab fa-telegram"></i> Contact via Telegram
                </a>
                <a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" class="contact-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contact via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section">
    <div class="container">
        
        <!-- Product 1: Drone View Only -->
        <div class="product-section">
            <div class="product-section-header" onclick="toggleSection('drone-view')">
                <h2 class="section-title">
                    <i class="fas fa-eye"></i>
                    Drone View Separately
                    <span class="section-badge">Season Based</span>
                </h2>
                <i class="fas fa-chevron-down toggle-icon" id="drone-view-icon"></i>
            </div>
            
            <div class="product-content" id="drone-view-content" style="display: block;">
                <div class="product-card">
                    <div class="product-header">
                        <p class="product-description">Get the drone view feature separately. Pay once initially, then 70% of the amount at each season restart or major game update.</p>
                    </div>
                    
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-eye"></i>
                            <h4>Drone View</h4>
                            <p>Full aerial perspective of the battlefield</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-sync-alt"></i>
                            <h4>Season Updates</h4>
                            <p>Automatic updates for new seasons</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <h4>Secure & Safe</h4>
                            <p>Undetectable and regularly updated</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-headset"></i>
                            <h4>24/7 Support</h4>
                            <p>Round-the-clock customer assistance</p>
                        </div>
                    </div>
                    
                    <div class="pricing-section">
                        <h3 class="pricing-title">Drone View Pricing - Season Based</h3>
                        <div class="pricing-grid">
                            <div class="price-card popular">
                                <div class="price-period">Initial Payment</div>
                                <div class="price-amount">$10</div>
                                <div class="price-currency">or 50 BRL</div>
                                <ul class="price-features">
                                    <li>Full drone view access</li>
                                    <li>Instant activation</li>
                                    <li>Setup assistance</li>
                                    <li>First-time purchase</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('drone-initial')">Buy Now</a>
                            </div>
                            <div class="price-card">
                                <div class="price-period">Season Updates</div>
                                <div class="price-amount">$7</div>
                                <div class="price-currency">or 35 BRL (70% of initial)</div>
                                <ul class="price-features">
                                    <li>Each season restart</li>
                                    <li>Major game updates</li>
                                    <li>Continued support</li>
                                    <li>Renewal pricing</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('drone-update')">Contact for Update</a>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 20px; padding: 15px; background: rgba(200, 255, 11, 0.1); border-radius: 10px; border: 1px solid rgba(200, 255, 11, 0.3);">
                            <p style="color: #c8ff0b; font-weight: 600; margin: 0;">
                                <i class="fas fa-info-circle"></i> 
                                Pay once initially, then 70% of that amount at each season restart or major game update
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product 2: Drone + Smart Skill + Skin -->
        <div class="product-section">
            <div class="product-section-header" onclick="toggleSection('combo-package')">
                <h2 class="section-title">
                    <i class="fas fa-cube"></i>
                    Drone View + Smart Skill + Skin Unlocker + 3D
                    <span class="section-badge">Most Popular</span>
                </h2>
                <i class="fas fa-chevron-down toggle-icon" id="combo-package-icon"></i>
            </div>
            
            <div class="product-content" id="combo-package-content" style="display: none;">
                <div class="product-card">
                    <div class="product-header">
                        <p class="product-description">Complete package with drone view, smart skill assistance, skin unlocker, and 3D features.</p>
                    </div>
                    
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-eye"></i>
                            <h4>Drone View</h4>
                            <p>Full aerial battlefield perspective</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-brain"></i>
                            <h4>Smart Skills</h4>
                            <p>AI-assisted skill optimization</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-palette"></i>
                            <h4>Skin Unlocker</h4>
                            <p>Access to all premium skins</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-cube"></i>
                            <h4>3D Features</h4>
                            <p>Enhanced 3D visual elements</p>
                        </div>
                    </div>
                    
                    <div class="pricing-section">
                        <h3 class="pricing-title">Choose Your Plan</h3>
                        <div class="pricing-grid">
                            <div class="price-card">
                                <div class="price-period">3 Days</div>
                                <div class="price-amount">$4</div>
                                <div class="price-currency">or 25 BRL</div>
                                <ul class="price-features">
                                    <li>All features included</li>
                                    <li>Perfect for testing</li>
                                    <li>Instant activation</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('combo-3d')">Buy 3 Days</a>
                            </div>
                            <div class="price-card">
                                <div class="price-period">7 Days</div>
                                <div class="price-amount">$10</div>
                                <div class="price-currency">or 60 BRL</div>
                                <ul class="price-features">
                                    <li>All features included</li>
                                    <li>Best value for week</li>
                                    <li>Priority support</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('combo-7d')">Buy 7 Days</a>
                            </div>
                            <div class="price-card popular">
                                <div class="price-period">30 Days</div>
                                <div class="price-amount">$20</div>
                                <div class="price-currency">or 100 BRL</div>
                                <ul class="price-features">
                                    <li>All features included</li>
                                    <li>Best value per day</li>
                                    <li>VIP support</li>
                                    <li>Free minor updates</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('combo-30d')">Buy 30 Days</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product 3: Complete Mod Menu -->
        <div class="product-section">
            <div class="product-section-header" onclick="toggleSection('complete-menu')">
                <h2 class="section-title">
                    <i class="fas fa-cogs"></i>
                    Complete Mod Menu + Map Hack + All Functions
                    <span class="section-badge">Professional</span>
                </h2>
                <i class="fas fa-chevron-down toggle-icon" id="complete-menu-icon"></i>
            </div>
            
            <div class="product-content" id="complete-menu-content" style="display: none;">
                <div class="product-card">
                    <div class="product-header">
                        <p class="product-description">The ultimate gaming experience with complete mod menu, map hack, drone view, and all advanced functions. Use the same pricing as Map Hack.</p>
                    </div>
                    
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-map"></i>
                            <h4>Map Hack</h4>
                            <p>Complete map visibility and awareness</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-eye"></i>
                            <h4>Drone View</h4>
                            <p>Aerial battlefield perspective</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-cogs"></i>
                            <h4>Complete Mod Menu</h4>
                            <p>Full access to all modification features</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-crown"></i>
                            <h4>All Functions</h4>
                            <p>Every feature available in one package</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-clock"></i>
                            <h4>Jungle Timers</h4>
                            <p>Automatic jungle spawn timers</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-crosshairs"></i>
                            <h4>ESP Functions</h4>
                            <p>Enemy tracking and positioning</p>
                        </div>
                    </div>
                    
                    <div class="pricing-section">
                        <h3 class="pricing-title">Complete Package Plans</h3>
                        <div class="pricing-grid">
                            <div class="price-card">
                                <div class="price-period">3 Days</div>
                                <div class="price-amount">$5</div>
                                <div class="price-currency">or 30 BRL</div>
                                <ul class="price-features">
                                    <li>Complete mod menu</li>
                                    <li>All advanced features</li>
                                    <li>Professional support</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('complete-3d')">Buy 3 Days</a>
                            </div>
                            <div class="price-card">
                                <div class="price-period">7 Days</div>
                                <div class="price-amount">$10</div>
                                <div class="price-currency">or 65 BRL</div>
                                <ul class="price-features">
                                    <li>Complete mod menu</li>
                                    <li>All advanced features</li>
                                    <li>Priority support</li>
                                    <li>Custom configurations</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('complete-7d')">Buy 7 Days</a>
                            </div>
                            <div class="price-card">
                                <div class="price-period">14 Days</div>
                                <div class="price-amount">$14</div>
                                <div class="price-currency">or 100 BRL</div>
                                <ul class="price-features">
                                    <li>Complete mod menu</li>
                                    <li>All advanced features</li>
                                    <li>VIP support</li>
                                    <li>Free minor updates</li>
                                    <li>Custom setup</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('complete-14d')">Buy 14 Days</a>
                            </div>
                            <div class="price-card">
                                <div class="price-period">24 Days</div>
                                <div class="price-amount">$25</div>
                                <div class="price-currency">or 160 BRL</div>
                                <ul class="price-features">
                                    <li>Complete mod menu</li>
                                    <li>All advanced features</li>
                                    <li>Premium VIP support</li>
                                    <li>All features unlocked</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('complete-24d')">Buy 24 Days</a>
                            </div>
                            <div class="price-card popular">
                                <div class="price-period">31 Days</div>
                                <div class="price-amount">$30</div>
                                <div class="price-currency">or 185 BRL</div>
                                <ul class="price-features">
                                    <li>Complete mod menu</li>
                                    <li>All advanced features</li>
                                    <li>Premium VIP support</li>
                                    <li>All updates included</li>
                                    <li>Personal assistance</li>
                                    <li>Best value</li>
                                </ul>
                                <a href="#" class="buy-button" onclick="openContactModal('complete-31d')">Buy 31 Days</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h2 class="contact-title">Ready to Get Started?</h2>
            <p class="contact-description">Contact us directly via Telegram, WhatsApp, or check out our YouTube channel for instant purchase and activation. Our team is available 24/7 to assist you.</p>
            <div class="contact-buttons">
                <a href="https://t.me/hoqqdmdhack" class="contact-btn telegram" target="_blank">
                    <i class="fab fa-telegram"></i> @hoqqdmdhack on Telegram
                </a>
                <a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" class="contact-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i> WhatsApp Group
                </a>
                <a href="https://youtube.com/@hoqqdmd?si=v52Z_8aKJiy-ICiA" class="contact-btn youtube" target="_blank">
                    <i class="fab fa-youtube"></i> @hoqqdmd on YouTube
                </a>
            </div>
        </div>

        <!-- Security Badges -->
        <div class="security-badges">
            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <h4>Secure Payment</h4>
                <p>Safe and encrypted transactions</p>
            </div>
            <div class="security-badge">
                <i class="fas fa-clock"></i>
                <h4>Instant Delivery</h4>
                <p>Immediate activation after payment</p>
            </div>
            <div class="security-badge">
                <i class="fas fa-headset"></i>
                <h4>24/7 Support</h4>
                <p>Round-the-clock assistance</p>
            </div>
            <div class="security-badge">
                <i class="fas fa-sync-alt"></i>
                <h4>Regular Updates</h4>
                <p>Always up-to-date features</p>
            </div>
            <div class="security-badge">
                <i class="fas fa-user-shield"></i>
                <h4>Privacy Protected</h4>
                <p>Your data is completely safe</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Modal -->
<div id="contactModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeContactModal()">&times;</button>
        <h2 style="color: #c8ff0b; margin-bottom: 20px;">Contact for Purchase</h2>
        <p style="color: #aaa; margin-bottom: 30px;">Choose your preferred contact method to complete your purchase:</p>
        
        <div class="contact-buttons">
            <a href="https://t.me/hoqqdmdhack" id="modal-telegram-link" class="contact-btn telegram" target="_blank">
                <i class="fab fa-telegram"></i> Contact via Telegram
            </a>
            <a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" id="modal-whatsapp-link" class="contact-btn" target="_blank">
                <i class="fab fa-whatsapp"></i> Contact via WhatsApp
            </a>
        </div>
        
        <p style="color: #888; font-size: 14px; margin-top: 20px;">Mention the product and plan you want when contacting us!</p>
    </div>
</div>

<script>
function openContactModal(productPlan) {
    const modal = document.getElementById('contactModal');
    const telegramLink = document.getElementById('modal-telegram-link');
    const whatsappLink = document.getElementById('modal-whatsapp-link');
    
    // Create product-specific messages
    const productNames = {
        'drone-initial': 'Drone View (Initial Payment)',
        'drone-update': 'Drone View (Season Update)',
        'combo-3d': 'Drone + Smart Skill + Skin (3 Days)',
        'combo-7d': 'Drone + Smart Skill + Skin (7 Days)',
        'combo-30d': 'Drone + Smart Skill + Skin (30 Days)',
        'complete-3d': 'Complete Mod Menu (3 Days)',
        'complete-7d': 'Complete Mod Menu (7 Days)',
        'complete-14d': 'Complete Mod Menu (14 Days)',
        'complete-24d': 'Complete Mod Menu (24 Days)',
        'complete-31d': 'Complete Mod Menu (31 Days)'
    };
    
    const productName = productNames[productPlan] || 'HOK Gaming Tools';
    const message = `Hello! I'm interested in purchasing the '${productName}' plan. Can you please help me with the purchase process?`;
    
    // Update contact links with pre-filled messages
    const telegramMessage = encodeURIComponent(message);
    const whatsappMessage = encodeURIComponent(message);
    
    telegramLink.href = `https://t.me/hoqqdmdhack?text=${telegramMessage}`;
    whatsappLink.href = `https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo`; // WhatsApp groups don't support pre-filled text
    
    modal.classList.add('active');
    
    console.log('Selected plan:', productPlan, 'Message:', message);
}

function closeContactModal() {
    const modal = document.getElementById('contactModal');
    modal.classList.remove('active');
}

// Close modal when clicking outside
document.getElementById('contactModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeContactModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});

// Toggle section functionality
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId + '-content');
    const icon = document.getElementById(sectionId + '-icon');
    const header = content.previousElementSibling;
    
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        icon.classList.add('rotated');
        header.classList.add('active');
    } else {
        content.style.display = 'none';
        icon.classList.remove('rotated');
        header.classList.remove('active');
    }
}

// Initialize page with drone view section open
document.addEventListener('DOMContentLoaded', function() {
    // Set drone view section as active by default
    const droneContent = document.getElementById('drone-view-content');
    const droneIcon = document.getElementById('drone-view-icon');
    const droneHeader = document.querySelector('[onclick="toggleSection(\'drone-view\')"]');
    
    if (droneContent && droneIcon && droneHeader) {
        droneContent.style.display = 'block';
        droneIcon.classList.add('rotated');
        droneHeader.classList.add('active');
    }
});
</script>

<?php
// Include footer
require_once 'includes/footer.php';
?>