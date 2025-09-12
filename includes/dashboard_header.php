<?php
// Dashboard Header Include File
// This file contains the common header structure for all dashboard pages

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user data for header display
$userId = $_SESSION['user_id'];
$headerStmt = $pdo->prepare("SELECT username, balance FROM users WHERE id = ?");
$headerStmt->execute([$userId]);
$headerUser = $headerStmt->fetch();

// Get counts for sidebar badges
$subCountStmt = $pdo->prepare("SELECT COUNT(*) FROM subscriptions WHERE user_id = ? AND status = 'active'");
$subCountStmt->execute([$userId]);
$activeSubCount = $subCountStmt->fetchColumn();

$favCountStmt = $pdo->prepare("SELECT COUNT(*) FROM favorites WHERE user_id = ?");
$favCountStmt->execute([$userId]);
$favCount = $favCountStmt->fetchColumn();

// Determine active page for navigation highlighting
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>

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
                    Welcome, <?php echo htmlspecialchars($headerUser['username']); ?>!
                </span>
                <a class="action-btn" href="#!">
                    <i class="fas fa-bell"></i>
                    <?php if($activeSubCount > 0): ?>
                        <span></span>
                    <?php endif; ?>
                </a>
                <a class="profile" href="profile.php">
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
                <li class="<?php echo $currentPage == 'dashboard' ? 'uk-active' : ''; ?>">
                    <a href="dashboard.php"><i class="ico_home"></i><span>Dashboard</span></a>
                </li>
                
                <li class="uk-nav-header">Services</li>
                <li class="<?php echo $currentPage == 'shop' ? 'uk-active' : ''; ?>">
                    <a href="shop.php"><i class="ico_store"></i><span>Shop</span></a>
                </li>
                <li class="<?php echo $currentPage == 'subscriptions' ? 'uk-active' : ''; ?>">
                    <a href="subscriptions.php">
                        <i class="ico_profile"></i><span>My Subscriptions</span>
                        <?php if($activeSubCount > 0): ?>
                            <span class="count"><?php echo $activeSubCount; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="<?php echo $currentPage == 'keys' ? 'uk-active' : ''; ?>">
                    <a href="keys.php"><i class="ico_wallet"></i><span>License Keys</span></a>
                </li>
                
                <li class="uk-nav-header">Account</li>
                <li class="<?php echo $currentPage == 'profile' ? 'uk-active' : ''; ?>">
                    <a href="profile.php"><i class="ico_profile"></i><span>Profile</span></a>
                </li>
                <li class="<?php echo $currentPage == 'favorites' ? 'uk-active' : ''; ?>">
                    <a href="favorites.php">
                        <i class="ico_favourites"></i><span>Favorites</span>
                        <?php if($favCount > 0): ?>
                            <span class="count"><?php echo $favCount; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="<?php echo $currentPage == 'transactions' ? 'uk-active' : ''; ?>">
                    <a href="transactions.php"><i class="ico_market"></i><span>Transactions</span></a>
                </li>
                
                <li class="uk-nav-header">Support</li>
                <li class="<?php echo $currentPage == 'support' ? 'uk-active' : ''; ?>">
                    <a href="support.php"><i class="ico_help"></i><span>Help Center</span></a>
                </li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Content Container -->
    <main class="page-main">