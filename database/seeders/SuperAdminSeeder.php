<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Create single Super Admin
        User::updateOrCreate(
            ['email' => 'pritam156777@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'created_by' => null, // top level
            ]
        );

        $this->command->info('✅ Super Admin created successfully.');
    }
}
