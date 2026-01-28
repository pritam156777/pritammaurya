@extends('layouts.app')

@section('content')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const STRIPE_PUBLIC_KEY = "{{ config('services.stripe.key') }}";
    </script>

    <div class="max-w-6xl mx-auto px-6 py-10">

        <h1 class="text-3xl font-bold mb-6">🛒 Secure Checkout</h1>

        {{-- ORDER SUMMARY --}}
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            @php
                $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
                $extra = round($subtotal * 0.05,2);
                $gst = round(($subtotal + $extra) * 0.18,2);
                $grand = $subtotal + $extra + $gst;
            @endphp

            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between"><span>Subtotal</span><span>₹ {{ number_format($subtotal,2) }}</span></div>
                <div class="flex justify-between"><span>Extra</span><span>₹ {{ number_format($extra,2) }}</span></div>
                <div class="flex justify-between"><span>GST</span><span>₹ {{ number_format($gst,2) }}</span></div>
                <hr>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>₹ {{ number_format($grand,2) }}</span>
                </div>
            </div>
        </div>

        {{-- PAYMENT --}}
        <div class="bg-gray-50 rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">💳 Card Payment</h2>

         {{--   <form id="payment-form">
                <input type="hidden" id="amount" value="{{ $grand * 100 }}">

                --}}{{-- SAME LINE --}}{{--
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input id="card_name" class="input" placeholder="Card Holder Name" required>
                    <input id="card_number" class="input" placeholder="Card Number" maxlength="19" required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input id="expiry" class="input" placeholder="MM/YY" maxlength="5" required>
                    <input id="cvv" class="input" placeholder="CVV" maxlength="3" required>
                </div>

                --}}{{-- STRIPE ELEMENT --}}{{--
                <div id="stripe-card" class="p-4 bg-white rounded border mb-4"></div>

                <button id="payBtn" type="submit"
                        class="w-full bg-black text-white py-3 rounded-lg text-lg font-semibold opacity-50 cursor-not-allowed"
                        disabled>
                    🔒 Pay & Place Order
                </button>
            </form>
--}}


            <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <input type="hidden" name="grand_total" value="{{ $grand }}">
                <input type="hidden" name="payment_method" id="payment_method" value="stripe">
                <input type="hidden" name="payment_intent_id" id="payment_intent_id">

                <label class="block mb-2 font-medium">Card Payment:</label>
                <div id="card-element" class="p-4 bg-white rounded border mb-4"></div>
                <div id="card-errors" class="text-red-600 mb-4"></div>

                <button type="submit" id="payButton"
                        class="w-full bg-black text-white py-3 rounded-lg text-lg font-semibold">
                    🔒 Pay & Place Order
                </button>
            </form>

            <div id="payment-message" class="mt-4 text-red-600"></div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection
