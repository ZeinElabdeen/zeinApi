<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ['user_id','driver_id','start_lat','start_lng','end_lat','end_lng',
        'arriving_date','arriving_time','id_number','description','type','notes','status',];

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function attaches() {
        return $this->hasMany(Attach::class,'package_id','id');
    }
}
