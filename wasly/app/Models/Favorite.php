<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = ['user_id','ad_id','order_id'];

    public function user ()  {
        return $this->belongsTo(User::class);
    }

    public function ad ()  {
        return $this->belongsTo(Item::class);
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('ad_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
