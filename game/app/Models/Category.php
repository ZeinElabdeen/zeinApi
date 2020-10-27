<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title'];

    public function questions () {
        return $this->hasMany(Question::class,'category_id','id');
    }
}
