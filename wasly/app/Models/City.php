<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['state','state_id','city','city_id','village','status','shipping_cost'];

    public static function states () {
        return City::where('state_id','=',null)->get();
    }

    public static function cities () {
        return City::where('state_id','!=',null)->where('city_id','=',null)->get();
    }

    public static function sippingPrice ($id) {
        return City::where('id',$id)->first('shipping_cost')->shipping_cost;
    }

    /* Relations */

    public function stateDetails () {
        return $this->belongsTo(City::class,'state_id','id');
    }

    public function user () {
        return $this->hasMany(User::class);
    }

    public function villages () {
        return $this->hasMany(City::class,'city_id','id');
    }

}
