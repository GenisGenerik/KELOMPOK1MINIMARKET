<?php

namespace Database\Factories;

use App\Models\Stok;
use App\Models\Cabang;
use App\Models\Produk;
use Database\Seeders\CabangSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stok>
 */
class StokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $produk = Produk::inRandomOrder()->first();
            $cabang = Cabang::inRandomOrder()->first();
        } while (Stok::where("produk_id", $produk->id)->where("cabang_id", $cabang->id)->exists());
        return [
            'produk_id'=>$produk->id,
            'cabang_id'=>$cabang->id,
            'jumlah'=>rand(1,10)
        ];
    }
}
