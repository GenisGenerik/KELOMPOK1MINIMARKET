<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\Stok;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Detailtransaksi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan RoleSeeder terlebih dahulu
        $this->call(RoleSeeder::class);

        // Buat 5 cabang
        Cabang::factory(5)->create();

        // Buat user khusus 'Jaysuman' untuk cabang_id 1
        User::factory()->create([
            'name' => 'Jaysuman',
            'cabang_id' => 1
        ])->assignRole('jayusman');

        // Buat 50 produk
        $produk = Produk::factory(50)->create();

        // Untuk setiap cabang, buat user dan relasi terkait
        Cabang::all()->each(function ($cabang) use ($produk) {
            // Daftar role yang akan digunakan
            $roles = ['manager', 'supervisor', 'kasir', 'gudang'];

            foreach ($roles as $role) {
                // Buat user untuk setiap role
                $user = User::factory()->create(['cabang_id' => $cabang->id]);
                $user->assignRole($role);

                // Jika role adalah 'kasir', buat transaksi dan detail transaksi
                if ($role === 'kasir') {
                    Transaksi::factory(20)->create([
                        'cabang_id' => $cabang->id,
                        'user_id' => $user->id,
                    ])->each(function ($transaksi) use ($produk) {
                        // Buat detail transaksi
                        Detailtransaksi::factory(5)->make([
                            'transaksi_id' => $transaksi->id,
                            'produk_id' => $produk->random()->id,
                        ])->each(function ($detail) {
                            $detail->save();
                        });
                    });
                }

                // Jika role adalah 'gudang', buat log untuk setiap produk
                if ($role === 'gudang') {
                    $produk->each(function ($product) use ($cabang, $user) {
                        Log::factory()->create([
                            'cabang_id' => $cabang->id,
                            'user_id' => $user->id,
                            'produk_id' => $product->id,
                        ]);
                    });
                }
            }

            // Buat stok untuk setiap produk di setiap cabang
            $produk->each(function ($product) use ($cabang) {
                Stok::factory()->create([
                    'cabang_id' => $cabang->id,
                    'produk_id' => $product->id,
                ]);
            });
        });

       
    }
}
