$(document).ready(function () {
    const $slider = $('#imageSlider');
    const itemWidth = $slider.find('div').outerWidth(true); // width including margin
    const visibleItems = 5; // show 5 items at a time
    const scrollAmount = itemWidth * visibleItems; // scroll 5 items per click

    let scrollPosition = 0;

    $('#nextSlide').click(function () {
        const maxScroll = $slider[0].scrollWidth - $slider.outerWidth();
        scrollPosition = Math.min(scrollPosition + scrollAmount, maxScroll);
        $slider.animate({ scrollLeft: scrollPosition }, 500);
    });

    $('#prevSlide').click(function () {
        scrollPosition = Math.max(scrollPosition - scrollAmount, 0);
        $slider.animate({ scrollLeft: scrollPosition }, 500);
    });
});
