@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- ================== CART SECTION ================== --}}
        <div>
            <h1 class="text-3xl font-extrabold mb-6">🛒 Your Cart</h1>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Empty Cart --}}
            @if($cartItems->isEmpty())
                <div class="text-center py-20">
                    <p class="text-xl mb-4">😢 Your cart is empty</p>
                    <a href="{{ route('shop.index') }}"
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg mb-4">
                        Continue Shopping →
                    </a>
                </div>
            @else

                {{-- Cart Table --}}
                <div class="overflow-x-auto bg-white rounded-xl shadow">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr class="border-t">
                                <td class="p-3">
                                    <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://picsum.photos/80' }}"
                                         class="w-16 h-16 object-cover rounded">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                                <td>₹ {{ number_format($item->product->price,2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="font-bold">₹ {{ number_format($item->product->price * $item->quantity,2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Totals --}}
                @php
                    $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
                    $extra = round($subtotal * 0.05,2);
                    $gst = round(($subtotal + $extra) * 0.18,2);
                    $grand = $subtotal + $extra + $gst;
                @endphp

                <div class="mt-8 max-w-md ml-auto bg-gray-50 p-6 rounded-xl">

                    <div class="flex justify-between mb-2 text-gray-700 text-base font-medium">
                        <span>Subtotal</span>
                        <span>₹ {{ number_format($subtotal,2) }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-700 text-base font-medium">
                        <span>Extra (5%)</span>
                        <span>₹ {{ number_format($extra,2) }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-700 text-base font-medium">
                        <span>GST (18%)</span>
                        <span>₹ {{ number_format($gst,2) }}</span>
                    </div>

                    <hr class="my-4 border-gray-300">

                    <div class="flex justify-between mb-4 text-gray-800 text-lg font-bold">
                        <span>Total</span>
                        <span>₹ {{ number_format($grand,2) }}</span>
                    </div>

                    {{-- ================== PAYMENT SECTION ================== --}}
                    <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <input type="hidden" name="payment_method" id="payment_method">
                        <input type="hidden" name="payment_intent_id" id="payment_intent_id">
                        <input type="hidden" name="grand_total" value="{{ $grand }}">

                        <h3 class="font-semibold mb-2">💳 Choose Payment Method</h3>
                        <div class="flex flex-col space-y-2 mb-4">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="payment_method" value="cash" checked class="payment-radio">
                                <span>Cash on Delivery</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="payment_method" value="credit_card" class="payment-radio">
                                <span>Credit Card</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="payment_method" value="debit_card" class="payment-radio">
                                <span>Debit Card</span>
                            </label>
                        </div>

                        {{-- Card Fields --}}
                        <div id="cardFields" style="display: none;" class="flex flex-col space-y-2 mb-4">
                            <input type="text" name="card_number" placeholder="Card Number" maxlength="16" class="p-2 border rounded">
                            <input type="text" name="expiry" placeholder="MM/YY" maxlength="5" class="p-2 border rounded">
                            <input type="text" name="cvv" placeholder="CVV" maxlength="3" class="p-2 border rounded">
                        </div>

                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold flex items-center justify-center space-x-2">
                            🛒 Place Order
                        </button>
                    </form>

                </div>
            @endif
        </div>

        <hr class="my-12">

        {{-- ================== ADD MORE PRODUCTS ================== --}}
        <div>
            <h2 class="text-3xl font-extrabold mb-6">🛍️ Add More Products</h2>

            <div class="products-wrapper grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($allProducts as $product)
                    <div class="product-card bg-white shadow rounded p-4 flex flex-col items-center text-center">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/200' }}" class="mb-3 rounded">
                        <h4 class="font-semibold">{{ $product->name }}</h4>
                        <p class="category text-gray-500 mb-1">{{ $product->category->name ?? '' }}</p>
                        <p class="price font-bold mb-2">₹ {{ number_format($product->price,2) }}</p>
                        <form method="POST" action="{{ route('cart.add', $product->uuid) }}">
                            @csrf
                            <button type="submit" class="button-submit flex items-center space-x-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@push('scripts')
    <script>
        window.stripePublicKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Toggle card fields for credit/debit
            $('.payment-radio').on('change', function() {
                if ($(this).val() === 'credit_card' || $(this).val() === 'debit_card') {
                    $('#cardFields').slideDown();
                } else {
                    $('#cardFields').slideUp();
                }
            });
        });
    </script>
@endpush
