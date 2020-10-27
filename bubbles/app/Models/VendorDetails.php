<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorDetails extends Model
{
    protected $table = 'vendor_details';

    protected $fillable = ['vendor_id','rate','description','cover_image','membership_image',
        'whatsapp','facebook','twitter','instagram','subscription_end',];

    public function vendor () {
        return $this->belongsTo(User::class,'vendor_id','id');
    }
}
