// Fix for menu errors
$(document).ready(function() {
    // Add 'show' class to the first menu item if none exists
    if ($('#mobile-menu > ul > li.show').length === 0) {
        $('#mobile-menu > ul > li:first').addClass('show');
    }
    
    // Also check for navbar-wrap menu
    if ($('.navbar-wrap > ul > li.show').length === 0 && $('.navbar-wrap > ul > li').length > 0) {
        $('.navbar-wrap > ul > li:first').addClass('show');
    }
    
    // Add active class to current page menu item
    var currentPage = window.location.pathname.split('/').pop();
    if (currentPage === '' || currentPage === 'index.php') {
        currentPage = 'home.php';
    }
    
    $('.navbar-wrap a').each(function() {
        var href = $(this).attr('href');
        if (href === currentPage) {
            $(this).parent('li').addClass('show active');
        }
    });
});
