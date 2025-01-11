<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detailtransaksi extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_id','produk_id','jumlah'];
    protected $with = ['transaksi','produk'];
    public function transaksi():BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function produk():BelongsTo
    {
            return $this->belongsTo(Produk::class);
    }
}
