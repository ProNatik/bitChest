<?php

namespace Database\Seeders;

use App\Models\Crypto;
use App\Models\CryptoValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptoValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crypto::factory(10)
            ->has(
                CryptoValues::factory()
                    ->count(30)
                    ->generateQuoting(),
            )
            ->create();
    }
}
