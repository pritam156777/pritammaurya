<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Get all Admins
        $admins = User::where('role', 'admin')->get();

        if ($admins->isEmpty()) {
            $this->command->error('❌ No admins found. Run AdminSeeder first.');
            return;
        }

        foreach ($admins as $admin) {
            // ✅ Create 3 users per admin
            for ($i = 1; $i <= 3; $i++) {
                $name = $admin->name . " User $i";
                $email = strtolower(str_replace(' ', '', $admin->name)) . "user$i@example.com";

                User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $name,
                        'password' => Hash::make('password123'),
                        'role' => 'user',
                        'created_by' => $admin->id, // link to Admin
                    ]
                );
            }
        }

        $this->command->info('✅ Users created successfully.');
    }
}
