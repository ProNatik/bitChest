<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
                ->count(6)
                ->sequence(
                    ['username' => 'root'],
                    ['username' => 'nathan'],
                    ['username' => 'arigna'],
                    ['username' => 'adel'],
                    ['username' => 'vincent'],
                    ['username' => 'alexi'],
                )
                ->has(Wallet::factory()->count(1))
                ->create();
    }
}
