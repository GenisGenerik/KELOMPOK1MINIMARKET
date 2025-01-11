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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks','id','log_produk_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cabang_id')->constrained('cabangs','id','log_cabang_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users','id','log_user_index')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
