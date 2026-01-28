<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get admin
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->info("No admin found. Please create an admin first.");
            return;
        }

        // Categories
        $categories = ['Fruits', 'Vegetables', 'Dairy', 'Bakery', 'Meals', 'Desserts'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        // Products
        $products = [
            ['Fruits','Apple','Fresh red apples',180,'12.jpg'],
            ['Fruits','Banana','Fresh bananas',50,'13.jpg'],
            ['Vegetables','Potato','Farm fresh potatoes',30,'14.jpg'],
            ['Vegetables','Tomato','Organic tomatoes',40,'15.jpg'],
            ['Dairy','Milk','Pure cow milk',60,'16.jpg'],
            ['Bakery','Bread','Soft bread loaf',40,'17.jpg'],
            ['Meals','Biryani','Chicken biryani',180,'18.jpg'],
            ['Desserts','Ice Cream','Vanilla ice cream',40,'19.jpg'],
            ['Fruits','Mango','Sweet mangoes',120,'20.jpg'],
            ['Vegetables','Carrot','Fresh carrots',50,'21.jpg'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p[0])->first();

            Product::create([
                'admin_id' => $admin->id,
                'category_id' => $category->id,
                'name' => $p[1],
                'description' => $p[2],
                'price' => $p[3],
                'stock' => rand(50,200),
                'is_active' => 1,
                'image' => $p[4],
            ]);
        }

        $this->command->info("10 products created successfully!");
    }
}
