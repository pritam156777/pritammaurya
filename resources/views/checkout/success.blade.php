@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12 text-center">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-4xl font-bold text-green-600">✅ Order Placed Successfully!</h1>
        <p class="mt-4 text-lg">Thank you, {{ $order->user->name }}! Your order <strong>{{ $order->order_number }}</strong> has been placed.</p>

        <div class="mt-6 text-left max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Order Summary:</h2>
            <ul>
                @foreach($order->items as $item)
                    <li class="flex justify-between mb-2">
                        <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                        <span>₹ {{ number_format($item->total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
            <hr class="my-2">
            <p class="flex justify-between"><strong>Subtotal:</strong> <span>₹ {{ number_format($order->subtotal, 2) }}</span></p>
            <p class="flex justify-between"><strong>Extra Charge:</strong> <span>₹ {{ number_format($order->extra_charge, 2) }}</span></p>
            <p class="flex justify-between"><strong>GST:</strong> <span>₹ {{ number_format($order->gst, 2) }}</span></p>
            <p class="flex justify-between text-lg font-bold mt-2"><strong>Total:</strong> <span>₹ {{ number_format($order->total_amount, 2) }}</span></p>
        </div>

        <a href="{{ route('shop.index') }}" class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Continue Shopping →
        </a>
    </div>
@endsection
