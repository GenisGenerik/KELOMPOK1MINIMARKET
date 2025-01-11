<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "produk_id"=>Produk::factory(),
            "cabang_id"=>Cabang::factory(),
            "user_id"=>User::factory(),
            "status"=> fake()->boolean(),
            "jumlah"=>rand(1,10)
        ];
    }
}
