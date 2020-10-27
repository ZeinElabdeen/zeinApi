<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdSlider extends Model
{
    protected $table = 'ads_slider';

    protected $fillable = ['image','text_ar','text_en','link','status'];
}
