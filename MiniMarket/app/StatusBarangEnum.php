<?php

namespace App;

enum StatusBarangEnum : int
{
case Masuk = 1;
case Keluar = 0;

public function label()
{
    return $this === self::Masuk ? 'Masuk' : 'Keluar';
}
}
