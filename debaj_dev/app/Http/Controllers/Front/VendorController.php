<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Orders_details;
use App\Models\Pro_comments;
use App\Http\Controllers\Controller;
use Validator;
class VendorController extends Controller
{
    public function index()
    {
      $vendor_id = auth('users')->user()->id;
      $data['added_produect']= Product::where('vendor_id',$vendor_id)->get()->count();
      $data['waitingOrders'] = Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                                        ->where('vendor_id',$vendor_id)
                                        ->groupBy('orders_details.orders_id')
                                        ->where('order_item_status','0')
                                        ->get(['orders_details.order_item_status'])->count();

      $data['confirmedOrders'] = Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                                        ->where('vendor_id',$vendor_id)
                                        ->groupBy('orders_details.orders_id')
                                        ->where('order_item_status','1')
                                        ->get(['orders_details.order_item_status'])->count();

      $data['inshippingOrders'] = Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                                        ->where('vendor_id',$vendor_id)
                                        ->groupBy('orders_details.orders_id')
                                        ->where('order_item_status','2')
                                        ->get(['orders_details.order_item_status'])->count();

      $data['doneOrders'] = Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                                        ->where('vendor_id',$vendor_id)
                                        ->groupBy('orders_details.orders_id')
                                        ->where('order_item_status','3')
                                        ->get(['orders_details.order_item_status'])->count();

      $data['canceldOrders'] = Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                                        ->where('vendor_id',$vendor_id)
                                        ->groupBy('orders_details.orders_id')
                                        ->where('order_item_status','4')
                                        ->get(['orders_details.order_item_status'])->count();

        return view('vendor.home',compact('data'));
    }


    public function comments () {
      $vendor_id = auth('users')->user()->id;
      $comments = Pro_comments::where('vendor_id',$vendor_id)->get();
      return view('vendor.product.comments')->with('comments',$comments);
    }

    public function comments_suspend($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:pro_comments,id'])->validate();
      $comment = Pro_comments::find($id);

      if($comment->status == '1')
      {
            $comment->status= '0' ;
            $update = $comment->update($comment->toArray());
            $mess="تم الغاء نشر التقيم";
      }
      else {
        $comment->status = '1' ;
        $update = $comment->update($comment->toArray());
        $mess="تم نشر التقيم بنجاح";
      }

      if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success',$mess);

    }


    public function orders ($statu) {
      $vendor_id = auth('users')->user()->id;

      $status['new'] = 0;
      $status['confirmed'] = 1;
      $status['inshipping'] = 2;
      $status['delivered'] = 3;

      $my_orders =Product::join('orders_details', 'orders_details.pro_id', '=', 'products.id')
                          ->where('vendor_id',$vendor_id)
                          ->groupBy('orders_details.orders_id')
                          ->where('orders_details.order_item_status',$status[$statu])
                          ->join('orders', 'orders.id', '=', 'orders_details.orders_id')
                          ->get(['orders_details.orders_id','orders_details.order_item_status','orders.status','orders.new_ship_adress',
                                 'orders.created_at','orders.user_id']);
                    return view('vendor.product.my_order_list')->with('my_orders',$my_orders);
    }

    public function order_items ($order_id) {
      $vendor_id = auth('users')->user()->id;
      $order_items =Orders_details::where('orders_id',$order_id)
                          ->join('products','products.id' , '=','orders_details.pro_id')
                          ->where('vendor_id',$vendor_id)
                          ->join('orders', 'orders.id', '=', 'orders_details.orders_id')
                          ->get(['orders_details.*','orders.new_ship_adress','products.ref']);
         $order_details    = Orders::where('orders.id',$order_id)
                            ->join('users','users.id' , '=','orders.user_id')
                            ->get(['orders.*','users.full_name','users.phone','users.email','users.address'])->first();

                    return view('vendor.product.order_items')->with(['order_items'=>$order_items,'order_details'=>$order_details]);
    }



    public function item_change_status () {
      $validator = Validator::make(request()->all(), [
        'item_id'  => 'required|integer|exists:orders_details,id',
        'new_status'  => 'required|integer',
      ]);
      if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()->all()]);
      }
      else
      {
        $affectedRows = Orders_details::where("id", request()->item_id)
                                      ->update(array('order_item_status' =>request()->new_status ));
         if($affectedRows > 0)
         {
           return response()->json(['success'=>'تم تغير حالة الطلب']);
         }else{
            return response()->json(['success'=>'حدث خطاء' ]);
         }
      }
    }

    public function logout () {
        auth()->guard('users')->logout();
        return redirect('my-account');
    }

    public function change_password () {
        return view('vendor.changePassword');
    }

    public function change_password_exe () {

        $validator = Validator::make(request()->all(), [
            'old_password'     => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',

        ]);

        if ($validator->fails()) {
          $error='';
          foreach ($validator->errors()->all() as $key => $value) {
            $error = $error.' '.$value;
          }
          session()->flash('error',$error);
          return redirect()->back();
        }
        if(Hash::check(request()->old_password,auth()->guard('users')->user()->password))
        {
            $vendor = Users::where('id',auth()->guard('users')->user()->id)->first();
            $vendor->password = Hash::make(request()->password);
            $save = $vendor->save();
            if (!$save) {
                session()->flash('error','خطأ في حفظ البيانات الجديدة');
                return redirect()->back();
            }
            session()->flash('success','تم تحديث كلمة المرور بنجاح');
            return redirect('vendor/dashboard');
        }
        else
        {
            session()->flash('error','كلمة المرور غير متطابقة');
            return redirect()->back();
        }
    }

    public function my_profile()
    {
      $user_data = auth('users')->user();
      return view('vendor.my_profile',compact('user_data'));
    }

    public function update_profile()
    {
        if( !empty(request()->password) ){
           $validator = Validator::make(request()->all(), [
           'full_name'  => 'required|string',
           'phone'      => 'required|numeric',
           'adress'     => 'required|string',
           'password'   => 'required|string|min:6|confirmed',
           'password_confirmation' => 'required',
           ]);
         }else {
           $validator = Validator::make(request()->all(), [
           'full_name'  => 'required|string',
           'phone'      => 'required|numeric',
           'adress'     => 'required|string',
           ]);
         }
           if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()->all()]);
           }
           else
           {
             $inputs = array(
                              'full_name' => request()->full_name,
                              'phone' => request()->phone,
                              'address' => request()->adress,
                            );
              if( !empty(request()->password) ){
                $inputs['password'] = Hash::make(request()->password) ;
              }
            if (request()->hasFile('profile_img'))
            {
              $imageName = md5(time()). '.'.request()->file('profile_img')->getClientOriginalExtension();
              $imageMove = request()->file('profile_img')->move(public_path('uploads/user'),$imageName);
              $inputs['image'] = $imageName;
            }
            $user_id = auth('users')->user()->id;
            $affectedRows = Users::where("id", $user_id)->update($inputs);
             if($affectedRows > 0)
             {
               return response()->json(['success'=> __('front.profile_updated') ]);
             }else{
                return response()->json(['success'=> __('front.error_profile_updated') ]);
             }
           }
    }

}
