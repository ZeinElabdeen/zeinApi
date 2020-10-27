<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
  protected $fillable =[
      'pro_id','photo','name_ar','name_en','orders_id','quantity','price','color','size','price_befor_sale','sale_percent','size_num'
      ];

      public function product () {
          return $this->belongsTo(Product::class,'pro_id','id');
      }

}
