<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable =[

      'category_id','main_image','name_ar','name_en','shortDetails_ar','shortDetails_en',
      'quantity','size','color','ref','description_ar','description_en','additionalInfo_ar','additionalInfo_en',
      'price','created_at','updated_at','admin_id','vendor_id','size_num','sale_percentage'

      ];

      public function product_images(){

          return $this->hasMany(Product_images::class,'product_id','id');

      }
      public function product_comments(){

          return $this->hasMany(Pro_comments::class,'pro_id','id')->where('status','1');

      }

      public function category(){
          return $this->belongsTo(Category::class,'category_id','id');

      }

      public function vendor(){
          return $this->belongsTo(User::class,'vendor_id','id');

      }





}
