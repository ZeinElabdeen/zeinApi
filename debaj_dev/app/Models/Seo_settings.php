<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo_settings extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = ['title_en', 'title_ar','description_ar','description_en','keywords_ar','keywords_en'];

}
