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
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">Gaming Gear <br> <strong>for <span>Champions</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Elevate your gaming experience with our premium collection of gaming equipment.</p>
                            <a href="shop.php" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">Shop Now</a>
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
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">Join Tournaments <br> <strong>Win <span>Prizes</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Compete with players worldwide and showcase your skills in epic gaming tournaments.</p>
                            <a href="tournaments.php" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">View Tournaments</a>
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
                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".2">Gaming Community <br> <strong>Connect & <span>Play</span></strong></h2>
                            <p data-animation-in="fadeInUp" data-delay-in=".4">Join our vibrant gaming community and connect with players from around the world.</p>
                            <a href="community.php" class="btn rotated-btn" data-animation-in="fadeInUp" data-delay-in=".6">Join Community</a>
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
            <div class="col-5 grid-item">
                <div class="gs-category-item mb-20">
                    <div class="thumb"><a href="shop.php?category=chairs"><img src="img/product/gs_popular_item01.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=chairs">Gaming Chairs</a></h4>
                        <a href="shop.php?category=chairs" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two green-bg mb-20">
                    <div class="thumb"><a href="shop.php?category=headphones"><img src="img/product/gs_popular_item02.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=headphones">Game Headphones</a></h4>
                        <a href="shop.php?category=headphones" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb"><a href="shop.php?category=graphics"><img src="img/product/gs_popular_item03.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=graphics">Graphics Cards</a></h4>
                        <a href="shop.php?category=graphics" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb"><a href="shop.php?category=keyboards"><img src="img/product/gs_popular_item04.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=keyboards">Gaming Keyboards</a></h4>
                        <a href="shop.php?category=keyboards" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-3 grid-item">
                <div class="gs-category-item style-two mb-20">
                    <div class="thumb"><a href="shop.php?category=accessories"><img src="img/product/gs_popular_item05.jpg" alt=""></a></div>
                    <div class="content">
                        <h4><a href="shop.php?category=accessories">Accessories</a></h4>
                        <a href="shop.php?category=accessories" class="shop-link">Shop Now <i class="fas fa-angle-right"></i></a>
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
                    <h2 class="title">Premium Gaming <span>Equipment</span></h2>
                    <p>Experience the ultimate gaming setup with our carefully selected premium equipment designed for professional gamers.</p>
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
            <?php if(count($featured_products) > 0): ?>
                <?php foreach($featured_products as $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="chair-product-item mb-60">
                        <div class="chair-product-thumb">
                            <img src="<?php echo $product['image'] ?? 'img/product/gaming_chair01.jpg'; ?>" alt="">
                            <a href="add-to-cart.php?id=<?php echo $product['id']; ?>" class="cart">Add to cart <i class="fas fa-shopping-basket"></i></a>
                        </div>
                        <div class="chair-product-content">
                            <div class="chair-product-top-content">
                                <div class="main-content">
                                    <span class="category"><?php echo $product['category'] ?? 'Gaming Gear'; ?></span>
                                    <h5 class="title"><a href="product.php?id=<?php echo $product['id']; ?>"><?php echo $product['name'] ?? 'Premium Gaming Chair'; ?></a></h5>
                                </div>
                                <div class="chair-product-price">
                                    <h5 class="price">$<?php echo $product['price'] ?? '49.00'; ?></h5>
                                </div>
                            </div>
                            <div class="chair-product-bottom">
                                <div class="rating">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                    <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <a href="add-to-wishlist.php?id=<?php echo $product['id']; ?>" class="heart"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default products if database is not set up -->
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="chair-product-item mb-60">
                        <div class="chair-product-thumb">
                            <img src="img/product/gaming_chair01.jpg" alt="">
                            <a href="#" class="cart">Add to cart <i class="fas fa-shopping-basket"></i></a>
                        </div>
                        <div class="chair-product-content">
                            <div class="chair-product-top-content">
                                <div class="main-content">
                                    <span class="category">Gaming Chair</span>
                                    <h5 class="title"><a href="#">STEEL FRAME CHAIR</a></h5>
                                </div>
                                <div class="chair-product-price">
                                    <h5 class="price">$49.00</h5>
                                </div>
                            </div>
                            <div class="chair-product-bottom">
                                <div class="rating">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
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
                                    <span class="category">Gaming Chair</span>
                                    <h5 class="title"><a href="#">DELUX DC-R103</a></h5>
                                </div>
                                <div class="chair-product-price">
                                    <h5 class="price">$29.00</h5>
                                </div>
                            </div>
                            <div class="chair-product-bottom">
                                <div class="rating">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
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
                                    <span class="category">Accessories</span>
                                    <h5 class="title"><a href="#">Gaming Headset Pro</a></h5>
                                </div>
                                <div class="chair-product-price">
                                    <h5 class="price">$39.00</h5>
                                </div>
                            </div>
                            <div class="chair-product-bottom">
                                <div class="rating">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <a href="#" class="heart"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
                    </div>
                    <p>Limited time offer on selected gaming equipment. Don't miss out!</p>
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

