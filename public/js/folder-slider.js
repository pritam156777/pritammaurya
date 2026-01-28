$(document).ready(function () {

    const slider = $('#folderSlider');
    const itemWidth = 200;
    let current = 0;

    $('#nextFolder').on('click', function () {
        const max = slider[0].scrollWidth - slider.outerWidth();
        current += itemWidth * 5;
        if (current > max) current = max;
        slider.animate({ scrollLeft: current }, 400);
    });

    $('#prevFolder').on('click', function () {
        current -= itemWidth * 5;
        if (current < 0) current = 0;
        slider.animate({ scrollLeft: current }, 400);
    });

});


