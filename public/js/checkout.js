$(document).ready(function() {

    $('.payment-tab').click(function() {
        var method = $(this).data('method');
        $('.payment-tab').removeClass('border-blue-600 text-blue-600').addClass('text-gray-600 border-transparent');
        $(this).addClass('border-blue-600 text-blue-600');

        if(method === 'stripe'){
            $('#stripePayment').removeClass('hidden');
            $('#cashPayment').addClass('hidden');
            $('#payment_method').val('stripe'); // ✅ match DB
        } else {
            $('#stripePayment').addClass('hidden');
            $('#cashPayment').removeClass('hidden');
            $('#payment_method').val('cash');
        }
    });

    const stripe = Stripe(stripePublicKey);
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    card.on('change', function(event) {
        if(event.error) {
            $('#card-errors').text(event.error.message);
        } else {
            $('#card-errors').text('');
        }
    });

    $('#checkoutForm').submit(async function(e) {
        e.preventDefault();
        const payButton = $('#payButton');
        payButton.prop('disabled', true).text('Processing...');
        const form = $(this);

        if($('#payment_method').val() === 'cash') {
            form.off('submit');
            form.attr('method','POST');
            form.attr('action', checkoutStoreUrl);
            form.submit();
            return;
        }

        try {
            const response = await fetch(createPaymentIntentUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({grand_total: form.find('input[name="grand_total"]').val()})
            });

            const data = await response.json();
            if(data.error){
                $('#card-errors').text(data.error);
                payButton.prop('disabled', false).text('Pay');
                return;
            }

            const result = await stripe.confirmCardPayment(data.clientSecret, {
                payment_method: { card: card }
            });

            if(result.error){
                $('#card-errors').text(result.error.message);
                payButton.prop('disabled', false).text('Pay');
            } else {
                $('#payment_intent_id').val(result.paymentIntent.id);
                form.off('submit');
                form.attr('method','POST');
                form.attr('action', checkoutStoreUrl);
                form.submit();
            }

        } catch(err){
            console.error(err);
            $('#card-errors').text('Something went wrong. Try again.');
            payButton.prop('disabled', false).text('Pay');
        }
    });

});
