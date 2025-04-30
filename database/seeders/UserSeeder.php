<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(values: [
                [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'email_verified_at' => now(),
                    'role' => 'admin',
                    'gender' => 'male',
                    'address' => '123 Main St, Springfield, IL',
                    'password' => bcrypt('password123'),
                    'remember_token' => Str::random(60),
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'gender' => 'female',
                    'address' => '456 Oak Rd, Lincoln, NE',
                    'password' => bcrypt('password123'),
                    'remember_token' => Str::random(60),
                ],
                [
                    'name' => 'Mike Johnson',
                    'email' => 'mike.johnson@example.com',
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'gender' => 'male',
                    'address' => '789 Pine St, Madison, WI',
                    'password' => bcrypt('password123'),
                    'remember_token' => Str::random(60),
                ],
                [
                    'name' => 'Sarah Brown',
                    'email' => 'sarah.brown@example.com',
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'gender' => 'female',
                    'address' => '321 Elm Ave, Austin, TX',
                    'password' => bcrypt('password123'),
                    'remember_token' => Str::random(60),
                ],
                [
                    'name' => 'David Williams',
                    'email' => 'david.williams@example.com',
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'gender' => 'male',
                    'address' => '654 Birch Blvd, Miami, FL',
                    'password' => bcrypt('password123'),
                    'remember_token' => Str::random(60),
                ],
            ]

            );
        }
}
