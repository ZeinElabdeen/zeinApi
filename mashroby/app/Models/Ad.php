<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'price','title_en','title_ar','image','stock','discount',
        'size_id','category_id','type',
    ];

    public function favorites () {
        return $this->hasMany(Favorite::class,'ad_id','id');
    }

    public function comments () {
        return $this->hasMany(Comment::class,'ad_id','id');
    }

    public function attaches () {
        return $this->hasMany('App\Models\Attach','ad_id','id');
    }

    public function firstAttach () {
        return $this->hasOne('App\Models\Attach','ad_id','id')->take(1);
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function size () {
        return $this->belongsTo(Size::class);
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
