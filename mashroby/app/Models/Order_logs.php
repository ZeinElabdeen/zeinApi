<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_logs extends Model
{
    protected $table = 'order_logs';
    protected $fillable = ['order_id','admin_id','admin_name','action'];

    public function admin_data () {
        return $this->belongsTo(Admin::class ,'admin_id','id');
    }
}
