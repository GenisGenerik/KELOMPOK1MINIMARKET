<?php

namespace App\Models;

use App\StatusBarangEnum;
use App\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'produk_id','cabang_id','jumlah','status','user_id'
        ];
        protected $casts = [
            'status'=> StatusBarangEnum::class,
        ];
       protected $with = ['produk','cabang','user'];
        public function produk():BelongsTo
        {
            return $this->belongsTo(Produk::class);
        }
        public function cabang():BelongsTo
        {
            return $this->belongsTo(Cabang::class);
        }
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

}
