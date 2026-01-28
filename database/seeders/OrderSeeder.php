<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role','user')->first();
        if (!$user) {
            $this->command->info("No user found. Please create a user first.");
            return;
        }

        $products = Product::all();
        if ($products->isEmpty()) {
            $this->command->info("No products found. Please seed products first.");
            return;
        }

        for ($i=1; $i<=3; $i++) {

            // Random subtotal from 2-4 products
            $selectedProducts = $products->random(rand(2,4));
            $subtotal = $selectedProducts->sum(fn($p) => $p->price);

            $extraCharge = $subtotal * 0.05;
            $gst = ($subtotal + $extraCharge) * 0.18;
            $totalAmount = $subtotal + $extraCharge + $gst;

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD'.Str::upper(Str::random(6)),
                'subtotal' => $subtotal,
                'extra_charge' => $extraCharge,
                'gst' => $gst,
                'total_amount' => $totalAmount,
                'payment_method' => ['cash','credit_card','debit_card'][array_rand(['cash','credit_card','debit_card'])],
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(rand(1,10)),
                'updated_at' => Carbon::now(),
            ]);

            // Add order items
            foreach ($selectedProducts as $product) {
                $quantity = rand(1,3);
                $price = $product->price;
                $gst_item = $price * 0.18;
                $total_item = ($price + $gst_item) * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'gst' => $gst_item,
                    'total' => $total_item,
                    'created_at' => Carbon::now()->subDays(rand(1,10)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $this->command->info("3 orders with multiple items created successfully!");
    }
}
