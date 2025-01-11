<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks','id','stok_produk_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cabang_id')->constrained('cabangs','id','stok_cabang_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->timestamps();
            // $table->unique(['produk_id', 'cabang_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
