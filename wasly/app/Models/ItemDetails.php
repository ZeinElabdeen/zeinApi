<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetails extends Model
{
    protected $table = 'item_details';

    protected $fillable = [
        'value','key','item_id'
    ];

}
