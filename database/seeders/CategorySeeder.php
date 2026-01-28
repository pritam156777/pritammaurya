<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role','admin')->first();

        $categories = ['Electronics','Clothing','Books','Toys','Furniture'];

        foreach($categories as $name){
            Category::create([
                'name'=>$name,
                'admin_id'=>$admin?->id
            ]);
        }
    }
}
