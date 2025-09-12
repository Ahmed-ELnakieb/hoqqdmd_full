<?php
// Simple session start for future use
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set default values
$site_name = 'HOQQDMD Gaming';
$site_description = 'eSports Gaming Platform';

// Simple function to check if user is logged in (always returns false for now)
function isLoggedIn() {
    return false;
}
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo isset($page_title) ? $page_title . ' - ' . $site_name : $site_name; ?></title>
        <meta name="description" content="<?php echo isset($page_description) ? $page_description : $site_description; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        
        <!-- CSS here -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <link rel="stylesheet" href="css/odometer.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/meanmenu.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/responsive.css">
        
        <!-- Custom CSS for PHP functionality -->
        <style>
            .user-menu {
                display: inline-block;
                margin-left: 20px;
            }
            .user-menu .dropdown-menu {
                background: #1a1a1a;
                border: 1px solid #333;
            }
            .user-menu .dropdown-menu a {
                color: #fff;
                padding: 10px 20px;
                display: block;
                transition: all 0.3s;
            }
            .user-menu .dropdown-menu a:hover {
                background: #333;
                text-decoration: none;
            }
        </style>
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <img src="img/icon/preloader.svg" alt="">
                </div>
            </div>
        </div>
        <!-- preloader-end -->

        <!-- header-area -->
        <header class="third-header-bg home-six-header">
            <div class="bg"></div>
            <div class="container custom-container">
                <div class="header-top-area t-header-top-area d-none d-lg-block">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="header-top-social">
                                <ul>
                                    <li>Follow</li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="header-top-login">
                                <?php if(isLoggedIn()): ?>
                                    <div class="user-menu">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="far fa-user"></i> <?php echo $_SESSION['username']; ?>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="profile.php">Profile</a>
                                                <a href="dashboard.php">Dashboard</a>
                                                <a href="logout.php">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <ul>
                                        <li><a href="register.php"><i class="far fa-edit"></i>Register</a></li>
                                        <li class="or">or</li>
                                        <li><a href="login.php"><i class="far fa-edit"></i>Sign in</a></li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="main-menu menu-style-two">
                                <nav>
                                    <div class="logo d-block d-lg-none">
                                        <a href="home.php"><img src="img/logo/logo.png" alt="Logo"></a>
                                    </div>
                                    <div class="navbar-wrap d-none d-lg-flex">
                                        <ul class="left">
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">
                                                <a href="home.php">Home</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                                                <a href="about.php">About</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'games.php' ? 'active' : ''; ?>">
                                                <a href="games.php">Games</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'community.php' ? 'active' : ''; ?>">
                                                <a href="community.php">Community</a>
                                            </li>
                                        </ul>
                                        <div class="logo">
                                            <a href="home.php"><img src="img/logo/h6_logo.png" alt="Logo" style="width: 120px;"></a>
                                        </div>
                                        <ul class="right">
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'tournaments.php' ? 'active' : ''; ?>">
                                                <a href="tournaments.php">Tournaments</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">
                                                <a href="shop.php">Store</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">
                                                <a href="blog.php">Blog</a>
                                            </li>
                                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                                                <a href="contact.php">Contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="header-action">
                                        <ul>
                                            <li class="header-search"><a href="#" data-toggle="modal" data-target="#search-modal"><i class="fas fa-search"></i></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="mobile-menu-wrap d-block d-lg-none">
                                <nav>
                                    <div id="mobile-menu" class="navbar-wrap">
                                        <ul>
                                            <li><a href="home.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li><a href="games.php">Games</a></li>
                                            <li><a href="community.php">Community</a></li>
                                            <li><a href="tournaments.php">Tournaments</a></li>
                                            <li><a href="shop.php">Store</a></li>
                                            <li><a href="blog.php">Blog</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="mobile-menu"></div>
                        </div>
                        <!-- Modal Search -->
                        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="search.php" method="GET">
                                        <input type="text" name="q" placeholder="Search here..." required>
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-bg"></div>
        </header>
        <!-- header-area-end -->

        <!-- main-area -->
        <main>
