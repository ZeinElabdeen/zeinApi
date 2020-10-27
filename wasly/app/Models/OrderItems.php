<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['order_id','item_id','count','price'];

    public function itemDetails () {
        return $this->belongsTo(Item::class ,'item_id','id')->withTrashed();
    }
}
