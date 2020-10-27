<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['title','type','category_id','image','addfrom'];

    public function answers () {
        return $this->hasMany(Answer::class,'question_id','id');
    }

}
