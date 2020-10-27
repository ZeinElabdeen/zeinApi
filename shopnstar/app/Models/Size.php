<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable = [
        'title_en','title_ar',
    ];

    public function ads() {
        return $this->hasMany(Item::class, 'size_id', 'id');
    }

    public static function sizes () {
        return Size::all();
    }
}
