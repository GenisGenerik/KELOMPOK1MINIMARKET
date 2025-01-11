<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id','cabang_id','jumlah'] ;
    protected $with = ['produk','cabang'];
    public function produk() :BelongsTo
    {
        return $this->belongsTo(Produk::class);

    }
    public function cabang() : BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

}
