<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title_en','title_ar',
    ];

    public static function categories () {
        return Category::all();
    }

}
