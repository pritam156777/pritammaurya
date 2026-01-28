<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product.category'])
            ->where('user_id', auth()->id())
            ->get();

        $allProducts = Product::with('category')
            ->where('is_active', 1)
            ->get();

        return view('cart.index', compact('cartItems', 'allProducts'));
    }
    public function add(Request $request, $uuid)
    {
        // 1️⃣ User must be logged in
        $userId = auth()->id();

        // 2️⃣ Find product by UUID
        $product = Product::where('uuid', $uuid)->firstOrFail();

        // 3️⃣ Quantity (default = 1)
        $quantity = $request->quantity ?? 1;

        // 4️⃣ Add or update cart
        Cart::updateOrCreate(
            [
                'user_id' => $userId,
                'product_id' => $product->id,
            ],
            [
                'quantity' => DB::raw('quantity + '.$quantity),
            ]
        );

        return redirect()->route('cart.index')->with('success', '🛒 Product added to cart!');
    }

    // ✅ Remove a product from the cart
    public function remove(Product $product)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->route('cart.index')->with('success', $product->name.' removed from cart!');
    }




    public function checkout()
    {
        return view('cart.checkout'); // We'll create this Blade view
    }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->amount ?? 5000; // Amount in cents, e.g., ₹50 => 5000 paise

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'inr', // your currency
            'payment_method_types' => ['card', 'apple_pay', 'google_pay'], // Wallets supported
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
}
