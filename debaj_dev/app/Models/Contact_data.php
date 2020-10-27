<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_data extends Model
{
    protected $table = 'contact_data';

    protected $fillable = ['mobile', 'tel','mail','adress_ar','adress_en','map_fram'];

}
