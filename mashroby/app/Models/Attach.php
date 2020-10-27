<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    protected $table = 'attaches';

    protected $fillable = ['ad_id','image'];

    public function ad () {
        return $this->belongsTo(Ad::class);
    }
}
