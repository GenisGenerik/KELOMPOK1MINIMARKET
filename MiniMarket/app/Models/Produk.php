<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];
    public function stok():HasMany
    {
        return $this->hasMany(Stok::class,'produk_id');
    }
    public function detailtransaksi():HasMany
    {
        return $this->hasMany(Detailtransaksi::class,'produk_id');
    }
    public function log():HasMany
    {
        return $this->hasMany(Log::class,'produk_id');
    }
}
