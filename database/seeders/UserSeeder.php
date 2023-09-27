<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'User 1',
                'email' => 'user1@domain.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@domain.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
