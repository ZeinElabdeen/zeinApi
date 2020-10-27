<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'value','lang','key','setting'
    ];

    public static function setting ($key,$lang = 'en') {
        $data = Setting::where('key',$key)
            ->where('lang',$lang)->first();
        return $data->value;
    }
}
