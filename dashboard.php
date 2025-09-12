<?php
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user data
$database = new Database();
$pdo = $database->getConnection();

$userId = $_SESSION['user_id'];

// Get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Get user's active subscriptions
$subStmt = $pdo->prepare("
    SELECT s.*, p.name as product_name, p.type, pr.period, pr.price 
    FROM subscriptions s
    JOIN products p ON s.product_id = p.id
    JOIN pricing pr ON s.pricing_id = pr.id
    WHERE s.user_id = ? AND s.status = 'active'
    ORDER BY s.start_date DESC
");
$subStmt->execute([$userId]);
$subscriptions = $subStmt->fetchAll();

// Get user's favorite products
$favStmt = $pdo->prepare("
    SELECT p.* FROM favorites f
    JOIN products p ON f.product_id = p.id
    WHERE f.user_id = ?
");
$favStmt->execute([$userId]);
$favorites = $favStmt->fetchAll();

// Get recent transactions
$transStmt = $pdo->prepare("
    SELECT * FROM transactions 
    WHERE user_id = ? 
    ORDER BY created_at DESC 
    LIMIT 5
");
$transStmt->execute([$userId]);
$transactions = $transStmt->fetchAll();

// Check for welcome message
$showWelcome = isset($_GET['welcome']) && $_GET['welcome'] == '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard - HOQQDMD HOK Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="dashboard-assets/css/libs.min.css">
    <link rel="stylesheet" href="dashboard-assets/css/main.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <style>
        .page-header__logo_text {
            color: #c8ff0b !important;
            font-weight: bold;
        }
        .uk-button-danger {
            background: #c8ff0b !important;
            color: #000 !important;
            font-weight: 700;
        }
        .uk-button-danger:hover {
            background: #a6d409 !important;
        }
        .subscription-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid #333;
            transition: all 0.3s;
        }
        .subscription-card:hover {
            border-color: #c8ff0b;
            transform: translateY(-2px);
        }
        .subscription-card h4 {
            color: #c8ff0b;
            margin-bottom: 10px;
        }
        .license-key {
            background: rgba(0,0,0,0.3);
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            color: #fff;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .copy-btn {
            background: #c8ff0b;
            color: #000;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }
        .copy-btn:hover {
            background: #a6d409;
        }
        .status-badge {
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-active {
            background: #28a745;
            color: #fff;
        }
        .status-expired {
            background: #dc3545;
            color: #fff;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #c8ff0b, #a6d409);
            color: #000;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .welcome-banner h2 {
            color: #000;
            margin-bottom: 10px;
        }
        .stats-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .stats-card i {
            font-size: 32px;
            color: #c8ff0b;
            margin-bottom: 10px;
        }
        .stats-card h3 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .stats-card p {
            color: #888;
            margin: 0;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #888;
        }
        .empty-state i {
            font-size: 48px;
            color: #444;
            margin-bottom: 20px;
        }
        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #333;
        }
        .transaction-item:last-child {
            border-bottom: none;
        }
        .transaction-amount {
            color: #c8ff0b;
            font-weight: bold;
        }
    </style>
</head>

<body class="page-home">
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
    
    <div class="page-wrapper">
        <!-- Header -->
        <header class="page-header">
            <div class="page-header__inner">
                <div class="page-header__sidebar">
                    <div class="page-header__menu-btn"><button class="menu-btn ico_menu is-active"></button></div>
                    <div class="page-header__logo">
                        <img src="img/logo/h6_logo.png" alt="logo" style="width: 40px;">
                        <span class="page-header__logo_text">HOQQDMD</span>
                    </div>
                </div>
                <div class="page-header__content">
                    <div class="page-header__search">
                        <div class="search">
                            <div class="search__input">
                                <i class="ico_search"></i>
                                <input type="search" name="search" placeholder="Search for products...">
                            </div>
                        </div>
                    </div>
                    <div class="page-header__action">
                        <span style="color: #c8ff0b; margin-right: 20px;">
                            Welcome, <?php echo htmlspecialchars($user['username']); ?>!
                        </span>
                        <a class="action-btn" href="#!">
                            <i class="fas fa-bell"></i>
                            <?php if(count($subscriptions) > 0): ?>
                                <span></span>
                            <?php endif; ?>
                        </a>
                        <a class="profile" href="#!">
                            <img src="dashboard-assets/img/profile.png" alt="profile">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-content">
            <!-- Sidebar -->
            <aside class="sidebar is-show" id="sidebar">
                <div class="sidebar-box">
                    <ul class="uk-nav">
                        <li class="uk-active"><a href="dashboard.php"><i class="ico_home"></i><span>Dashboard</span></a></li>
                        <li class="uk-nav-header">Services</li>
                        <li><a href="products.php"><i class="ico_store"></i><span>HOK Tools</span></a></li>
                        <li><a href="my-subscriptions.php"><i class="ico_profile"></i><span>My Subscriptions</span>
                            <?php if(count($subscriptions) > 0): ?>
                                <span class="count"><?php echo count($subscriptions); ?></span>
                            <?php endif; ?>
                        </a></li>
                        <li><a href="keys.php"><i class="ico_wallet"></i><span>License Keys</span></a></li>
                        <li class="uk-nav-header">Account</li>
                        <li><a href="profile.php"><i class="ico_profile"></i><span>Profile</span></a></li>
                        <li><a href="favorites.php"><i class="ico_favourites"></i><span>Favorites</span>
                            <?php if(count($favorites) > 0): ?>
                                <span class="count"><?php echo count($favorites); ?></span>
                            <?php endif; ?>
                        </a></li>
                        <li><a href="transactions.php"><i class="ico_market"></i><span>Transactions</span></a></li>
                        <li class="uk-nav-header">Support</li>
                        <li><a href="support.php"><i class="ico_help"></i><span>Help Center</span></a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="page-main">
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
