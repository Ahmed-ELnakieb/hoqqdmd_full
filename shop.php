<?php
// Set page title and description for SEO
$page_title = "Store - HOK Gaming Tools";
$page_description = "Premium HOK gaming tools and cheats with instant delivery. Contact us via Telegram or WhatsApp for purchase.";

// Include database connection
require_once 'config/database.php';

// Connect to database
$conn = connectDB();

// Fetch product types - ALL TITLES ARE DYNAMIC FROM DATABASE
$productTypesQuery = "SELECT * FROM product_types WHERE is_active = 1 ORDER BY sort_order";
$productTypesResult = mysqli_query($conn, $productTypesQuery);
$productTypes = [];
while ($row = mysqli_fetch_assoc($productTypesResult)) {
    $productTypes[] = $row;
}

// Fetch all products with their types
$productsQuery = "
    SELECT sp.*, pt.name as type_name, pt.display_name as type_display_name 
    FROM shop_products sp 
    JOIN product_types pt ON sp.type_id = pt.id 
    WHERE sp.is_active = 1 
    ORDER BY pt.sort_order, sp.sort_order
";
$productsResult = mysqli_query($conn, $productsQuery);
$products = [];
while ($row = mysqli_fetch_assoc($productsResult)) {
    $products[] = $row;
}

// Group products by type
$productsByType = [];
foreach ($products as $product) {
    $typeName = $product['type_name'];
    if (!isset($productsByType[$typeName])) {
        $productsByType[$typeName] = [];
    }
    $productsByType[$typeName][] = $product;
}

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
                <?php foreach ($productTypes as $index => $type): ?>
                    <button class="toggle-btn <?php echo $index === 0 ? 'active' : ''; ?>" onclick="showProductType('<?php echo $type['name']; ?>')">
                        <?php echo htmlspecialchars($type['display_name']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php foreach ($productTypes as $index => $type): ?>
<!-- <?php echo $type['display_name']; ?> Plans -->
<div class="pricing-container" id="<?php echo $type['name']; ?>-plans" style="<?php echo $index === 0 ? '' : 'display: none;'; ?>">
    <div class="pricing-grid">
        <?php if (isset($productsByType[$type['name']])): ?>
            <?php foreach ($productsByType[$type['name']] as $product): ?>
                <div class="pricing-card <?php echo $product['is_popular'] ? 'popular' : ''; ?>">
                    <?php if ($product['badge']): ?>
                        <div class="plan-badge"><?php echo htmlspecialchars($product['badge']); ?></div>
                    <?php endif; ?>
                    
                    <h3 class="plan-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <div class="plan-price">
                        <span class="plan-price-new">$<?php echo number_format($product['price_usd'], 0); ?></span>
                    </div>
                    <div class="plan-period">or <?php echo number_format($product['price_brl'], 0); ?> BRL</div>
                    <p class="plan-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    
                    <ul class="features-list">
                        <?php 
                        $features = explode('|', $product['features']);
                        foreach ($features as $feature): 
                        ?>
                            <li><span class="check">✓</span> <?php echo htmlspecialchars(trim($feature)); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <button class="plan-button <?php echo $product['is_popular'] ? 'primary' : 'secondary'; ?>" 
                            onclick="openContactModal('<?php echo $type['name']; ?>-<?php echo $product['id']; ?>')">
                        <?php 
                        if (strpos($product['name'], 'Update') !== false) {
                            echo 'Contact for Update';
                        } else {
                            echo 'Buy ' . $product['period'];
                        }
                        ?>
                    </button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

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
    document.querySelectorAll('.pricing-container').forEach(container => {
        if (container.id && container.id.includes('-plans')) {
            container.style.display = 'none';
        }
    });
    
    // Show selected product section
    const targetSection = document.getElementById(type + '-plans');
    if (targetSection) {
        targetSection.style.display = 'block';
    }
    
    console.log('Switched to:', type);
}

function openContactModal(productPlan) {
    const modal = document.getElementById('contactModal');
    const telegramLink = document.getElementById('modal-telegram-link');
    const whatsappLink = document.getElementById('modal-whatsapp-link');
    
    // Get product details from the clicked button's data attributes or from DOM
    const button = event.target;
    const card = button.closest('.pricing-card');
    
    if (!card) return;
    
    const hackType = card.querySelector('.plan-title').textContent.split(' - ')[0];
    const period = card.querySelector('.plan-period').textContent.replace('or ', '').replace(' BRL', '');
    const price = card.querySelector('.plan-price-new').textContent;
    const featuresList = card.querySelectorAll('.features-list li');
    
    let features = '';
    featuresList.forEach((item, index) => {
        const featureText = item.textContent.replace('✓ ', '');
        features += featureText;
        if (index < featuresList.length - 1) features += ', ';
    });
    
    // Create detailed message
    const message = `🎮 Hello! I want to subscribe to HOK Hack!

📋 Plan Details:
• Hack Type: ${hackType}
• Period: ${period}
• Price: ${price} or ${period.includes('BRL') ? period : price.replace('$', '') + ' BRL'}

✨ Features:
${features}

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
// Close database connection
mysqli_close($conn);

// Include footer
require_once 'includes/footer.php';
?>