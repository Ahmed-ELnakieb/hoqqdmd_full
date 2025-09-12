<?php
// Set page title and description for SEO
$page_title = "Home";
$page_description = "Welcome to HOQQDMD Gaming Platform - Your ultimate destination for gaming tournaments, community, and more.";

// Include header
require_once 'includes/header.php';

// For now, we'll use static data instead of database
$featured_products = [];
?>

<!-- slider-area -->
<section class="home-seven-slider">
    <div class="h-seven-slider-active">
        <div class="h-seven-slider-item">
            <div class="container custom-container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="h-seven-slider-content">
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">Honor of Kings <br> <strong>Hacks for <span>Champions</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Get the ultimate advantage with our premium HOK hacking tools and features.</p>
                            <a href="shop.php?category=hok" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">Get HOK Hacks</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <!-- Slider image commented out - uncomment to show 3D model -->
                        <!-- <div class="h-seven-slider-img text-center">
                            <img src="img/slider/shop_slider_img01.png" data-animation-in="slideInRightS" data-delay-in=".4" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="h-seven-slider-item">
            <div class="container custom-container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="h-seven-slider-content">
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">Mobile Legends <br> <strong>Hacks for <span>Victory</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Dominate every match with our advanced MLBB hacking tools and strategic advantages.</p>
                            <a href="shop.php?category=mlbb" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">Get MLBB Hacks</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <!-- Slider image commented out - uncomment to show 3D model -->
                        <!-- <div class="h-seven-slider-img text-center">
                            <img src="img/images/wukung.png" data-animation-in="slideInRightS" data-delay-in=".4" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="h-seven-slider-item">
            <div class="container custom-container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="h-seven-slider-content">
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">PUBG Mobile <br> <strong>Hacks for <span>Survival</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Get the ultimate edge in battle with our professional-grade PUBG Mobile hacking tools.</p>
                            <a href="shop.php?category=pubg" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">Get PUBG Hacks</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <!-- Slider image commented out - uncomment to show 3D model -->
                        <!-- <div class="h-seven-slider-img text-center">
                            <img src="img/images/wukung.png" data-animation-in="slideInRightS" data-delay-in=".4" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->

<!-- latest-collection-area -->
<section class="latest-collection-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9">
                <div class="latest-collection-item mb-30">
                    <div class="lc-item-thumb">
                        <div class="lc-thumb-overlay"></div>
                        <a href="shop.php"><img src="img/categories/hok-bg2.png" alt=""></a>
                    </div>
                    <div class="lc-item-content">
                        <h4>Latest Collection</h4>
                        <p>Discover our newest gaming gear and accessories</p>
                        <a href="shop.php" class="btn rotated-btn">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9">
                <div class="latest-collection-item mb-30">
                    <div class="lc-item-thumb">
                        <div class="lc-thumb-overlay"></div>
                        <a href="shop.php?category=bestsellers"><img src="img/categories/hok-bg.jpg" alt=""></a>
                    </div>
                    <div class="lc-item-content">
                        <h4>Best Selling Items</h4>
                        <p>Check out what other gamers are buying</p>
                        <a href="shop.php?category=bestsellers" class="btn rotated-btn">View Bestsellers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- latest-collection-area-end -->

<!-- game-shop-category -->
<section class="game-shop-category pt-10 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="game-shop-title text-center mb-60">
                    <h2 class="title">Popular Categories</h2>
                </div>
            </div>
        </div>
        <div class="row gs-category-active">
            <div class="col-3 grid-item">
                <div class="gs-category-item mb-20">
                    <div class="thumb">
                        <div class="thumb-overlay"></div>
                        <a href="shop.php?category=hok"><img src="img/categories/hok.jpg" alt=""></a>
                    </div>
                    <div class="content">
                        <h4><a href="shop.php?category=hok">Honor of Kings</a></h4>
                        <a href="shop.php?category=hok" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two green-bg mb-20">
                    <div class="thumb">
                        <div class="thumb-overlay"></div>
                        <a href="shop.php?category=mlbb"><img src="img/categories/mlbb.jpg" alt=""></a>
                    </div>
                    <div class="content">
                        <h4><a href="shop.php?category=mlbb">Mobile Legends</a></h4>
                        <a href="shop.php?category=mlbb" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb">
                        <div class="thumb-overlay"></div>
                        <a href="shop.php?category=wildrift"><img src="img/categories/wildrift.jpg" alt=""></a>
                    </div>
                    <div class="content">
                        <h4><a href="shop.php?category=wildrift">Wild Rift</a></h4>
                        <a href="shop.php?category=wildrift" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb">
                        <div class="thumb-overlay"></div>
                        <a href="shop.php?category=pubg"><img src="img/categories/pubg.jpg" alt=""></a>
                    </div>
                    <div class="content">
                        <h4><a href="shop.php?category=pubg">PUBG Mobile</a></h4>
                        <a href="shop.php?category=pubg" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- game-shop-category-end -->

<!-- gamers-area -->
<section class="just-gamers-area just-gamers-bg pt-115 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="section-title title-style-three white-title mb-70">
                    <h2>PUBG <span>HACKS</span></h2>
                    <p>Dominate every match with our advanced PUBG Mobile hacking tools and strategic advantages for ultimate victory.</p>
                </div>
                <div class="just-gamers-list">
                    <ul>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/gamer_list_icon01.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>Aimbot Precision</h5>
                                <p>Advanced auto-aim with customizable settings for perfect headshots and target tracking</p>
                            </div>
                        </li>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/gamer_list_icon02.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>Wallhack Vision</h5>
                                <p>See through walls and obstacles with our advanced ESP features for strategic positioning</p>
                            </div>
                        </li>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/gamer_list_icon03.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>No Recoil Control</h5>
                                <p>Eliminate weapon recoil with our advanced anti-recoil system for perfect accuracy</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 d-none d-lg-block">
                <div class="just-gamers-img">
                    <img src="img/images/just_gamers_img.png" alt="" class="just-gamers-character">
                    <div class="just-gamers-circle-shape">
                        <img src="img/images/gamers_circle_line.png" alt="">
                        <img src="img/images/gamers_circle_shape.png" alt="" class="rotateme">
                    </div>
                    <img src="img/images/just_gamers_chart.png" alt="" class="gamers-chart-shape">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- gamers-area-end -->

<!-- home-four-area-bg -->
<div id="home-four-area-bg" class="home-four-area-bg">
    <div class="bg"></div>
    <!-- latest-games-area -->
    <section class="latest-games-area home-four-latest-games pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="section-title home-four-title mb-50">
                        <span>LATEST HACKS</span>
                        <h2>Premium <span>Gaming Tools</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="latest-games-active owl-carousel">
                        <div class="latest-games-items mb-30">
                            <div class="latest-games-thumb">
                                <a href="#"><img src="img/perimum-hack/1.jpeg" alt=""></a>
                            </div>
                            <div class="latest-games-content">
                                <div class="lg-tag">
                                    <a href="#">HOK</a>
                                </div>
                                <h4><a href="#">Honor of Kings <span>Premium Pack</span></a></h4>
                                <p>Review : <span>#1</span></p>
                            </div>
                        </div>
                        <div class="latest-games-items mb-30">
                            <div class="latest-games-thumb">
                                <a href="#"><img src="img/perimum-hack/2.jpeg" alt=""></a>
                            </div>
                            <div class="latest-games-content">
                                <div class="lg-tag">
                                    <a href="#">HOK</a>
                                </div>
                                <h4><a href="#">Honor of Kings <span>Ultimate Edition</span></a></h4>
                                <p>Review : <span>#2</span></p>
                            </div>
                        </div>
                        <div class="latest-games-items mb-30">
                            <div class="latest-games-thumb">
                                <a href="#"><img src="img/perimum-hack/3.jpeg" alt=""></a>
                            </div>
                            <div class="latest-games-content">
                                <div class="lg-tag">
                                    <a href="#">HOK</a>
                                </div>
                                <h4><a href="#">Honor of Kings <span>Pro Pack</span></a></h4>
                                <p>Review : <span>#3</span></p>
                            </div>
                        </div>
                        <div class="latest-games-items mb-30">
                            <div class="latest-games-thumb">
                                <a href="#"><img src="img/perimum-hack/4.jpeg" alt=""></a>
                            </div>
                            <div class="latest-games-content">
                                <div class="lg-tag">
                                    <a href="#">HOK</a>
                                </div>
                                <h4><a href="#">Honor of Kings <span>Elite Edition</span></a></h4>
                                <p>Review : <span>#4</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest-games-area-end -->

    <!-- live-match-area -->
    <section class="live-match-area pt-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="section-title home-four-title text-center mb-60">
                        <h2>Watch <span>Hack</span> Tutorials</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="live-match-wrap">
                        <img src="img/images/wukung.png" alt="">
                        <a href="https://www.youtube.com/watch?v=7xfvgwnc0Qo" class="popup-video"><img src="img/icon/v_play.png" style="width: 70px;" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- live-match-area-end -->



</div>
<!-- home-four-area-bg-end -->

<!-- chair-product-area -->
<section class="chair-product-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="game-shop-title text-center mb-65">
                    <h2 class="title">Featured Gaming Equipment</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="chair-product-item mb-60">
                    <div class="chair-product-thumb">
                        <img src="img/product/gaming_chair01.jpg" alt="">
                        <a href="#" class="cart">Add to cart <i class="fas fa-shopping-basket"></i></a>
                    </div>
                    <div class="chair-product-content">
                        <div class="chair-product-top-content">
                            <div class="main-content">
                                <span class="category">HOK Hack Tools</span>
                                <h5 class="title"><a href="#">Honor of Kings Full Pack</a></h5>
                            </div>
                            <div class="chair-product-price">
                                <h5 class="price">$64.99</h5>
                                <span class="special-offer">Special Offer 35% Off</span>
                            </div>
                        </div>
                        <div class="chair-product-bottom">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="#" class="heart"><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="chair-product-item mb-60">
                    <div class="chair-product-thumb">
                        <img src="img/product/gaming_chair02.jpg" alt="">
                        <a href="#" class="cart">Add to cart <i class="fas fa-shopping-basket"></i></a>
                    </div>
                    <div class="chair-product-content">
                        <div class="chair-product-top-content">
                            <div class="main-content">
                                <span class="category">MLBB Hack Tools</span>
                                <h5 class="title"><a href="#">Mobile Legends Drone Pack</a></h5>
                            </div>
                            <div class="chair-product-price">
                                <h5 class="price">$51.99</h5>
                                <span class="special-offer">Special Offer 35% Off</span>
                            </div>
                        </div>
                        <div class="chair-product-bottom">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="#" class="heart"><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="chair-product-item mb-60">
                    <div class="chair-product-thumb">
                        <img src="img/product/gaming_chair03.jpg" alt="">
                        <a href="#" class="cart">Add to cart <i class="fas fa-shopping-basket"></i></a>
                    </div>
                    <div class="chair-product-content">
                        <div class="chair-product-top-content">
                            <div class="main-content">
                                <span class="category">Wild Rift Hack Tools</span>
                                <h5 class="title"><a href="#">Wild Rift Map Pack</a></h5>
                            </div>
                            <div class="chair-product-price">
                                <h5 class="price">$58.49</h5>
                                <span class="special-offer">Special Offer 35% Off</span>
                            </div>
                        </div>
                        <div class="chair-product-bottom">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="#" class="heart"><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- chair-product-area-end -->

<!-- chair-discount-area -->
<section class="chair-discount-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-lg-7">
                <div class="chair-discount-img">
                    <img src="img/featured/main.png" alt="">
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="chair-discount-content">
                    <div class="game-shop-title mb-25">
                        <h2 class="title">Special <br> Offer 35% Off</h2>
                        <p class="offer-description">The best deal in our hacks! Get premium gaming tools for Honor of Kings, Mobile Legends, Wild Rift, and PUBG at an unbeatable price.</p>
                    </div>
                    <p>Our special offer includes access to all premium features, regular updates, and 24/7 customer support. Limited time only!</p>
                    <a href="shop.php?sale=true" class="btn">Shop Sale</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- chair-discount-area-end -->

<!-- brand-area -->
<div class="game-brand-area pt-120 pb-180">
    <div class="container">
        <div class="row pz-brand-active">
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item01.png" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item02.png" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item03.png" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item04.png" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item05.png" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="pz-brand-item">
                    <img src="img/brand/pz_brand_item06.png" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area-end -->

<?php
// Include footer
require_once 'includes/footer.php';
?>

