<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'classifications';

    protected $fillable = ['title','image','brand_id'];

    public function items() {
        return $this->hasMany(Item::class,'classification_id','id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
