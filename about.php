<?php
$page_title = "About Us";
$page_description = "Learn more about HOQQDMD Gaming Platform";
require_once 'includes/header.php';
?>

<!-- Page Banner -->
<section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2>About <span>Us</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="about-area pt-120 pb-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="img/images/about_img.jpg" alt="About Us" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title mb-30">
                        <span class="sub-title">About HOQQDMD</span>
                        <h2>Welcome to the Ultimate <span>Gaming Platform</span></h2>
                    </div>
                    <p>HOQQDMD Gaming Platform is your premier destination for all things gaming. We provide a comprehensive ecosystem for gamers, from casual players to esports professionals.</p>
                    <p>Our platform offers:</p>
                    <ul class="about-list mb-30">
                        <li><i class="fas fa-check"></i> Premium Gaming Equipment</li>
                        <li><i class="fas fa-check"></i> Competitive Tournaments</li>
                        <li><i class="fas fa-check"></i> Active Gaming Community</li>
                        <li><i class="fas fa-check"></i> Latest Gaming News & Reviews</li>
                        <li><i class="fas fa-check"></i> Professional Support Team</li>
                    </ul>
                    <p>Join thousands of gamers who trust HOQQDMD for their gaming needs. Whether you're looking for the latest gaming gear, want to compete in tournaments, or connect with fellow gamers, we've got you covered.</p>
                    <a href="shop.php" class="btn rotated-btn mt-30">Explore Products</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-area pt-90 pb-90" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <h3 class="counter">10,000</h3>
                    <p>Active Gamers</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <h3 class="counter">500</h3>
                    <p>Products</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <h3 class="counter">50</h3>
                    <p>Tournaments</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <h3 class="counter">24/7</h3>
                    <p>Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.breadcrumb-area {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 150px 0 120px;
    position: relative;
}
.breadcrumb-content h2 {
    color: white;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}
.breadcrumb-content h2 span {
    color: #ffd700;
}
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    justify-content: center;
}
.breadcrumb-item {
    color: rgba(255,255,255,0.8);
}
.breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}
.breadcrumb-item.active {
    color: white;
}
.about-list {
    list-style: none;
    padding: 0;
}
.about-list li {
    padding: 8px 0;
    color: #666;
}
.about-list li i {
    color: #667eea;
    margin-right: 10px;
}
.section-title .sub-title {
    color: #667eea;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 10px;
}
.section-title h2 {
    font-size: 36px;
    font-weight: 700;
    color: #333;
}
.section-title h2 span {
    color: #667eea;
}
.stat-item h3 {
    font-size: 42px;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 10px;
}
.stat-item p {
    font-size: 18px;
    color: #666;
}
</style>

<?php require_once 'includes/footer.php'; ?>

