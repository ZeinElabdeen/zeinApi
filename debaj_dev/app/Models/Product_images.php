<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_images extends Model
{
    protected $fillable = [
        'product_id','imageName'
    ];

    public function product(){

        return $this->belongsTo()(Product::class);
    }

}
