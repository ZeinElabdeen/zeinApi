<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['title','image','category_id','city_id'];

    public function classifications() {
        return $this->hasMany(Classification::class,'brand_id','id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
