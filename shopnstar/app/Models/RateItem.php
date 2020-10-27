<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateItem extends Model
{
    protected $table = 'item_rates';

    protected $fillable = ['user_id','item_id','rate','review'];

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function item() {
        return $this->belongsTo(Item::class,'item_id','id');
    }

}
