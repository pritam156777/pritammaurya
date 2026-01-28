// Ensure jQuery is loaded before this script
$(document).ready(function() {

    // Auto-hide flash messages after 5 seconds
    $('#flash-messages .flash-message').each(function() {
        const $msg = $(this);
        setTimeout(function() {
            $msg.fadeOut(600, function() {
                $msg.remove();
            });
        }, 5000); // 5 seconds
    });

    // Close button functionality
    $('#flash-messages .close-btn').click(function() {
        $(this).closest('.flash-message').fadeOut(400, function() {
            $(this).remove();
        });
    });

});
