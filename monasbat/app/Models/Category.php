<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title_en', 'title_ar','image'];

    public function users () {
        return $this->hasMany(User::class,'category_id','id');
    }
}
