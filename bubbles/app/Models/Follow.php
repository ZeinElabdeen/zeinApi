<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    protected $fillable = ['user_id','club_id'];

    public function user ()  {
        return $this->belongsTo(User::class);
    }

    public function club ()  {
        return $this->belongsTo(Club::class);
    }
}
