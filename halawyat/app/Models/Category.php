<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title_en','title_ar','icon','parent_id'
    ];

    public function subcategories () {
        return $this->hasMany(Self::class,'parent_id','id');
    }

    public function filledSubcategories () {
        return $this->hasMany(Self::class,'parent_id','id')->whereHas('items');
    }

    public function items () {
        return $this->hasMany(Item::class,'sub_category_id','id');
    }

    public function category () {
        return $this->belongsTo(Self::class,'parent_id','id');
    }

    public function vendors () {
        return $this->hasMany(Vendor::class,'category_id','id');
    }


    public static function categories () {
        return Category::all();
    }

}
