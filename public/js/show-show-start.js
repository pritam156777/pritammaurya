// Make sure jQuery is loaded
$(document).ready(function () {

    console.log("show-show-start.js loaded and jQuery is working");

    /* -----------------------------------
       IMAGE HOVER PARALLAX EFFECT
    ----------------------------------- */

    $('.product-image').removeAttr('style');
    /* -----------------------------------
       ADD TO CART CLICK EFFECT
    ----------------------------------- */
    $('.btn-primary').on('click', function () {
        const btn = $(this);

        btn.addClass('loading');
        btn.text('Adding...');

        setTimeout(() => {
            btn.text('Added ✔');
        }, 600);
    });

    /* -----------------------------------
       BUTTON RIPPLE EFFECT
    ----------------------------------- */
    $('.btn-primary, .btn-secondary').on('click', function (e) {
        const btn = $(this);
        const ripple = $('<span class="ripple"></span>');

        btn.append(ripple);

        const x = e.pageX - btn.offset().left;
        const y = e.pageY - btn.offset().top;

        ripple.css({ top: y, left: x });

        setTimeout(() => ripple.remove(), 600);
    });

});
