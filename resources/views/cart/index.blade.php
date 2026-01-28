@extends('layouts.app')


@section('content')
    {{-- ================== Stripe SDK ================== --}}
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripePublicKey = "{{ config('services.stripe.key') }}"; // Your products key
        const createPaymentIntentUrl = "{{ route('cart.createPaymentIntent') }}"; // Route to create PaymentIntent
        const checkoutStoreUrl = "{{ route('checkout.store') }}"; // Checkout store route
    </script>

    <div class="max-w-7xl mx-auto px-6 py-12 checkout-container">

        {{-- Flash message --}}
        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div id="errorBox" class="error hidden"></div>

        <h1 class="checkout-title">🛒 Your Cart</h1>

        {{-- Empty Cart --}}
        @if($cartItems->isEmpty())
            <div class="text-center py-20">
                <p class="text-xl mb-4">😢 Your cart is empty</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg">Continue Shopping →</a>
            </div>
        @else
            {{-- ================== Cart Table ================== --}}
            <div class="cart-box overflow-x-auto bg-white rounded-xl shadow mb-8">
                <table class="cart-table w-full text-sm">
                    <thead class="bg-gray-100">
                    <tr>
                        <th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Qty</th><th>Total</th><th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $item)
                        <tr class="border-t">
                            <td>
                                <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://picsum.photos/80' }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                            <td>₹ {{ number_format($item->product->price,2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="font-bold">₹ {{ number_format($item->product->price * $item->quantity,2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->product->uuid) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline flex items-center gap-1">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ================== Totals ================== --}}
            @php
                $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
                $extra = round($subtotal * 0.05,2);
                $gst = round(($subtotal + $extra) * 0.18,2);
                $grand = $subtotal + $extra + $gst;
            @endphp

            <div class="max-w-md ml-auto bg-gray-50 p-6 rounded-xl shadow">
                <div class="flex justify-between mb-2"><span>Subtotal</span><span>₹ {{ number_format($subtotal,2) }}</span></div>
                <div class="flex justify-between mb-2"><span>Extra (5%)</span><span>₹ {{ number_format($extra,2) }}</span></div>
                <div class="flex justify-between mb-2"><span>GST (18%)</span><span>₹ {{ number_format($gst,2) }}</span></div>
                <hr class="my-4">
                <div class="flex justify-between font-bold text-lg"><span>Total</span><span>₹ {{ number_format($grand,2) }}</span></div>

                {{-- ================== Checkout Form ================== --}}
                <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <input type="hidden" name="grand_total" value="{{ $grand }}">
                    <input type="hidden" name="payment_method" id="payment_method" value="stripe">
                    {{--<input type="hidden" name="payment_method" id="payment_method" value="card">--}}
                    <input type="hidden" name="payment_intent_id" id="payment_intent_id">

                    <h2 class="mb-4 text-xl font-bold">Payment Options</h2>

                    {{-- Payment Tabs --}}
                    <div class="flex mb-6 border-b border-gray-300">
                        <button type="button" class="payment-tab px-4 py-2 border-b-2 border-blue-600 text-blue-600 font-medium" data-method="stripe">💳 Credit / Debit Card</button>
                        <button type="button" class="payment-tab px-4 py-2 ml-2 text-gray-600 font-medium" data-method="cash">🏦 Pay Cash</button>
                    </div>

                    {{-- Stripe Card Element --}}
                    <div id="stripePayment" class="payment-method mb-6">
                        <label class="block mb-2 font-medium">Credit or debit card:</label>
                        <div id="card-element" class="p-4 border rounded shadow-sm bg-white"></div>
                        <div id="card-errors" class="text-red-600 mt-2"></div>
                    </div>

                    {{-- Cash Payment --}}
                    <div id="cashPayment" class="payment-method hidden mb-6 p-4 border rounded bg-yellow-50">
                        <p class="text-gray-700">You will pay in cash upon delivery. ✅</p>
                    </div>

                    <div class="space-y-6">
                        <!-- Pay Button (Full Width, Blue) -->
                        <button type="submit" id="payButton"  style="background: linear-gradient(135deg, #6366f1, #8b5cf6);color: white" class="w-full  text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            💳 Pay
                        </button>

                        <!-- Go Back & Go Home Buttons (Same Row) -->
                        <div class="flex gap-4">
                            <!-- Go Back Button -->
                            <a href="{{ url()->previous() }}" style="background: linear-gradient(135deg, #5bc296, #ac560bbf);color: white" class="flex-1 flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-100 transition duration-300 transform hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Go Back
                            </a>

                            <!-- Go to Home Page Button -->
                            <a href="{{ route('home') }}" class="flex-1 flex items-center justify-center gap-2  border  text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-300 transform hover:-translate-y-1" style="background: linear-gradient(135deg, #bf8149, #60b907);;color: white" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-5H9v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9z" />
                                </svg>
                                Go to Home Page
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        @endif
    </div>

    {{-- ================== Styles & Scripts ================== --}}
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>


@endsection
