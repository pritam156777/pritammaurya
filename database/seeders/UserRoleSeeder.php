<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'pritam156777@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        $admin = User::create([
            'name' => 'Store Admin',
            'email' => 'storeadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'created_by' => $superAdmin->id,
        ]);

        User::create([
            'name' => 'Store User',
            'email' => 'storeuser@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'created_by' => $admin->id,
        ]);

    }
}
