<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['cabang_id','user_id','tanggal'];
    protected $with = ['user','cabang'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cabang(){
        return $this->belongsTo(Cabang::class);
    }
    public function detailtransaksi():HasMany{
        return $this->hasMany(Detailtransaksi::class,'transaksi_id');
    }


}
