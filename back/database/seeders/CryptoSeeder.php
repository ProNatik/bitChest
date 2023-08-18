<?php

namespace Database\Seeders;

use App\Models\Crypto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crypto::factory()
                ->count(10)
                ->sequence(
                    ['name' => 'Bitcoin'],
                    ['name' => 'Ethereum'],
                    ['name' => 'Ripple'],
                    ['name' => 'Bitcoin Cash'],
                    ['name' => 'Cardano'],
                    ['name' => 'Litenoin'],
                    ['name' => 'NEM'],
                    ['name' => 'Stellar'],
                    ['name' => 'IOTA'],
                    ['name' => 'Dash'],
                )
                ->create();
    }
}
