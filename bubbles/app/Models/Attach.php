<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    protected $table = 'attaches';

    protected $fillable = ['package_id','image'];
}
