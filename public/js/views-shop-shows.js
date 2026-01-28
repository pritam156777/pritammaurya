
    $(document).ready(function() {
    const cards = $('.topic-card');
    const btnDown = $('#slideDownBtn');
    const btnUp = $('#slideUpBtn');
    const btnAll = $('#showAllBtn');

    const step = 4; // Number of cards per section
    const minVisible = 4; // Always keep at least 4 cards visible

    // Hide all except first 4
    cards.each(function(i){
    if(i >= minVisible) $(this).hide();
});

    // Slide Down
    btnDown.on('click', function() {
    const hiddenCards = cards.filter(':hidden');
    if(hiddenCards.length === 0) return;

    // Show next 4 or remaining hidden
    hiddenCards.slice(0, step).slideDown(400);
});

    // Slide Up
    btnUp.on('click', function() {
    const visibleCards = cards.filter(':visible');
    if(visibleCards.length <= minVisible) return; // Never go below 4

    // Hide last 4 but keep at least minVisible visible
    const toHide = Math.min(step, visibleCards.length - minVisible);
    visibleCards.slice(-toHide).slideUp(400);
});

    // Show All / Collapse
    btnAll.on('click', function() {
    const hiddenCards = cards.filter(':hidden');
    if(hiddenCards.length > 0) {
    // Show all
    hiddenCards.slideDown(400);
} else {
    // Collapse to minVisible
    cards.each(function(i){
    if(i >= minVisible) $(this).slideUp(400);
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

