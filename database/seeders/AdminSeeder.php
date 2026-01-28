<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Get Super Admin
        $superAdmin = User::where('role', 'super_admin')->first();

        if (! $superAdmin) {
            $this->command->error('❌ Super Admin not found. Run SuperAdminSeeder first.');
            return;
        }

        // ✅ Admin data
        $adminsData = [
            ['name' => 'Store Admin 1', 'email' => 'storeadmin1@example.com'],
            ['name' => 'Store Admin 2', 'email' => 'storeadmin2@example.com'],
            ['name' => 'Store Admin 3', 'email' => 'storeadmin3@example.com'],
            ['name' => 'Store Admin 4', 'email' => 'storeadmin4@example.com'],
        ];

        foreach ($adminsData as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'role' => 'admin',
                    'created_by' => $superAdmin->id, // link to Super Admin
                ]
            );
        }

        $this->command->info('✅ Admins created successfully.');
    }
}
