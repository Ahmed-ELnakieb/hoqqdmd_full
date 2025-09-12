<?php
require_once 'config/database.php';
require_once 'includes/KeyManager.php';

// Initialize database
$database = new Database();
$pdo = $database->getConnection();
$keyManager = new KeyManager($pdo);

// Include header (which checks login)
require_once 'includes/dashboard_header.php';

// Get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Get user's active subscriptions with license keys
$subStmt = $pdo->prepare("
    SELECT s.*, p.name as product_name, p.type, pr.period, pr.price,
           lk.key_value as license_key, lk.hwid, lk.last_used_at
    FROM subscriptions s
    JOIN products p ON s.product_id = p.id
    JOIN pricing pr ON s.pricing_id = pr.id
    LEFT JOIN license_keys lk ON s.key_id = lk.id
    WHERE s.user_id = ? AND s.status = 'active'
    ORDER BY s.start_date DESC
");
$subStmt->execute([$userId]);
$subscriptions = $subStmt->fetchAll();

// Get statistics
$totalSpent = $pdo->prepare("SELECT SUM(amount) FROM transactions WHERE user_id = ? AND status = 'success'");
$totalSpent->execute([$userId]);
$totalSpentAmount = $totalSpent->fetchColumn() ?: 0;

// Get recent activity
$activityStmt = $pdo->prepare("
    SELECT 'transaction' as type, created_at, amount as detail, status as extra
    FROM transactions WHERE user_id = ?
    UNION ALL
    SELECT 'subscription' as type, start_date as created_at, product_id as detail, status as extra
    FROM subscriptions WHERE user_id = ?
    ORDER BY created_at DESC LIMIT 10
");
$activityStmt->execute([$userId, $userId]);
$recentActivity = $activityStmt->fetchAll();

// Get recommended products
$recommendedStmt = $pdo->prepare("
    SELECT p.*, MIN(pr.price) as starting_price
    FROM products p
    LEFT JOIN pricing pr ON p.id = pr.product_id
    WHERE p.status = 'active' 
    AND p.id NOT IN (SELECT product_id FROM subscriptions WHERE user_id = ? AND status = 'active')
    GROUP BY p.id
    ORDER BY p.popularity DESC
    LIMIT 3
");
$recommendedStmt->execute([$userId]);
$recommendedProducts = $recommendedStmt->fetchAll();

// Check for welcome message
$showWelcome = isset($_GET['welcome']) && $_GET['welcome'] == '1';

// Calculate days since joined
$daysSinceJoined = floor((time() - strtotime($user['created_at'])) / 86400);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard - HOQQDMD Gaming</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="dashboard-assets/css/libs.min.css">
    <link rel="stylesheet" href="dashboard-assets/css/main.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <style>
        /* Modern Gaming Dashboard Styles */
        .page-header__logo_text {
            color: #c8ff0b !important;
            font-weight: bold;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(200, 255, 11, 0.1), rgba(31, 32, 41, 0.95)),
                        url('img/dashboard-bg.jpg') center/cover;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #c8ff0b, transparent);
            animation: scan 3s linear infinite;
        }
        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
        }
        .hero-text h1 {
            color: #fff;
            font-size: 36px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .hero-text p {
            color: #aaa;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .hero-stats {
            display: flex;
            gap: 30px;
        }
        .hero-stat {
            text-align: center;
        }
        .hero-stat-value {
            color: #c8ff0b;
            font-size: 32px;
            font-weight: bold;
            display: block;
        }
        .hero-stat-label {
            color: #888;
            font-size: 14px;
            text-transform: uppercase;
        }
        
        /* Quick Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: linear-gradient(135deg, rgba(31, 32, 41, 0.95), rgba(20, 21, 30, 0.95));
            border: 1px solid rgba(200, 255, 11, 0.1);
            border-radius: 15px;
            padding: 25px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(200, 255, 11, 0.3);
            box-shadow: 0 10px 30px rgba(200, 255, 11, 0.1);
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(200, 255, 11, 0.1), transparent);
            transform: translate(30px, -30px);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(200, 255, 11, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        .stat-icon i {
            font-size: 24px;
            color: #c8ff0b;
        }
        .stat-value {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #888;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stat-change {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .stat-change.positive {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
        .stat-change.negative {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        
        /* Active Subscriptions Section */
        .subscriptions-section {
            margin-bottom: 40px;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .section-title {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title i {
            color: #c8ff0b;
        }
        .subscription-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        .subscription-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            padding: 25px;
            border: 2px solid #333;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .subscription-card:hover {
            border-color: #c8ff0b;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(200, 255, 11, 0.1);
        }
        .subscription-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .subscription-info h4 {
            color: #c8ff0b;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .subscription-type {
            color: #888;
            font-size: 13px;
            text-transform: uppercase;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }
        .license-key-box {
            background: rgba(0,0,0,0.4);
            border: 1px solid rgba(200, 255, 11, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .license-key {
            font-family: 'Courier New', monospace;
            color: #fff;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .copy-btn {
            background: #c8ff0b;
            color: #000;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .copy-btn:hover {
            background: #a6d409;
            transform: scale(1.05);
        }
        .subscription-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #333;
        }
        .expiry-info {
            color: #888;
            font-size: 13px;
        }
        .expiry-info span {
            color: #c8ff0b;
            font-weight: bold;
        }
        
        /* Activity Timeline */
        .activity-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        .timeline-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            padding: 25px;
        }
        .timeline-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .timeline-item:last-child {
            border-bottom: none;
        }
        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .timeline-icon.transaction {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        .timeline-icon.subscription {
            background: rgba(200, 255, 11, 0.1);
            color: #c8ff0b;
        }
        .timeline-content {
            flex: 1;
        }
        .timeline-title {
            color: #fff;
            font-size: 14px;
            margin-bottom: 3px;
        }
        .timeline-desc {
            color: #888;
            font-size: 12px;
        }
        .timeline-time {
            color: #666;
            font-size: 11px;
            text-align: right;
        }
        
        /* Recommended Products */
        .recommended-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            padding: 25px;
        }
        .product-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .product-item:hover {
            background: rgba(200, 255, 11, 0.05);
            transform: translateX(5px);
        }
        .product-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(200, 255, 11, 0.2), rgba(200, 255, 11, 0.1));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-details {
            flex: 1;
        }
        .product-name {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 3px;
        }
        .product-price {
            color: #c8ff0b;
            font-size: 16px;
            font-weight: bold;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }
        .action-btn {
            background: linear-gradient(135deg, rgba(200, 255, 11, 0.1), rgba(200, 255, 11, 0.05));
            border: 1px solid rgba(200, 255, 11, 0.2);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }
        .action-btn:hover {
            background: rgba(200, 255, 11, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(200, 255, 11, 0.2);
        }
        .action-btn i {
            font-size: 24px;
            color: #c8ff0b;
            margin-bottom: 8px;
            display: block;
        }
        .action-btn span {
            font-size: 13px;
            display: block;
        }
        
        /* Empty States */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: rgba(31, 32, 41, 0.5);
            border-radius: 15px;
        }
        .empty-state i {
            font-size: 64px;
            color: #444;
            margin-bottom: 20px;
        }
        .empty-state h3 {
            color: #fff;
            margin-bottom: 10px;
        }
        .empty-state p {
            color: #888;
            margin-bottom: 20px;
        }
        
        .uk-button-danger {
            background: linear-gradient(135deg, #c8ff0b, #a6d409) !important;
            color: #000 !important;
            font-weight: 700;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }
        .uk-button-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(200, 255, 11, 0.3);
        }
    </style>
</head>

<body class="page-home">
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
    
    <div class="page-wrapper">
        <?php include 'includes/dashboard_header.php'; ?>
                <?php if($showWelcome): ?>
                    <div class="welcome-banner">
                        <h2>Welcome to HOQQDMD!</h2>
                        <p>Your account has been successfully created. Explore our premium HOK tools below.</p>
                    </div>
                <?php endif; ?>

                <!-- Stats Overview -->
                <div class="uk-grid uk-child-width-1-4@xl uk-child-width-1-2@m" data-uk-grid>
                    <div>
                        <div class="stats-card">
                            <i class="fas fa-key"></i>
                            <h3><?php echo count($subscriptions); ?></h3>
                            <p>Active Subscriptions</p>
                        </div>
                    </div>
                    <div>
                        <div class="stats-card">
                            <i class="fas fa-heart"></i>
                            <h3><?php echo count($favorites); ?></h3>
                            <p>Favorites</p>
                        </div>
                    </div>
                    <div>
                        <div class="stats-card">
                            <i class="fas fa-dollar-sign"></i>
                            <h3>$<?php echo number_format($user['balance'], 2); ?></h3>
                            <p>Wallet Balance</p>
                        </div>
                    </div>
                    <div>
                        <div class="stats-card">
                            <i class="fas fa-calendar"></i>
                            <h3><?php echo date('M d', strtotime($user['created_at'])); ?></h3>
                            <p>Member Since</p>
                        </div>
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid>
                    <!-- Active Subscriptions -->
                    <div class="uk-width-2-3@xl">
                        <h3 class="uk-text-lead">Active Subscriptions</h3>
                        <?php if(count($subscriptions) > 0): ?>
                            <?php foreach($subscriptions as $sub): ?>
                                <div class="subscription-card">
                                    <div class="uk-flex uk-flex-between uk-flex-middle">
                                        <div>
                                            <h4><?php echo htmlspecialchars($sub['product_name']); ?></h4>
                                            <p style="color: #888; margin: 5px 0;">
                                                Plan: <?php echo ucfirst($sub['period']); ?> 
                                                | Expires: <?php echo date('M d, Y', strtotime($sub['end_date'])); ?>
                                            </p>
                                        </div>
                                        <span class="status-badge status-active">Active</span>
                                    </div>
                                    <div class="license-key">
                                        <span id="key-<?php echo $sub['id']; ?>"><?php echo htmlspecialchars($sub['license_key']); ?></span>
                                        <button class="copy-btn" onclick="copyKey('key-<?php echo $sub['id']; ?>')">
                                            <i class="fas fa-copy"></i> Copy
                                        </button>
                                    </div>
                                    <div class="uk-flex uk-flex-between" style="margin-top: 15px;">
                                        <a href="download.php?id=<?php echo $sub['id']; ?>" class="uk-button uk-button-danger uk-button-small">
                                            <i class="fas fa-download"></i> Download Tool
                                        </a>
                                        <a href="guide.php?product=<?php echo $sub['product_id']; ?>" class="uk-button uk-button-default uk-button-small">
                                            <i class="fas fa-book"></i> Setup Guide
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <h4>No Active Subscriptions</h4>
                                <p>You don't have any active subscriptions yet.</p>
                                <a href="products.php" class="uk-button uk-button-danger" style="margin-top: 20px;">
                                    Browse HOK Tools
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Recent Activity -->
                    <div class="uk-width-1-3@xl">
                        <h3 class="uk-text-lead">Recent Transactions</h3>
                        <div class="subscription-card">
                            <?php if(count($transactions) > 0): ?>
                                <?php foreach($transactions as $trans): ?>
                                    <div class="transaction-item">
                                        <div>
                                            <strong><?php echo $trans['payment_method'] ?? 'Purchase'; ?></strong>
                                            <br>
                                            <small style="color: #888;">
                                                <?php echo date('M d, Y', strtotime($trans['created_at'])); ?>
                                            </small>
                                        </div>
                                        <div>
                                            <span class="transaction-amount">
                                                $<?php echo number_format($trans['amount'], 2); ?>
                                            </span>
                                            <br>
                                            <small class="status-badge <?php echo $trans['status'] == 'success' ? 'status-active' : 'status-expired'; ?>">
                                                <?php echo ucfirst($trans['status']); ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php if(count($transactions) >= 5): ?>
                                    <div style="text-align: center; margin-top: 15px;">
                                        <a href="transactions.php" style="color: #c8ff0b;">View All Transactions →</a>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="text-align: center; padding: 20px; color: #888;">
                                    <i class="fas fa-receipt" style="font-size: 32px; margin-bottom: 10px;"></i>
                                    <p>No transactions yet</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Quick Actions -->
                        <h3 class="uk-text-lead" style="margin-top: 30px;">Quick Actions</h3>
                        <div class="subscription-card">
                            <a href="products.php" class="uk-button uk-button-danger uk-width-1-1" style="margin-bottom: 10px;">
                                <i class="fas fa-shopping-cart"></i> Browse Products
                            </a>
                            <a href="support.php" class="uk-button uk-button-default uk-width-1-1" style="margin-bottom: 10px;">
                                <i class="fas fa-headset"></i> Contact Support
                            </a>
                            <a href="profile.php" class="uk-button uk-button-default uk-width-1-1">
                                <i class="fas fa-user-cog"></i> Account Settings
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="dashboard-assets/js/libs.js"></script>
    <script src="dashboard-assets/js/main.js"></script>
    <script>
        function copyKey(elementId) {
            const keyElement = document.getElementById(elementId);
            const key = keyElement.textContent;
            
            navigator.clipboard.writeText(key).then(function() {
                // Show success message
                const btn = event.target.closest('.copy-btn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                btn.style.background = '#28a745';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '#c8ff0b';
                }, 2000);
            });
        }
    </script>
</body>
</html>
