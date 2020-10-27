<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'price','price_type','title','description',
        'vendor_id','sub_category_id','discount',
    ];

    public function favorites () {
        return $this->hasMany(Favorite::class,'item_id','id');
    }

    public function attaches () {
        return $this->hasMany('App\Models\Attach','item_id','id');
    }

    public function firstAttach () {
        return $this->hasMany('App\Models\Attach','item_id','id')->take(1);
    }

    public function subcategory () {
        return $this->belongsTo(Category::class);
    }

    public function priceType () {
        return $this->belongsTo(PriceType::class,'price_type','id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
