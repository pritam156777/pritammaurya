
    $(document).ready(function() {
    const cards = $('.views-shop-index-card');
    const btnDown = $('#views-shop-index-slideDown');
    const btnUp = $('#views-shop-index-slideUp');
    const btnAll = $('#views-shop-index-showAll');

    const step = 4; // Number of cards visible initially

    // Hide all except first 4
    cards.each(function(i){
    if(i >= step) $(this).hide();
});

    // Slide Down
    btnDown.on('click', function() {
    const hiddenCards = cards.filter(':hidden');
    if(hiddenCards.length === 0) return;
    hiddenCards.slice(0, step).slideDown(400);
});

    // Slide Up
    btnUp.on('click', function() {
    const visibleCards = cards.filter(':visible');
    if(visibleCards.length <= step) return;
    visibleCards.slice(-step).slideUp(400);
});

    // Show All / Collapse
    btnAll.on('click', function() {
    if(cards.filter(':hidden').length > 0) {
    cards.slideDown(400);
} else {
    cards.each(function(i){
    if(i >= step) $(this).slideUp(400);
});
}
});

    // Auto toggle button text
    setInterval(function() {
    if(cards.filter(':hidden').length === 0){
    btnAll.find('span').text('Collapse to 4');
} else {
    btnAll.find('span').text('Show All');
}
}, 200);
});

