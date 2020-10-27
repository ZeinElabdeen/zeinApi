<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pro_comments extends Model
{
    protected $table = 'pro_comments';

    protected $fillable = ['pro_id','vendor_id','stars','name','comment','status','email'];


}
