<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankAccount::insert([
            [
                'user_id' => 1,
                'bank_id' => 1,
                'account_number' => '0123456',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'bank_id' => 1,
                'account_number' => '0123100',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'bank_id' => 2,
                'account_number' => '0223100',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
