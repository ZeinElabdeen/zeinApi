<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['title_ar','title_en'];

    public function users () {
        return $this->hasMany(User::class,'city_id','id');
    }
}
