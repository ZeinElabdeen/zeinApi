<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'image','title',
    ];

    public function brands() {
        return $this->hasMany(Brand::class,'category_id','id');
    }

    public static function categories () {
        return Category::all();
    }

}
