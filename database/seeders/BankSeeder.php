<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::insert([
            [
                'name' => 'Bank Central Asia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bank Mandiri',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
