// Fix for all JavaScript issues
(function($) {
    'use strict';
    
    // Override the problematic menu_bottom_line_active function
    window.menu_bottom_line_active = function() {
        // Do nothing - prevent errors
        return;
    };
    
    // Override menu_bottom_line function
    window.menu_bottom_line = function() {
        // Do nothing - prevent errors
        return;
    };
    
    $(document).ready(function() {
        // Initialize the home seven slider properly
        if ($('.h-seven-slider-active').length > 0) {
            // First destroy any existing slick instance
            if ($('.h-seven-slider-active').hasClass('slick-initialized')) {
                $('.h-seven-slider-active').slick('unslick');
            }
            
            // Re-initialize with proper settings
            $('.h-seven-slider-active').slick({
                dots: true,
                infinite: true,
                speed: 500,
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: false,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: false
                        }
                    }
                ]
            });
        }
        
        // Initialize animations for slider if needed
        if (typeof $.fn.slickAnimation !== 'undefined') {
            $('.h-seven-slider-active').slickAnimation();
        }
        
        // Fix for brand sliders
        if ($('.pz-brand-active').length > 0) {
            $('.pz-brand-active').slick({
                dots: false,
                infinite: true,
                speed: 1000,
                autoplay: true,
                arrows: false,
                slidesToShow: 6,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        
        // Fix gaming chair slider
        if ($('.gaming-chair-active').length > 0) {
            $('.gaming-chair-active').slick({
                dots: false,
                infinite: true,
                speed: 1000,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: false,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
        
        // Fix gs-category-active
        if ($('.gs-category-active').length > 0) {
            $('.gs-category-active').slick({
                dots: false,
                infinite: false,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                variableWidth: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            variableWidth: false
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            variableWidth: false
                        }
                    }
                ]
            });
        }
    });
    
    // Ensure slick is loaded before initializing
    $(window).on('load', function() {
        // Re-init sliders after everything is loaded
        setTimeout(function() {
            if ($('.h-seven-slider-active').length > 0 && !$('.h-seven-slider-active').hasClass('slick-initialized')) {
                $('.h-seven-slider-active').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    arrows: false,
                    fade: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }
        }, 100);
    });
    
})(jQuery);
