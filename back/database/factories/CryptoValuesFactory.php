<?php

namespace Database\Factories;

use App\Models\Crypto;
use App\Utils\Helpers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CryptoValuesFactory extends Factory
{

    protected static $index = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = Carbon::now()->subDays($this::$index);
        $this::$index += 1;
        if ($this::$index === 30) {
            $this::$index = 0;
        }
        return [
            "crypto_id" => Crypto::factory(),
            "date" => $date,
        ];
    }

    public function generateQuoting(): Factory
    {
        if ($this::$index === 0) {
            $this->state(function (array $att, Crypto $crypto) {
                return ["value" => Helpers::getFirstCotation($crypto->name)];
            });
        }
        return $this->state(function (array $att, Crypto $crypto) {
            return ["value" => Helpers::getCotationFor($crypto->name)];
        });
    }
}
