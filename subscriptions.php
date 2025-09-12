<?php
require_once 'config/database.php';
require_once 'includes/KeyManager.php';

// Initialize database
$database = new Database();
$pdo = $database->getConnection();
$keyManager = new KeyManager($pdo);

// Include header (which checks login)
require_once 'includes/dashboard_header.php';

// Get user's subscriptions with product and pricing info
$subStmt = $pdo->prepare("
    SELECT 
        s.*,
        p.name as product_name,
        p.type as product_type,
        p.description as product_description,
        p.features,
        pr.period,
        pr.price,
        lk.key_value as license_key,
        lk.status as key_status,
        lk.hwid,
        lk.last_used_at
    FROM subscriptions s
    JOIN products p ON s.product_id = p.id
    JOIN pricing pr ON s.pricing_id = pr.id
    LEFT JOIN license_keys lk ON s.key_id = lk.id
    WHERE s.user_id = ?
    ORDER BY s.status DESC, s.end_date DESC
");
$subStmt->execute([$userId]);
$subscriptions = $subStmt->fetchAll();

// Separate active and expired subscriptions
$activeSubscriptions = array_filter($subscriptions, fn($s) => $s['status'] === 'active');
$expiredSubscriptions = array_filter($subscriptions, fn($s) => $s['status'] !== 'active');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Subscriptions - HOQQDMD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="dashboard-assets/css/libs.min.css">
    <link rel="stylesheet" href="dashboard-assets/css/main.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <style>
        .page-header__logo_text {
            color: #00d4ff !important;
            font-weight: bold;
        }
        .subscription-card {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border: 2px solid #333;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .subscription-card:hover {
            border-color: #00d4ff;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(200, 255, 11, 0.1);
        }
        .subscription-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00d4ff, transparent);
            animation: scan 3s linear infinite;
        }
        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .product-info h3 {
            color: #00d4ff;
            margin-bottom: 8px;
            font-size: 24px;
        }
        .product-type {
            display: inline-block;
            background: rgba(200, 255, 11, 0.1);
            color: #00d4ff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }
        .status-expired {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: #fff;
        }
        .status-suspended {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #000;
        }
        .license-section {
            background: rgba(0,0,0,0.4);
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .license-key-box {
            background: rgba(200, 255, 11, 0.05);
            border: 1px solid rgba(200, 255, 11, 0.2);
            border-radius: 8px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .license-key {
            font-family: 'Courier New', monospace;
            color: #fff;
            font-size: 16px;
            letter-spacing: 1px;
        }
        .copy-btn {
            background: #00d4ff;
            color: #000;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        .copy-btn:hover {
            background: #0099cc;
            transform: scale(1.05);
        }
        .subscription-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .detail-item {
            background: rgba(255,255,255,0.03);
            padding: 12px;
            border-radius: 8px;
        }
        .detail-label {
            color: #888;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .detail-value {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .uk-button-danger {
            background: #00d4ff !important;
            color: #000 !important;
            font-weight: 700;
            border: none;
            transition: all 0.3s;
        }
        .uk-button-danger:hover {
            background: #0099cc !important;
            transform: translateY(-2px);
        }
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }
        .feature-list li {
            color: #aaa;
            padding: 5px 0;
            padding-left: 25px;
            position: relative;
        }
        .feature-list li:before {
            content: '✓';
            color: #00d4ff;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: rgba(31, 32, 41, 0.95);
            border-radius: 15px;
            margin: 30px 0;
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
            margin-bottom: 25px;
        }
        .tab-navigation {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
        }
        .tab-btn {
            background: transparent;
            border: none;
            color: #888;
            padding: 15px 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
        }
        .tab-btn.active {
            color: #00d4ff;
        }
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #00d4ff;
        }
        .tab-btn:hover {
            color: #fff;
        }
        .progress-bar {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress-fill {
            background: linear-gradient(90deg, #00d4ff, #0099cc);
            height: 100%;
            transition: width 0.3s;
        }
        .hwid-info {
            display: inline-block;
            background: rgba(200, 255, 11, 0.1);
            color: #00d4ff;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 12px;
            margin-left: 10px;
        }
    </style>
</head>

<body class="page-home">
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
    
    <div class="page-wrapper">
        <?php include 'includes/dashboard_header.php'; ?>

        <div class="uk-container uk-container-large" style="padding-top: 20px;">
            <h2 class="uk-text-lead" style="color: #fff; margin-bottom: 30px;">
                <i class="fas fa-key" style="color: #00d4ff;"></i> My Subscriptions
            </h2>

            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-btn active" onclick="showTab('active')">
                    Active (<?php echo count($activeSubscriptions); ?>)
                </button>
                <button class="tab-btn" onclick="showTab('expired')">
                    Expired (<?php echo count($expiredSubscriptions); ?>)
                </button>
            </div>

            <!-- Active Subscriptions Tab -->
            <div id="active-tab" class="tab-content">
                <?php if(count($activeSubscriptions) > 0): ?>
                    <?php foreach($activeSubscriptions as $sub): 
                        $daysRemaining = ceil((strtotime($sub['end_date']) - time()) / 86400);
                        $totalDays = ceil((strtotime($sub['end_date']) - strtotime($sub['start_date'])) / 86400);
                        $progressPercent = max(0, min(100, (($totalDays - $daysRemaining) / $totalDays) * 100));
                        
                        // Parse features JSON
                        $features = json_decode($sub['features'], true) ?: [];
                    ?>
                        <div class="subscription-card">
                            <div class="product-header">
                                <div class="product-info">
                                    <span class="product-type"><?php echo htmlspecialchars($sub['product_type']); ?></span>
                                    <h3><?php echo htmlspecialchars($sub['product_name']); ?></h3>
                                    <p style="color: #aaa; margin-bottom: 0;">
                                        <?php echo htmlspecialchars($sub['product_description']); ?>
                                    </p>
                                </div>
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            </div>

                            <!-- License Key Section -->
                            <div class="license-section">
                                <h4 style="color: #fff; margin-bottom: 15px;">License Information</h4>
                                <div class="license-key-box">
                                    <span class="license-key" id="key-<?php echo $sub['id']; ?>">
                                        <?php echo htmlspecialchars($sub['license_key'] ?: 'NO-KEY-ASSIGNED'); ?>
                                    </span>
                                    <button class="copy-btn" onclick="copyKey('key-<?php echo $sub['id']; ?>')">
                                        <i class="fas fa-copy"></i> Copy Key
                                    </button>
                                </div>
                                <?php if($sub['hwid']): ?>
                                    <div style="margin-top: 10px;">
                                        <span style="color: #888;">HWID Bound:</span>
                                        <span class="hwid-info"><?php echo substr($sub['hwid'], 0, 8); ?>...</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Subscription Details -->
                            <div class="subscription-details">
                                <div class="detail-item">
                                    <div class="detail-label">Plan Type</div>
                                    <div class="detail-value"><?php echo ucfirst($sub['period']); ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Start Date</div>
                                    <div class="detail-value"><?php echo date('M d, Y', strtotime($sub['start_date'])); ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Expiry Date</div>
                                    <div class="detail-value"><?php echo date('M d, Y', strtotime($sub['end_date'])); ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Days Remaining</div>
                                    <div class="detail-value" style="color: <?php echo $daysRemaining < 7 ? '#ff6b6b' : '#00d4ff'; ?>">
                                        <?php echo $daysRemaining; ?> days
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo $progressPercent; ?>%"></div>
                            </div>

                            <!-- Features -->
                            <?php if(!empty($features)): ?>
                                <ul class="feature-list">
                                    <?php foreach($features as $feature): ?>
                                        <li><?php echo htmlspecialchars($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="download.php?id=<?php echo $sub['id']; ?>" class="uk-button uk-button-danger">
                                    <i class="fas fa-download"></i> Download Client
                                </a>
                                <a href="guide.php?product=<?php echo $sub['product_id']; ?>" class="uk-button uk-button-default">
                                    <i class="fas fa-book"></i> Setup Guide
                                </a>
                                <?php if($daysRemaining <= 7): ?>
                                    <a href="shop.php?renew=<?php echo $sub['id']; ?>" class="uk-button uk-button-primary">
                                        <i class="fas fa-sync"></i> Renew Now
                                    </a>
                                <?php endif; ?>
                                <?php if(!$sub['hwid']): ?>
                                    <button onclick="resetHWID(<?php echo $sub['key_id']; ?>)" class="uk-button uk-button-default">
                                        <i class="fas fa-desktop"></i> Bind HWID
                                    </button>
                                <?php else: ?>
                                    <button onclick="resetHWID(<?php echo $sub['key_id']; ?>)" class="uk-button uk-button-default">
                                        <i class="fas fa-undo"></i> Reset HWID
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-ticket-alt"></i>
                        <h3>No Active Subscriptions</h3>
                        <p>You don't have any active subscriptions at the moment.</p>
                        <a href="shop.php" class="uk-button uk-button-danger uk-button-large">
                            <i class="fas fa-shopping-cart"></i> Browse Products
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Expired Subscriptions Tab -->
            <div id="expired-tab" class="tab-content" style="display: none;">
                <?php if(count($expiredSubscriptions) > 0): ?>
                    <?php foreach($expiredSubscriptions as $sub): ?>
                        <div class="subscription-card" style="opacity: 0.7;">
                            <div class="product-header">
                                <div class="product-info">
                                    <span class="product-type"><?php echo htmlspecialchars($sub['product_type']); ?></span>
                                    <h3><?php echo htmlspecialchars($sub['product_name']); ?></h3>
                                </div>
                                <span class="status-badge status-expired">
                                    <i class="fas fa-times-circle"></i> Expired
                                </span>
                            </div>

                            <div class="subscription-details">
                                <div class="detail-item">
                                    <div class="detail-label">Plan Type</div>
                                    <div class="detail-value"><?php echo ucfirst($sub['period']); ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Expired On</div>
                                    <div class="detail-value"><?php echo date('M d, Y', strtotime($sub['end_date'])); ?></div>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="shop.php?product=<?php echo $sub['product_id']; ?>" class="uk-button uk-button-danger">
                                    <i class="fas fa-redo"></i> Resubscribe
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-history"></i>
                        <h3>No Expired Subscriptions</h3>
                        <p>You don't have any expired subscriptions.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php include 'includes/dashboard_footer.php'; ?>

        <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        function resetHWID(keyId) {
            if(confirm('Are you sure you want to reset the HWID binding for this license?')) {
                // Here you would make an AJAX call to reset the HWID
                fetch('api/reset-hwid.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({key_id: keyId})
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('HWID reset successfully!');
                        location.reload();
                    } else {
                        alert('Failed to reset HWID: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error resetting HWID');
                });
            }
        }
        </script>