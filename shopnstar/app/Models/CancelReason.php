<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{
    protected $table = 'reasons';

    protected $fillable = ['reason'];

    protected $hidden = [
     'created_at','updated_at',      
    ];

}
