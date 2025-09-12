        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <footer class="home-six-footer">
            <div class="footer-top footer-bg">
                <!-- newsletter-area -->
                <div class="newsletter-area s-newsletter-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="newsletter-wrap">
                                    <div class="section-title newsletter-title">
                                        <h2>Our <span>Newsletter</span></h2>
                                    </div>
                                    <div class="newsletter-form">
                                        <form action="newsletter.php" method="POST">
                                            <div class="newsletter-form-grp">
                                                <i class="far fa-envelope"></i>
                                                <input type="email" name="email" placeholder="Enter your email..." required>
                                            </div>
                                            <button type="submit" name="subscribe">SUBSCRIBE <i class="fas fa-paper-plane"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- newsletter-area-end -->
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-widget mb-50">
                                <div class="footer-logo mb-35">
                                    <a href="home.php"><img src="img/logo/w_h6_logo.png" alt="" style="width: 120px;"></a>
                                </div>
                                <div class="footer-text">
                                    <p>Your ultimate gaming platform for tournaments, community, and more.</p>
                                    <div class="footer-contact">
                                        <ul>
                                            <li><i class="fas fa-map-marker-alt"></i> <span>Address : </span>123 Gaming Street, New York, NY 10001</li>
                                            <li><i class="fas fa-headphones"></i> <span>Phone : </span>+1 234 567 8900</li>
                                            <li><i class="fas fa-envelope-open"></i><span>Email : </span>info@hoqqdmd.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title mb-35">
                                    <h5>Quick Links</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="games.php">Games</a></li>
                                        <li><a href="tournaments.php">Tournaments</a></li>
                                        <li><a href="community.php">Community</a></li>
                                        <li><a href="shop.php">Store</a></li>
                                        <li><a href="blog.php">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title mb-35">
                                    <h5>Need Help?</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="terms.php">Terms & Conditions</a></li>
                                        <li><a href="privacy.php">Privacy Policy</a></li>
                                        <li><a href="refund.php">Refund Policy</a></li>
                                        <li><a href="affiliate.php">Affiliate</a></li>
                                        <li><a href="faq.php">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title mb-35">
                                    <h5>Contact Us</h5>
                                </div>
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="https://t.me/hoqqdmdhack" target="_blank" title="Telegram"><i class="fab fa-telegram"></i></a></li>
                                        <li><a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="https://youtube.com/@hoqqdmd?si=v52Z_8aKJiy-ICiA" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <div class="footer-contact-info" style="margin-top: 20px;">
                                    <p style="color: #aaa; font-size: 14px; margin-bottom: 10px;">Get in touch for instant support:</p>
                                    <ul style="list-style: none; padding: 0;">
                                        <li style="margin-bottom: 8px;"><a href="https://t.me/hoqqdmdhack" target="_blank" style="color: #00d4ff; text-decoration: none;"><i class="fab fa-telegram"></i> @hoqqdmdhack</a></li>
                                        <li style="margin-bottom: 8px;"><a href="https://chat.whatsapp.com/JYHU6uidE4N3uwgUY1i6Fo" target="_blank" style="color: #00d4ff; text-decoration: none;"><i class="fab fa-whatsapp"></i> WhatsApp Group</a></li>
                                        <li style="margin-bottom: 8px;"><a href="https://youtube.com/@hoqqdmd?si=v52Z_8aKJiy-ICiA" target="_blank" style="color: #00d4ff; text-decoration: none;"><i class="fab fa-youtube"></i> @hoqqdmd</a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php if(!isLoggedIn()): ?>
                            <div class="footer-widget mb-50">
                                <div class="fw-title mb-35">
                                    <h5>Newsletter Sign Up</h5>
                                </div>
                                <div class="footer-newsletter">
                                    <form action="newsletter.php" method="POST">
                                        <input type="email" name="email" placeholder="Enter your email" required>
                                        <button type="submit" name="quick_subscribe"><i class="fas fa-rocket"></i></button>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="footer-fire"><img src="img/images/footer_fire.png" alt=""></div>
                <div class="footer-fire footer-fire-right"><img src="img/images/footer_fire.png" alt=""></div>
            </div>
            <div class="copyright-wrap s-copyright-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="copyright-text">
                                <p>Copyright © <?php echo date('Y'); ?> <a href="home.php">HOQQDMD</a> All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-md-block">
                            <div class="payment-method-img text-right">
                                <img src="img/images/card_img.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-area-end -->

        <!-- JS here -->
        <script src="js/vendor/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/jquery.meanmenu.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.lettering.js"></script>
        <script src="js/jquery.textillate.js"></script>
        <script src="js/jquery.odometer.min.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/fix-all.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

