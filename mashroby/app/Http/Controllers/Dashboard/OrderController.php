<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Order_logs;
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
                $data = Order::where('status','1')->get();
                $title = 'طلبات تم تأكيدها';
                break;

            case 'underway':
                $data = Order::where('status','3')->get();
                $title = 'طلبات تم شحنها';
                break;

            case 'delivered':
                $data = Order::where('status','4')->get();
                $title = 'طلبات تم تسليمها';
                break;
            case 'canceled':
                $data = Order::where('status','2')->get();
                $title = 'طلبات تم الغاءها';
                break;

            default:
                return back();
        }
        return view('dashboard.order.index',compact('data','title'));
    }

    public function show ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id']);
        $data = Order::find($id);

        switch ($data->status) {

            case '0':
                $title = 'الطلبات الجديدة';
                break;

            case '1':

                $title = 'طلبات تم تأكيدها';
                break;

            case '3':

                $title = 'طلبات تم شحنها';
                break;

            case '4':

                $title = 'طلبات تم تسليمها';
                break;
            case '2':

                $title = 'طلبات تم الغاءها';
                break;
                default:
                    return back();
            }
        $title = $title .' / تفاصيل الطلب';
        return view('dashboard.order.show',compact('data','title'));
    }

    public function actions_logs($order_id) {
        Validator::make(['id' => $order_id],['id' => 'required|integer|exists:orders,id']);
        $code = Order::find($order_id)->code;
        $data = Order_logs::where('order_id',$order_id)->get();
        $title = 'سجل الاجراءات علي طلب رقم : '.$code;
        return view('dashboard.order.actions_logs',compact('data','title','order_id'));
    }

    public function status ($id,$status) {

        Validator::make(['id' => $id],
            [
                'id' => 'required|integer|exists:orders,id',
                'status' => 'required|integer|in:1,2,3',
            ]);
        $data = Order::findOrFail($id);
        $data->status = $status;
        $save = $data->save();
        if (!$save) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }

          $logs["admin_id"]= auth()->guard('admin')->user()->id;
          $logs["admin_name"]= auth()->guard('admin')->user()->username;
          $logs["order_id"]= $id;
          $logs["action"]= $status ;
          Order_logs::create($logs);

        if ($status == '1') {
            foreach ($data->orderItems as $orderItem) {
                $orderItem->itemDetails->stock = $orderItem->itemDetails->stock - $orderItem->count;
                $orderItem->itemDetails->save();
            }
        }
        return back()->with('success','تم تغيير حالة الطلب');
    }
}
