<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BYNODE extends Model
{
    protected $table      = 'BYNODE';
    public $timestamps    = false;
    protected $fillable   = [
        'ISLEM',
        'ISLEMTARIHI',
        'ACIKLAMA'
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->islemtarihi = date('d/m/Y H:i:s');
        });
    }
}
