<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

// Check if admin is logged in
if(!isAdminLoggedIn()) {
    redirect('login.php');
}

$conn = connectDB();
$admin_name = $_SESSION['admin_name'] ?? 'Administrator';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Admin Panel - HOQQDMD</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }
        
        body {
            background: #f8f9fa;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: white;
            background: rgba(255,255,255,0.1);
            padding-left: 30px;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .admin-header {
            background: white;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .admin-header-left {
            display: flex;
            align-items: center;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            margin-right: 20px;
        }
        
        .admin-header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .admin-dropdown {
            position: relative;
        }
        
        .admin-dropdown-toggle {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .content-wrapper {
            padding: 30px;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
            margin: 10px 0 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 15px;
        }
        
        .stat-icon.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .stat-icon.bg-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        
        .stat-icon.bg-warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        
        .stat-icon.bg-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-gamepad"></i> HOQQDMD</h3>
            <small>Admin Panel</small>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="users.php" class="<?php echo $current_page == 'users.php' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li>
                <a href="products.php" class="<?php echo $current_page == 'products.php' ? 'active' : ''; ?>">
                    <i class="fas fa-box"></i> Products
                </a>
            </li>
            <li>
                <a href="orders.php" class="<?php echo $current_page == 'orders.php' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li>
                <a href="tournaments.php" class="<?php echo $current_page == 'tournaments.php' ? 'active' : ''; ?>">
                    <i class="fas fa-trophy"></i> Tournaments
                </a>
            </li>
            <li>
                <a href="blog.php" class="<?php echo $current_page == 'blog.php' ? 'active' : ''; ?>">
                    <i class="fas fa-blog"></i> Blog Posts
                </a>
            </li>
            <li>
                <a href="pages.php" class="<?php echo $current_page == 'pages.php' ? 'active' : ''; ?>">
                    <i class="fas fa-file-alt"></i> Pages
                </a>
            </li>
            <li>
                <a href="settings.php" class="<?php echo $current_page == 'settings.php' ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="admin-header">
            <div class="admin-header-left">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0"><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></h4>
            </div>
            <div class="admin-header-right">
                <div class="admin-user">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($admin_name); ?>&background=667eea&color=fff" alt="Admin">
                    <div class="admin-dropdown">
                        <button class="admin-dropdown-toggle dropdown-toggle" data-bs-toggle="dropdown">
                            <?php echo $admin_name; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Wrapper -->
        <div class="content-wrapper">
