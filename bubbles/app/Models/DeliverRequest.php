<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverRequest extends Model
{
    protected $table = 'deliver_requests';

    protected $fillable = ['driver_id','package_id','cost'];

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }
}
