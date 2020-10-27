<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'cars_models';

    protected $fillable = ['title_en','title_ar'];
}
