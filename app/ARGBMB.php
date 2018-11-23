<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ARGBMB extends Model
{
    protected $table      = 'ARGBMB';
    protected $fillable   = [
        'GONDERILDI',
        'ISLEM',
        'ISLEMTARIH'
    ];
}
