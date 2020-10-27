<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title_en', 'title_ar','tags_ar','tags_en','image'];

    // public function users () {
    //     return $this->hasMany(User::class,'category_id','id');
    // }
    public function products(){

        return $this->hasMany(Product::class);

    }
}
