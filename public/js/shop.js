// shop.js

$(document).ready(function(){
    // Optional extra animation on hover
    $('.product-cart').hover(function(){
        $(this).css('z-index', '10');
    }, function(){
        $(this).css('z-index', '1');
    });
});
