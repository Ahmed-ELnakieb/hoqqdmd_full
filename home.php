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
                        <a href="shop.php"><img src="img/product/latest_collection01.jpg" alt=""></a>
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
                        <a href="shop.php?category=bestsellers"><img src="img/product/latest_collection02.jpg" alt=""></a>
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
                    <div class="thumb"><a href="shop.php?category=hok"><img src="img/product/gs_popular_item01.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=hok">Honor of Kings</a></h4>
                        <a href="shop.php?category=hok" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two green-bg mb-20">
                    <div class="thumb"><a href="shop.php?category=mlbb"><img src="img/product/gs_popular_item02.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=mlbb">Mobile Legends</a></h4>
                        <a href="shop.php?category=mlbb" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb"><a href="shop.php?category=wildrift"><img src="img/product/gs_popular_item03.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=wildrift">Wild Rift</a></h4>
                        <a href="shop.php?category=wildrift" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb"><a href="shop.php?category=pubg"><img src="img/product/gs_popular_item04.jpg" alt=""></a></div>
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
<section class="makes-gaming-chair">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="game-shop-title text-left mb-60">
                    <h2 class="title">Premium Gaming <span>Hacks</span></h2>
                    <p>Experience the ultimate advantage with our carefully selected premium gaming hacks designed for professional gamers.</p>
                </div>
                <div class="just-gamers-list">
                    <ul>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/mgc_icon01.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>Premium Quality</h5>
                                <p>Built with high-quality materials for durability and comfort</p>
                            </div>
                        </li>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/mgc_icon02.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>Professional Grade</h5>
                                <p>Tested and approved by professional gaming teams worldwide</p>
                            </div>
                        </li>
                        <li>
                            <div class="just-gamers-list-icon">
                                <img src="img/icon/mgc_icon03.png" alt="">
                            </div>
                            <div class="just-gamers-list-content fix">
                                <h5>Warranty Support</h5>
                                <p>Comprehensive warranty and customer support for peace of mind</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 d-none d-lg-block">
                <div class="gaming-chair-active">
                    <div class="gaming-chair-wrap">
                        <img src="img/images/chair.png" alt="" class="main-chair">
                        <img src="img/images/chair_zoom.png" alt="" class="chair-zoom">
                        <img src="img/images/chair_chart.png" alt="" class="chair-chart">
                    </div>
                    <div class="gaming-chair-wrap">
                        <img src="img/images/chair02.png" alt="" class="main-chair">
                        <img src="img/images/chair_zoom02.png" alt="" class="chair-zoom">
                        <img src="img/images/chair_chart.png" alt="" class="chair-chart">
                    </div>
                    <div class="gaming-chair-wrap">
                        <img src="img/images/chair03.png" alt="" class="main-chair">
                        <img src="img/images/chair_zoom03.png" alt="" class="chair-zoom">
                        <img src="img/images/chair_chart.png" alt="" class="chair-chart">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- gamers-area-end -->

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
                                <h5 class="title"><a href="#">Honor of Kings Ultimate Pack</a></h5>
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
                                <h5 class="title"><a href="#">Mobile Legends Pro Edition</a></h5>
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
                                <h5 class="title"><a href="#">Wild Rift Champion Pack</a></h5>
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
                    <img src="img/images/chair_discount_img.jpg" alt="">
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

