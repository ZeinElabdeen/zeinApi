<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social_page extends Model
{
    protected $table = 'social_page';

    protected $fillable = ['facebook', 'twiter','instgram','pintrist'];

}
