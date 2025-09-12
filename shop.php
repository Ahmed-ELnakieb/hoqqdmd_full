<?php
// Set page title and description for SEO
$page_title = "Store - HOK Gaming Tools";
$page_description = "Premium HOK gaming tools and cheats with instant delivery. Contact us via Telegram or WhatsApp for purchase.";

// Include header
require_once 'includes/header.php';

?>

<style>
/* Simple Clean Pricing Page Styles */
body {
    background: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    line-height: 1.6;
}

main {
    margin-bottom: 90px;
}

.page-header {
    background: #fff;
    padding: 40px 0;
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 60px;
}

.page-title {
    font-size: 48px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.page-subtitle {
    font-size: 18px;
    color: #666;
    text-align: center;
    max-width: 600px;
    margin: 0 auto 40px;
}

.billing-toggle {
    display: flex;
    justify-content: center;
    margin-bottom: 60px;
}

.toggle-container {
    background: #e9ecef;
    border-radius: 25px;
    padding: 4px;
    display: inline-flex;
}

.toggle-btn {
    background: transparent;
    border: none;
    padding: 12px 24px;
    border-radius: 20px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #666;
}

.toggle-btn.active {
    background: #333;
    color: #fff;
}

.pricing-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-bottom: 80px;
}

.pricing-card {
    background: #fff;
    border-radius: 16px;
    padding: 40px;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.pricing-card.popular {
    border-color: #00d4ff;
    transform: scale(1.05);
}

.pricing-card.popular::before {
    content: 'RECOMMENDED';
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: #00d4ff;
    color: #fff;
    padding: 6px 20px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.plan-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #ffa726;
    color: #fff;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.plan-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.plan-price {
    font-size: 48px;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
}

.plan-price-old {
    font-size: 32px;
    color: #999;
    text-decoration: line-through;
    margin-right: 10px;
}

.plan-price-new {
    color: #00d4ff;
}

.plan-period {
    color: #666;
    font-size: 16px;
    margin-bottom: 20px;
}

.plan-description {
    color: #666;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.5;
}

.features-list {
    list-style: none;
    padding: 0;
    margin-bottom: 40px;
    text-align: left;
    flex-grow: 1;
}

.features-list li {
    padding: 8px 0;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.features-list li .check {
    color: #4caf50;
    margin-right: 12px;
    font-weight: bold;
}

.features-list li .cross {
    color: #ccc;
    margin-right: 12px;
    font-weight: bold;
}

.plan-button {
    width: 100%;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    margin-top: auto;
}

.plan-button.primary {
    background: #00d4ff;
    color: #fff;
}

.plan-button.primary:hover {
    background: #0099cc;
    transform: translateY(-2px);
}

.plan-button.secondary {
    background: #f8f9fa;
    color: #333;
    border: 1px solid #e9ecef;
}

.plan-button.secondary:hover {
    background: #e9ecef;
}

.contact-section {
    background: #fff;
    border-radius: 16px;
    padding: 60px 40px;
    text-align: center;
    margin-top: 80px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.contact-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

.contact-description {
    font-size: 18px;
    color: #666;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
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
    padding: 15px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    color: #fff;
}

.contact-btn.telegram {
    background: #0088cc;
}

.contact-btn.whatsapp {
    background: #25d366;
}

.contact-btn.youtube {
    background: #ff0000;
}

.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    color: #fff;
    text-decoration: none;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 36px;
    }
    
    .pricing-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .pricing-card.popular {
        transform: none;
    }
    
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .contact-btn {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Pricing</h1>
        <p class="page-subtitle">Choose the perfect plan for your Honor of kings Hack. All plans include instant activation and 24/7 support.</p>
        
        <!-- Product Type Toggle -->
        <div class="billing-toggle">
            <div class="toggle-container">
                <button class="toggle-btn active" onclick="showProductType('drone')">Drone View</button>
                <button class="toggle-btn" onclick="showProductType('map')">Map Hack</button>
                <button class="toggle-btn" onclick="showProductType('full')">Full Mod Menu</button>
            </div>
        </div>
    </div>
</div>

<!-- Drone View Plans -->
<div class="pricing-container" id="drone-plans">
    <div class="pricing-grid">
        <!-- Drone View Initial -->
        <div class="pricing-card popular">
            <div class="plan-badge">Initial Payment</div>
            <h3 class="plan-title">Drone View - Initial</h3>
            <div class="plan-price">
                <span class="plan-price-new">$10</span>
            </div>
            <div class="plan-period">or 50 BRL</div>
            <p class="plan-description">Get the drone view feature separately. Pay once initially, then 70% of the amount at each season restart.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Full drone view access</li>
                <li><span class="check">✓</span> Instant activation</li>
                <li><span class="check">✓</span> Setup assistance</li>
                <li><span class="check">✓</span> 24/7 support</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('drone-initial')">Buy Now</button>
        </div>

        <!-- Drone View Season Update -->
        <div class="pricing-card">
            <div class="plan-badge">Season Update</div>
            <h3 class="plan-title">Drone View - Update</h3>
            <div class="plan-price">
                <span class="plan-price-new">$7</span>
            </div>
            <div class="plan-period">or 35 BRL (70% of initial)</div>
            <p class="plan-description">Renewal pricing for each season restart or major game update.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Each season restart</li>
                <li><span class="check">✓</span> Major game updates</li>
                <li><span class="check">✓</span> Continued support</li>
                <li><span class="check">✓</span> Renewal pricing</li>
            </ul>
            
            <button class="plan-button secondary" onclick="openContactModal('drone-update')">Contact for Update</button>
        </div>
    </div>
</div>

<!-- Map Hack Plans -->
<div class="pricing-container" id="map-plans" style="display: none;">
    <div class="pricing-grid">
        <!-- Map Hack 3 Days -->
        <div class="pricing-card">
            <div class="plan-badge">Trial</div>
            <h3 class="plan-title">Map Hack - 3 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$5</span>
            </div>
            <div class="plan-period">or 30 BRL</div>
            <p class="plan-description">Perfect for testing the map hack features with full functionality.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete map visibility</li>
                <li><span class="check">✓</span> Enemy tracking</li>
                <li><span class="check">✓</span> Instant activation</li>
                <li><span class="check">✓</span> Professional support</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('map-3d')">Buy 3 Days</button>
        </div>

        <!-- Map Hack 7 Days -->
        <div class="pricing-card popular">
            <div class="plan-badge">Popular</div>
            <h3 class="plan-title">Map Hack - 7 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$10</span>
            </div>
            <div class="plan-period">or 65 BRL</div>
            <p class="plan-description">Best value for a week of enhanced gameplay with map hack features.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete map visibility</li>
                <li><span class="check">✓</span> Enemy tracking</li>
                <li><span class="check">✓</span> Priority support</li>
                <li><span class="check">✓</span> Custom configurations</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('map-7d')">Buy 7 Days</button>
        </div>

        <!-- Map Hack 14 Days -->
        <div class="pricing-card">
            <div class="plan-badge">Extended</div>
            <h3 class="plan-title">Map Hack - 14 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$14</span>
            </div>
            <div class="plan-period">or 100 BRL</div>
            <p class="plan-description">Extended access to map hack features with VIP support and custom setup.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete map visibility</li>
                <li><span class="check">✓</span> Enemy tracking</li>
                <li><span class="check">✓</span> VIP support</li>
                <li><span class="check">✓</span> Custom setup</li>
                <li><span class="check">✓</span> Free minor updates</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('map-14d')">Buy 14 Days</button>
        </div>
    </div>
</div>

<!-- Full Mod Menu Plans -->
<div class="pricing-container" id="full-plans" style="display: none;">
    <div class="pricing-grid">
        <!-- Full Mod 3 Days -->
        <div class="pricing-card">
            <div class="plan-badge">Trial</div>
            <h3 class="plan-title">Full Mod Menu - 3 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$5</span>
            </div>
            <div class="plan-period">or 30 BRL</div>
            <p class="plan-description">Test all features with complete mod menu, map hack, drone view, and advanced functions.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete mod menu</li>
                <li><span class="check">✓</span> Map hack</li>
                <li><span class="check">✓</span> Drone view</li>
                <li><span class="check">✓</span> All advanced features</li>
                <li><span class="check">✓</span> Professional support</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('full-3d')">Buy 3 Days</button>
        </div>

        <!-- Full Mod 7 Days -->
        <div class="pricing-card">
            <div class="plan-badge">Weekly</div>
            <h3 class="plan-title">Full Mod Menu - 7 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$10</span>
            </div>
            <div class="plan-period">or 65 BRL</div>
            <p class="plan-description">Weekly access to all premium features with priority support and custom configurations.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete mod menu</li>
                <li><span class="check">✓</span> All advanced features</li>
                <li><span class="check">✓</span> Priority support</li>
                <li><span class="check">✓</span> Custom configurations</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('full-7d')">Buy 7 Days</button>
        </div>

        <!-- Full Mod 31 Days -->
        <div class="pricing-card popular">
            <div class="plan-badge">Best Value</div>
            <h3 class="plan-title">Full Mod Menu - 31 Days</h3>
            <div class="plan-price">
                <span class="plan-price-new">$30</span>
            </div>
            <div class="plan-period">or 185 BRL</div>
            <p class="plan-description">Ultimate gaming experience with all features, premium VIP support, and personal assistance.</p>
            
            <ul class="features-list">
                <li><span class="check">✓</span> Complete mod menu</li>
                <li><span class="check">✓</span> All advanced features</li>
                <li><span class="check">✓</span> Premium VIP support</li>
                <li><span class="check">✓</span> All updates included</li>
                <li><span class="check">✓</span> Personal assistance</li>
                <li><span class="check">✓</span> Best value</li>
            </ul>
            
            <button class="plan-button primary" onclick="openContactModal('full-31d')">Buy 31 Days</button>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="pricing-container">
    <div class="contact-section">
        <h2 class="contact-title">Ready to Get Started?</h2>
        <p class="contact-description">Contact us directly via Telegram, WhatsApp, or check out our YouTube channel for instant purchase and activation.</p>
        
        <div class="contact-buttons">
            <a href="https://t.me/hoqqdmdhack" class="contact-btn telegram" target="_blank">
                <i class="fab fa-telegram"></i> @hoqqdmdhack on Telegram
            </a>
            <a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" class="contact-btn whatsapp" target="_blank">
                <i class="fab fa-whatsapp"></i> WhatsApp Group
            </a>
            <a href="https://youtube.com/@hoqqdmd?si=v52Z_8aKJiy-ICiA" class="contact-btn youtube" target="_blank">
                <i class="fab fa-youtube"></i> @hoqqdmd on YouTube
            </a>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div id="contactModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center;">
    <div class="modal-content" style="background: #fff; border-radius: 15px; padding: 40px; max-width: 500px; width: 90%; text-align: center; position: relative;">
        <button class="modal-close" onclick="closeContactModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #888; font-size: 24px; cursor: pointer;">&times;</button>
        <h2 style="color: #00d4ff; margin-bottom: 20px;">Contact for Purchase</h2>
        <p style="color: #666; margin-bottom: 30px;">Choose your preferred contact method to complete your purchase:</p>
        
        <div class="contact-buttons">
            <a href="https://t.me/hoqqdmdhack" id="modal-telegram-link" class="contact-btn telegram" target="_blank">
                <i class="fab fa-telegram"></i> Contact via Telegram
            </a>
            <a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" id="modal-whatsapp-link" class="contact-btn whatsapp" target="_blank">
                <i class="fab fa-whatsapp"></i> Contact via WhatsApp
            </a>
        </div>
        
        <p style="color: #888; font-size: 14px; margin-top: 20px;">Mention the product and plan you want when contacting us!</p>
    </div>
</div>

<script>
function showProductType(type) {
    // Remove active class from all buttons
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Add active class to clicked button
    event.target.classList.add('active');
    
    // Hide all product sections
    document.getElementById('drone-plans').style.display = 'none';
    document.getElementById('map-plans').style.display = 'none';
    document.getElementById('full-plans').style.display = 'none';
    
    // Show selected product section
    if (type === 'drone') {
        document.getElementById('drone-plans').style.display = 'block';
    } else if (type === 'map') {
        document.getElementById('map-plans').style.display = 'block';
    } else if (type === 'full') {
        document.getElementById('full-plans').style.display = 'block';
    }
    
    console.log('Switched to:', type);
}

function openContactModal(productPlan) {
    const modal = document.getElementById('contactModal');
    const telegramLink = document.getElementById('modal-telegram-link');
    const whatsappLink = document.getElementById('modal-whatsapp-link');
    
    // Create detailed product information
    const productDetails = {
        'drone-initial': {
            hackType: 'Drone View',
            period: 'Initial Payment',
            price: '$10 or 50 BRL',
            features: 'Full drone view access, Instant activation, Setup assistance, 24/7 support'
        },
        'drone-update': {
            hackType: 'Drone View',
            period: 'Season Update',
            price: '$7 or 35 BRL (70% of initial)',
            features: 'Each season restart, Major game updates, Continued support, Renewal pricing'
        },
        'map-3d': {
            hackType: 'Map Hack',
            period: '3 Days',
            price: '$5 or 30 BRL',
            features: 'Complete map visibility, Enemy tracking, Instant activation, Professional support'
        },
        'map-7d': {
            hackType: 'Map Hack',
            period: '7 Days',
            price: '$10 or 65 BRL',
            features: 'Complete map visibility, Enemy tracking, Priority support, Custom configurations'
        },
        'map-14d': {
            hackType: 'Map Hack',
            period: '14 Days',
            price: '$14 or 100 BRL',
            features: 'Complete map visibility, Enemy tracking, VIP support, Custom setup, Free minor updates'
        },
        'full-3d': {
            hackType: 'Full Mod Menu',
            period: '3 Days',
            price: '$5 or 30 BRL',
            features: 'Complete mod menu, Map hack, Drone view, All advanced features, Professional support'
        },
        'full-7d': {
            hackType: 'Full Mod Menu',
            period: '7 Days',
            price: '$10 or 65 BRL',
            features: 'Complete mod menu, All advanced features, Priority support, Custom configurations'
        },
        'full-31d': {
            hackType: 'Full Mod Menu',
            period: '31 Days',
            price: '$30 or 185 BRL',
            features: 'Complete mod menu, All advanced features, Premium VIP support, All updates included, Personal assistance, Best value'
        }
    };
    
    const details = productDetails[productPlan];
    if (!details) return;
    
    // Create detailed message
    const message = `🎮 Hello! I want to subscribe to HOK Hack!

📋 Plan Details:
• Hack Type: ${details.hackType}
• Period: ${details.period}
• Price: ${details.price}

✨ Features:
${details.features}

Please help me with the purchase process and activation. Thank you! 🚀`;
    
    // Update contact links with pre-filled messages
    const telegramMessage = encodeURIComponent(message);
    
    telegramLink.href = `https://t.me/hoqqdmdhack?text=${telegramMessage}`;
    whatsappLink.href = `https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo`;
    
    modal.style.display = 'flex';
    
    console.log('Selected plan:', productPlan, 'Message:', message);
}

function closeContactModal() {
    const modal = document.getElementById('contactModal');
    modal.style.display = 'none';
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
</script>

<?php
// Include footer
require_once 'includes/footer.php';
?>