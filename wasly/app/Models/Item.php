<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $table = 'items';

    protected $fillable = [
        'price','brand_id','classification_id','title','description','rate',
        'status','discount','stock',
    ];

    public function brand () {
       return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function attaches () {
        return $this->hasMany('App\Models\Attach','item_id','id');
    }

    public function details () {
        return $this->hasMany(ItemDetails::class,'item_id','id');
    }

    public function rates () {
        return $this->hasMany(Rate::class,'item_id','id');
    }

    public function firstTwoRates () {
        return $this->hasMany(Rate::class,'item_id','id')->orderByDesc('id');
    }


    public function firstAttach () {
        return $this->hasOne('App\Models\Attach','item_id','id')->take(1);
    }


}
