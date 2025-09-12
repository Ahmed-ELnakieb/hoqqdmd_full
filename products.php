<?php
require_once 'config/database.php';

// Get products from database
$database = new Database();
$pdo = $database->getConnection();

// Fetch products with pricing
$stmt = $pdo->prepare("
    SELECT p.*, 
           MIN(pr.price) as min_price,
           MAX(pr.price) as max_price
    FROM products p
    LEFT JOIN pricing pr ON p.id = pr.product_id
    WHERE p.status = 'active' AND pr.is_active = 1
    GROUP BY p.id
");
$stmt->execute();
$products = $stmt->fetchAll();

// Fetch all pricing options
$pricingStmt = $pdo->prepare("
    SELECT * FROM pricing 
    WHERE is_active = 1 
    ORDER BY product_id, 
    FIELD(period, 'day', 'week', 'month', 'year')
");
$pricingStmt->execute();
$allPricing = $pricingStmt->fetchAll();

$pricingByProduct = [];
foreach ($allPricing as $price) {
    $pricingByProduct[$price['product_id']][] = $price;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOK Premium Services - HOQQDMD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: #0a0a0a;
            min-height: 100vh;
        }
        .products-hero {
            background-image: url('img/bg/header_background.jpg');
            background-size: cover;
            background-position: center;
            padding: 150px 0 100px;
            position: relative;
            margin-top: -20px;
        }
        .products-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('img/images/dots.png');
            background-repeat: repeat;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .hero-content h1 {
            font-family: 'Oxanium', cursive;
            font-size: 60px;
            color: #c8ff0b;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        .hero-content p {
            font-size: 20px;
            color: #aaa;
            max-width: 600px;
            margin: 0 auto;
        }
        .products-section {
            padding: 80px 0;
            background: #0f0f0f;
        }
        .product-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 40px;
            border: 2px solid #1a1b24;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .product-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #c8ff0b, #a6d409);
        }
        .product-card:hover {
            transform: translateY(-5px);
            border-color: #c8ff0b;
            box-shadow: 0 10px 40px rgba(200, 255, 11, 0.2);
        }
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
        }
        .product-title {
            flex: 1;
        }
        .product-title h2 {
            font-family: 'Oxanium', cursive;
            color: #c8ff0b;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .product-title .badge {
            background: #c8ff0b;
            color: #000;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .product-description {
            color: #aaa;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .features-list {
            margin-bottom: 40px;
        }
        .features-list h4 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .features-list ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        .features-list li {
            color: #888;
            padding-left: 25px;
            position: relative;
        }
        .features-list li:before {
            content: "✓";
            color: #c8ff0b;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .pricing-section {
            background: rgba(0,0,0,0.3);
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
        }
        .pricing-title {
            color: #fff;
            font-size: 20px;
            margin-bottom: 25px;
            text-align: center;
            text-transform: uppercase;
        }
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .price-box {
            background: rgba(31, 32, 41, 0.95);
            border: 2px solid #333;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }
        .price-box:hover {
            border-color: #c8ff0b;
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(200, 255, 11, 0.3);
        }
        .price-box.popular {
            border-color: #c8ff0b;
        }
        .price-box.popular::before {
            content: "POPULAR";
            position: absolute;
            top: -10px;
            right: 10px;
            background: #c8ff0b;
            color: #000;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 700;
        }
        .price-period {
            color: #888;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .price-amount {
            color: #c8ff0b;
            font-size: 32px;
            font-weight: 700;
            font-family: 'Oxanium', cursive;
        }
        .price-amount small {
            font-size: 16px;
            color: #888;
        }
        .btn-purchase {
            background: #c8ff0b;
            color: #000;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 15px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-purchase:hover {
            background: #a6d409;
            transform: translateY(-2px);
        }
        .security-badges {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            padding-top: 50px;
            border-top: 1px solid #333;
        }
        .security-badge {
            text-align: center;
            color: #888;
        }
        .security-badge i {
            font-size: 32px;
            color: #c8ff0b;
            margin-bottom: 10px;
        }
        .security-badge p {
            font-size: 12px;
            text-transform: uppercase;
            margin: 0;
        }
        .comparison-table {
            margin-top: 60px;
            background: rgba(31, 32, 41, 0.95);
            border-radius: 10px;
            padding: 30px;
        }
        .comparison-table h3 {
            color: #c8ff0b;
            text-align: center;
            margin-bottom: 30px;
        }
        .comparison-table table {
            width: 100%;
            color: #aaa;
        }
        .comparison-table th {
            color: #fff;
            padding: 15px;
            border-bottom: 2px solid #c8ff0b;
        }
        .comparison-table td {
            padding: 15px;
            border-bottom: 1px solid #333;
        }
        .comparison-table .check {
            color: #c8ff0b;
            font-size: 20px;
        }
        .comparison-table .times {
            color: #ff6b6b;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <?php require_once 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="products-hero">
        <div class="hero-content">
            <h1>HOK Premium Services</h1>
            <p>Enhance your Honor of Kings gameplay with our professional tools</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <?php foreach ($products as $product): ?>
                <?php 
                $features = explode('|', $product['features']);
                $productPricing = $pricingByProduct[$product['id']] ?? [];
                ?>
                
                <div class="product-card">
                    <div class="product-header">
                        <div class="product-title">
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <?php if ($product['type'] == 'mapahack_drone'): ?>
                                <span class="badge">Most Advanced</span>
                            <?php else: ?>
                                <span class="badge">Best Value</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <p class="product-description">
                        <?php echo htmlspecialchars($product['description']); ?>
                    </p>
                    
                    <div class="features-list">
                        <h4>Features Included:</h4>
                        <ul>
                            <?php foreach ($features as $feature): ?>
                                <li><?php echo htmlspecialchars(trim($feature)); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="pricing-section">
                        <h3 class="pricing-title">Choose Your Plan</h3>
                        <div class="pricing-grid">
                            <?php foreach ($productPricing as $price): ?>
                                <div class="price-box <?php echo $price['period'] == 'month' ? 'popular' : ''; ?>"
                                     onclick="purchaseProduct(<?php echo $product['id']; ?>, <?php echo $price['id']; ?>)">
                                    <div class="price-period">
                                        <?php echo ucfirst($price['period']); ?>
                                        <?php if ($price['period'] == 'year'): ?>
                                            <small>(Save 30%)</small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="price-amount">
                                        $<?php echo number_format($price['price'], 2); ?>
                                    </div>
                                    <button class="btn-purchase">
                                        Select Plan
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Comparison Table -->
            <div class="comparison-table">
                <h3>Feature Comparison</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>MapaHack + Drone View</th>
                            <th>Drone View + Smart Skill + Skin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Map Hack</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-times times"></i></td>
                        </tr>
                        <tr>
                            <td>Drone View</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>ESP Functions</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-times times"></i></td>
                        </tr>
                        <tr>
                            <td>Jungle Timers</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-times times"></i></td>
                        </tr>
                        <tr>
                            <td>Smart Skills</td>
                            <td class="text-center"><i class="fas fa-times times"></i></td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Skin Unlocker</td>
                            <td class="text-center"><i class="fas fa-times times"></i></td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>24/7 Support</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Regular Updates</td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                            <td class="text-center"><i class="fas fa-check check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Security Badges -->
            <div class="security-badges">
                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i>
                    <p>Secure Payment</p>
                </div>
                <div class="security-badge">
                    <i class="fas fa-lock"></i>
                    <p>SSL Encrypted</p>
                </div>
                <div class="security-badge">
                    <i class="fas fa-user-shield"></i>
                    <p>Privacy Protected</p>
                </div>
                <div class="security-badge">
                    <i class="fas fa-sync-alt"></i>
                    <p>Auto Updates</p>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

    <script src="js/vendor/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function purchaseProduct(productId, pricingId) {
            <?php if (isset($_SESSION['user_id'])): ?>
                window.location.href = 'checkout.php?product=' + productId + '&pricing=' + pricingId;
            <?php else: ?>
                window.location.href = 'login.php?redirect=checkout.php?product=' + productId + '&pricing=' + pricingId;
            <?php endif; ?>
        }
    </script>
</body>
</html>
