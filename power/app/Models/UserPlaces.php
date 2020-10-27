<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlaces extends Model
{
    protected $table = 'user_places';

    protected $fillable = ['user_id','lat','lng'];
}
