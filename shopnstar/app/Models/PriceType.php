<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    protected $table = 'price_types';

    protected $fillable = [
        'title_en','title_ar',
    ];

    public function ads() {
        return $this->hasMany(Item::class, 'size_id', 'id');
    }

    public static function sizes () {
        return PriceType::all();
    }
}
