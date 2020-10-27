<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = 'cars_types';

    protected $fillable = ['title_en','title_ar'];
}
