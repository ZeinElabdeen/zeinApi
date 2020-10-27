<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';

    protected $fillable = ['user_id','item_id'];

    public function user ()  {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function item ()  {
        return $this->belongsTo(Item::class,'item_id','id');
    }

    private function isBasket ($id) {
        $isBasket = Basket::where('user_id',auth('api')->id())
            ->where('item_id',$id)->first();
        return ($isBasket)? true :false;
    }
}
