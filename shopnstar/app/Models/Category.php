<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'vendor_id','cat_id'
    ];



    public function categorydetails() {
        return $this->belongsTo(Cats::class,'cat_id','id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }


}
