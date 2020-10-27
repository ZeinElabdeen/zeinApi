<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index ($type) {
        Validator::make(['type' => $type],['type' => 'required|string|in:new,confirmed,underway,delivered']);

        switch ($type) {
            case 'new':
                $data = Order::where('status','0')->get();
                $title = 'الطلبات الجديدة';
                break;

            case 'confirmed':
                $data = Order::where('status','1')->get();;
                $title = 'طلبات تم تأكيدها';
                break;

            case 'underway':
                $data = Order::where('status','3')->get();;
                $title = 'طلبات تم شحنها';
                break;

            case 'delivered':
                $data = Order::where('status','4')->get();;
                $title = 'طلبات تم تسليمها';
                break;
            case 'canceled':
                $data = Order::where('status','2')->get();;
                $title = 'طلبات تم الغاء';
                break;

            default:
                return back();
        }
//        return $data;
        return view('dashboard.order.index',compact('data','title'));
    }

    public function show ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id']);
        $data = Order::find($id);
        $title = 'تفاصيل الطلب';
        return view('dashboard.order.show',compact('data','title'));
    }

    public function status ($id,$status) {

        Validator::make(['id' => $id],
            [
                'id' => 'required|integer|exists:orders,id',
                'status' => 'required|integer|in:1,2,3,4',
            ]);
        $data = Order::findOrFail($id);
        $data->status = $status;
        $save = $data->save();
        if (!$save) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        $this->sendNotification($data,1,$data->user_id,$status);
        return back()->with('success','تم تغيير حالة الطلب');
    }

    public function userOrders ($id) {
        Validator::make(['id' => $id],['id' => 'required|string|exists:users,id']);

        $user = User::findOrFail($id);

        $data = $user->orders;
        $title =   ' طلبات ' . $user->first_name ;
//        return $data;
        return view('dashboard.user.orders',compact('data','title'));
    }

    private function sendNotification ($order,$type,$userId,$case) {
        switch ($case){
            case 1:
                $body = $order->code . " تم تأكيد طلبك رقم ";
                break;
            case 2:
                $body = $order->code . " تم إلغاء طلبك رقم ";
                break;
            case 3:
                $body = $order->code . " تم شحن طلبك رقم ";
                break;
            case 4:
                $body = $order->code . " تم توصيل طلبك رقم ";
                break;
            default:
                return abort(404);
        }
        Notification::send($order->id,$type,$body,$userId);
        return true;
    }

}
