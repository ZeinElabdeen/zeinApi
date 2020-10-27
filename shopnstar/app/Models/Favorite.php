<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = ['user_id','item_id'];

    public function user ()  {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function item ()  {
        return $this->belongsTo(Item::class,'item_id','id');
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('ad_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
