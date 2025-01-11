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
        Schema::create('detailtransaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis','id','dtransaksi_transaksi_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('produk_id')->constrained('produks','id','dtransaksi_produk_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailtransaksis');
    }
};
