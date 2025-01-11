<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cabang_id'=>Cabang::factory(),
            'user_id'=>User::factory(),
            'tanggal'=>fake()->date()
        ];
    }
}
