<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crypto>
 */
class CryptoFactory extends Factory
{
    protected static $index = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Bitcoin',
            'Ethereum',
            'Ripple',
            'Bitcoin Cash',
            'Cardano',
            'Litenoin',
            'NEM',
            'Stellar',
            'IOTA',
            'Dash'
        ];
        $crypto_name = $names[$this::$index];
        $this::$index += 1;
        return [
            'name' => $crypto_name,
        ];
    }
}
