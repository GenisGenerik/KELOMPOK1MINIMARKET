<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cabang extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    public function stok() :HasMany{
        return $this->hasMany(Stok::class,'cabang_id');
    }
    public function transaksi() :HasMany{
        return $this->hasMany(Transaksi::class,'cabang_id');
    }
    public function user():HasOne
    {
        return $this->hasOne(User::class,'cabang_id');
    }
    public function log() :HasMany
    {
        return $this->hasMany(Log::class,'cabang_id');
    }


}
