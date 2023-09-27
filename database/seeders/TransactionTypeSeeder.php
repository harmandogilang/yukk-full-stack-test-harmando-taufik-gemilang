<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionType::insert([
            [
                'name' => 'Withdrawal',
                'status' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Deposit',
                'status' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Top-Up',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Transfer',
                'status' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
