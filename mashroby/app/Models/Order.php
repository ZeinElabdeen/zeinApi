<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id','code','total','lat','lng','status','promo_code','order_creation_date',
        'payment_method','delivery_time','repeat','order_cost','total_cost','tax','cash_req','from_wallet','address','promo_code_value'
    ];

    public function orderItems () {
        return $this->hasMany(OrderItems::class,'order_id','id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function paymentMethod () {
            switch ($this->payment_method) {
                case '1' :
                    return 'كاش';
                    break;

                case '2' :
                    return 'فيزا';
                    break;

                case '3' :
                    return 'ماستر كارد';
                    break;

                case '4' :
                    return 'مدى';
                    break;

                case '5' :
                    return 'سداد';
                    break;
                default :
                    return 'غير محدد';
            }
    }

    public function deliveryTime () {
            switch ($this->delivery_time) {
                case '1' :
                    return 'صباحاً';
                    break;

                case '2' :
                    return 'مساءاً';
                    break;

                case '3' :
                    return 'في أي وقت';
                    break;
                default :
                    return 'غير محدد';
            }
    }

    public function repeat () {
            switch ($this->repeat) {
                case '1' :
                    return 'مرة واحدة';
                    break;

                case '2' :
                    return 'كل أسبوعين';
                    break;

                case '3' :
                    return 'كل شهر';
                    break;
                default :
                    return 'غير محدد';
            }
    }
}
