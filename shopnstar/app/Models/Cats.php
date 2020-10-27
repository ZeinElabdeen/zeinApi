<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 

class Cats extends Model
{
    protected $table = 'cats';
    protected $fillable = [
        'description','title','icon'
    ];


    public function vendorcategories () {
        return $this->hasMany(Category::class,'cat_id','id');
    }

    // public function vendor() {
    //     return $this->belongsTo(Vendor::class,'vendor_id','id');
    // }


}
