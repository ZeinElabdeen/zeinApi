<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salecodes extends Model
{
    protected $table = 'salecodes';

    protected $fillable = ['code', 'salevalue','statu'];

}
