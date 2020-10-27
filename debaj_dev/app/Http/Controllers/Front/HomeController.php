<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Product_images;
use App\Models\Subscriber;
use App\Models\Pages;
use App\Models\Faq;
use App\Models\Contact_data;
use App\Models\Contact;
use App\Models\Users;
use App\Models\Orders_details;
use App\Models\Orders;
use App\Models\Pro_comments;
use App\Models\Salecodes;
use App\Models\AdSlider;
use Validator;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index()
    {
        //$cats_home = Category::where('is_home',1)->get();
        $sliders = AdSlider::where('status','1')->get();
        $cats = Category::all();
        $products_sale = Product::where('sale_percentage','>','0')->get();
        return view('front.index',compact('cats','sliders','products_sale'));
    }
    public function cat_details($cat_name)
    {
      $cat_url = $cat_name;
      $cat_name = str_replace(' ', '-',$cat_name) ;
      $cat_details = Category::where('title_en',$cat_name)->get()->first();
      $cat_products = Product::where('category_id',$cat_details['id'])->paginate(4);
      $colors = Colors::all();
      $color_to_find = array_column($colors->toArray(), 'code', 'id');
      $color_to_find_names = array_column($colors->toArray(), 'name_'.app()->getLocale(), 'id');

     return view('front.cat_products_list',compact('cat_products','cat_details','colors','color_to_find','color_to_find_names','cat_url'));
    }

   public function pro_details($cat_name,$proname,$pro_id)
   {
     $product = Product::find($pro_id);
     $product_img = $product->product_images;
     $comments = $product->product_comments;
     $cat_details = $product->category;
     $product_related = Product::where('id','!=',$pro_id)->where('category_id',$product->category_id)->limit(8)->get();
     $colors = Colors::all();
     $color_to_find = array_column($colors->toArray(), 'code', 'id');
     $color_to_find_names = array_column($colors->toArray(), 'name_'.app()->getLocale(), 'id');

    return view('front.product_details',compact('product','product_img','cat_details','product_related','color_to_find','color_to_find_names','comments'));

   }
   public function add_review()
   {
       $validator = Validator::make(request()->all(), [
       'email'  => 'required|email',
       'pro_id'  => 'required|integer|exists:products,id',
       'stars'  => 'required|integer',
       'name'  => 'required|string',
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>$validator->errors()->all()]);
       }else{
         $inputs = request()->except('_token');
         $creat = Pro_comments::create($inputs);
         if($creat)
         {
           return response()->json(['success'=> __('front.added_review') ]);
         }else{
            return response()->json(['success'=> __('front.error_added_review') ]);
         }
       }
   }

   public function subscribe()
   {
       $validator = Validator::make(request()->all(), [
       'submail'  => 'required|email|max:255|unique:subscriber,email',
       //'submail'  => 'required|email|max:255',
       ]);

       if ($validator->fails()) {
        // dd($validator->getMessageBag());
         return response()->json($validator->messages(), 200);
       }
       else
       {
         $inputs = array('email' => request()->submail );
         $creat = Subscriber::create($inputs);
         if($creat)
         {
           return response()->json('1', 200);
         }else{
            return response()->json('0', 200);
         }
       }
   }


   public function search()
   {
    // dd(request()->all());
     $validator = Validator::make(request()->all(), [
     'search'  => 'required|string',
     ]);

     if ($validator->fails()) {
       return response()->json(['error'=>$validator->errors()->all()]);
     }
     else{

       $search_for = request('search');
       $products = Product::whereLike(['name_'.app()->getLocale()], $search_for)
                      ->join('categories', 'products.category_id', '=', 'categories.id')
                      ->select('categories.title_en','products.name_en','products.name_ar','products.color','products.main_image',
                             'products.category_id','products.id','products.price','products.shortDetails_'.app()->getLocale())->paginate(4);

       $products->appends(['search' => $search_for]);
       $colors = Colors::all();
       $color_to_find = array_column($colors->toArray(), 'code', 'id');
       $color_to_find_names = array_column($colors->toArray(), 'name_'.app()->getLocale(), 'id');

       return view('front.search',compact('products','colors','color_to_find','color_to_find_names','search_for'));
     }
   }

   public function filtering()
   {

      $colors = Colors::all();
      $color_to_find = array_column($colors->toArray(), 'code', 'id');
      $color_to_find_names = array_column($colors->toArray(), 'name_'.app()->getLocale(), 'id');

     if( isset(request()->search_for) ){
       $validator = Validator::make(request()->all(), [
       'search_for'  => 'required|string',
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>$validator->errors()->all()]);
       }
       $search_for = request()->search_for;
       $products = Product::whereLike(['name_'.app()->getLocale()], $search_for)
                      ->join('categories', 'products.category_id', '=', 'categories.id');
                      if(isset(request()->price_order))
                      {
                          $products = $products->orderBy('products.price', request()->price_order);
                      }
                      if(isset(request()->newest_order))
                      {
                          $products = $products->orderBy('products.created_at', request()->newest_order);
                      }
                      if(isset(request()->size))
                      {
                        foreach (request()->size as $key => $value) {
                          if ($key == 0) {
                             $products = $products->whereRaw("find_in_set('".$value."',products.size)");
                           }else{
                             $products = $products->orWhereRaw("find_in_set('".$value."',products.size)");
                           }
                        }
                      }
                      if(isset(request()->color))
                      {
                        foreach (request()->color as $key => $value) {
                          if ($key == 0) {
                            $products = $products->whereRaw("find_in_set('".$value."',products.color)");
                          }else{
                            $products = $products->orWhereRaw("find_in_set('".$value."',products.color)");
                          }
                        }
                      }

                      $products = $products->select('categories.title_en','products.name_en','products.name_ar','products.color','products.main_image',
                             'products.category_id','products.id','products.price','products.shortDetails_'.app()->getLocale())->get();

       $products_block = view('front.products_block',compact('products','color_to_find','color_to_find_names'))->render();
        return response()->json(['filtering_data'=>$products_block]);

     }else if( isset(request()->cat_id) ){

         $validator = Validator::make(request()->all(), [
         'cat_id'  => 'required|integer|exists:categories,id',
         ]);

         if ($validator->fails()) {
           return response()->json(['error'=>$validator->errors()->all()]);
         }
         $products = Product::where('category_id',request()->cat_id)
                            ->join('categories', 'products.category_id', '=', 'categories.id');
         if(isset(request()->price_order))
         {
             $products = $products->orderBy('products.price', request()->price_order);
         }
         if(isset(request()->newest_order))
         {
             $products = $products->orderBy('products.created_at', request()->newest_order);
         }
         if(isset(request()->size))
         {
           foreach (request()->size as $key => $value) {
             if ($key == 0) {
                $products = $products->whereRaw("find_in_set('".$value."',products.size)");
              }else{
                $products = $products->orWhereRaw("find_in_set('".$value."',products.size)");
              }
           }
         }
         if(isset(request()->color))
         {
           foreach (request()->color as $key => $value) {
             if ($key == 0) {
               $products = $products->whereRaw("find_in_set('".$value."',products.color)");
             }else{
               $products = $products->orWhereRaw("find_in_set('".$value."',products.color)");
             }
           }
         }
         $products = $products->select('categories.title_en','products.name_en','products.name_ar','products.color','products.main_image',
                'products.category_id','products.id','products.price','products.shortDetails_'.app()->getLocale())->get();

        $products_block = view('front.products_block',compact('products','color_to_find','color_to_find_names'))->render();
        return response()->json(['filtering_data'=>$products_block]);
     }
   }

   public function about()
   {
     $data = Pages::find('1');
     return view('front.about',compact('data'));
   }
   public function terms()
   {
     $data = Pages::find('2');
     return view('front.about',compact('data'));
   }

   public function contact()
   {
     $data = Contact_data::find('1');
     return view('front.contact',compact('data'));
   }
   public function contact_save()
   {
     $validator = Validator::make(request()->all(), [
     'name'     => 'required|string',
     'message'  => 'required|string',
     'mail'     => 'required|email',
     ]);

     if ($validator->fails()) {
       return response()->json(['error'=>$validator->errors()->all()]);
     }
     else
     {
       $inputs = array(
                        'title' => 'رسالة تواصل معانا',
                        'name' => request()->name,
                        'message' => request()->message,
                        'mail' => request()->mail,
                      );

       $creat = Contact::create($inputs);
       if($creat)
       {
         return response()->json(['success'=> __('front.sent_mess') ]);
       }else{
          return response()->json(['success'=> __('front.sent_mess_error') ]);
       }
     }

   }

   public function faq()
   {
     $data = Faq::all();
     return view('front.faq',compact('data'));
   }

   public function my_account()
   {
     return view('front.my_account');
   }
   public function login()
   {
       $validator = Validator::make(request()->all(), [
           'username' => 'required|email',
           'password' => 'required|string',
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>$validator->errors()->all()]);
       }
       else
       {
         $credentials = array('email' => request()->username, 'password' => request()->password,'status' =>'1');
         $remember = request()->has('remember')? true:false;
         $login_auth = Auth::guard('users');
         $login_attemp = $login_auth->attempt($credentials,$remember);
        if ($login_attemp) {
           if($login_auth->user()->status == '0')
           {
             return response()->json(['success'=> __('front.not_active')]);
           }else{
             if($login_auth->user()->type == '0'){
               return response()->json(['red_url'=> '/']);
             }else if($login_auth->user()->type == '1'){
               return response()->json(['red_url'=> '/vendor/dashboard']);
             }
           }
         }else{
           return response()->json(['success'=>  __('front.wrong_auth')]);
         }
       }

   }
   public function register()
   {
     return view('front.register');
   }
   public function register_exe()
   {

     $validator = Validator::make(request()->all(), [
     'full_name'  => 'required|string',
     'user_name'  => 'required|string|unique:users,username',
     'mail'       => 'required|email|unique:users,email',
     //'phone'      => 'required|numeric|size:11',
     'phone'      => 'required|numeric',
     'adress'     => 'required|string',
     'password'   => 'required|string|min:6|confirmed',
     'password_confirmation' => 'required',
     ]);

     if ($validator->fails()) {
       return response()->json(['error'=>$validator->errors()->all()]);
     }
     else
     {
       //return response()->json(['success'=>'Added new records.']);
       $inputs = array(
                        'full_name' => request()->full_name,
                        'username' => request()->user_name,
                        'email' => request()->mail,
                        'phone' => request()->phone,
                        'address' => request()->adress,
                        'status' => '0',
                        'verified' => Users::randToken(),
                        'password' => Hash::make(request()->password),
                      );
        if(isset(request()->is_seller))
        {
          $inputs['type'] = request()->is_seller;
        }else {
          $inputs['type'] = 0;
        }
       $creat = Users::create($inputs);
       if($creat)
       {
         return response()->json(['success'=> __('front.added_account') ]);
       }else{
          return response()->json(['success'=> __('front.error_added_account') ]);
       }
     }

   }

   public function salecode_check()
   {
       $validator = Validator::make(request()->all(), [
         'salecode'  => 'required|string|exists:salecodes,code',
       ]);
       if ($validator->fails()) {
         return response()->json(['error'=>$validator->errors()->all()]);
       }else{
          $salecode = Salecodes::where('code',request()->salecode)->get()->first();

          if($salecode['statu'] == 1)
          {
            return response()->json(['codeval'=> $salecode['salevalue']  ]);
          }else{
            return response()->json(['error'=> [__('front.usedsalecode')] ]);
          }

       }
   }

   public function add_cart()
   {
     $validator = Validator::make(request()->all(), [
       'pro_id'  => 'required|integer|exists:products,id',
       'pro_count'  => 'required|integer',
       'size_num'  => 'required',
     ]);
     if ($validator->fails()) {
       return response()->json(['error'=>$validator->errors()->all()]);
     }
     else
     {
       $id = request()->pro_id;
       $pro_count = request()->pro_count;
       $size = request()->size;
       $color = request()->color;
       $product = Product::find($id);
       if($product->sale_percentage > 0 )
       {
         $price = $product->price - ( $product->price * $product->sale_percentage/100 ) ;
       }else{
         $price = $product->price;
       }
       $cart = session()->get('cart');
       if(empty($cart)) {

          $cart = [
                  $id => [
                      "name_en" => $product->name_en,
                      "name_ar" => $product->name_ar,
                    //  "quantity" => $pro_count,
                      "size_num" =>  request()->size_num,
                      "quantity" => 1,
                      //"size" =>  $size,
                      "color" => $color,
                      "price" => $price,
                      "photo" => $product->main_image
                  ]
          ];
          session()->put('cart', $cart);
          $cart_new = session()->get('cart');
          return response()->json(['success'=> sizeof($cart_new) ]);

      }
    /*  if(isset($cart[$id])) {
        //  $cart[$id]['quantity']= $cart[$id]['quantity']+$pro_count;
          $cart[$id]['quantity']= 1;
           session()->put('cart', $cart);
           $cart_new = session()->get('cart');
           return response()->json(['success'=>sizeof($cart_new) ]);
       }*/else{
             $cart[$id] = [
               "name_en" => $product->name_en,
               "name_ar" => $product->name_ar,
              // "quantity" => $pro_count,
               "size_num" =>  request()->size_num,
               "quantity" => 1,
               //"size" =>  $size,
               "color" => $color,
               "price" => $price,
               "photo" => $product->main_image
            ];
            session()->put('cart', $cart);
          //  dd(session()->all());
            $cart_new = session()->get('cart');
            return response()->json(['success'=> sizeof($cart_new) ]);
       }
     }

   }
   public function add_fav()
   {
     $validator = Validator::make(request()->all(), [
       'pro_id'  => 'required|integer|exists:products,id',
     ]);
     if ($validator->fails()) {
       return response()->json(['error'=>$validator->errors()->all()]);
     }
     else
     {
       $id = request()->pro_id;
       $product = Product::find($id);
       if($product->sale_percentage > 0 )
       {
         $price = $product->price - ( $product->price * $product->sale_percentage/100 ) ;
       }else{
         $price = $product->price;
       }

       $favorite = session()->get('favorite');
       if(empty($favorite)) {

          $favorite = [
                  $id => [
                      "name_en" => $product->name_en,
                      "name_ar" => $product->name_ar,
                      "price" => $price,
                      "photo" => $product->main_image
                  ]
          ];
          session()->put('favorite', $favorite);
          $favorite_new = session()->get('favorite');
          return response()->json(['success'=> sizeof($favorite_new) ]);

      }
      if(isset($favorite[$id])) {
           return response()->json(['success'=>'exist' ]);
       }else{
             $favorite[$id] = [
               "name_en" => $product->name_en,
               "name_ar" => $product->name_ar,
               "price" => $price,
               "photo" => $product->main_image
            ];
            session()->put('favorite', $favorite);

            $favorite_new = session()->get('favorite');
            return response()->json(['success'=> sizeof($favorite_new) ]);
       }
     }
   }

  public function favorites()
  {
    $data = session()->get('favorite');
    return view('front.favorites',compact('data'));
  }

  public function remove_favorites()
  {
    $validator = Validator::make(request()->all(), [
      'pro_id'  => 'required|integer|exists:products,id',
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()->all()]);
    }
    else{
      $id = request()->pro_id;
      $data = session()->get('favorite');
      unset($data[$id]);
      session()->put('favorite', $data);
      $favorite_new = session()->get('favorite');
      return response()->json(['success'=> sizeof($favorite_new) ]);
    }
  }

  public function cart()
  {
    $data = session()->get('cart');
    return view('front.cart',compact('data'));
  }

  public function remove_cart()
  {
    $validator = Validator::make(request()->all(), [
      'pro_id'  => 'required|integer|exists:products,id',
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()->all()]);
    }
    else{
      $id = request()->pro_id;
      $data = session()->get('cart');
      unset($data[$id]);
      session()->put('cart', $data);
      $cart_new = session()->get('cart');
      return response()->json(['success'=> sizeof($cart_new) ]);
    }
  }


  public function checkout()
  {
    $data = session()->get('cart');
    if(empty($data))
    {
      return redirect('cart');
    }
    return view('front.checkout',compact('data'));
  }

  public function logout () {
      auth()->guard('users')->logout();
      return redirect('my-account');
  }

  public function send_order()
  {
    $cart = session()->get('cart');
    $user_data = auth('users')->user();

    if(!empty(request()->new_address)){
      $user_data->address = request()->new_address;
    }
    $order_inputs = array('user_id' =>$user_data->id ,'new_ship_adress'=>$user_data->address,'status'=> '0');

    if(!empty(request()->salecode)){
      $salecode = request()->salecode;
      $salecode = Salecodes::where('code',request()->salecode)->get()->first();

          if($salecode['statu'] == '1')
          {
            $order_inputs['salecode'] = $salecode['code'];
            $order_inputs['salecode_value'] = $salecode['salevalue'];
            Salecodes::where("id", $salecode['id'])->update(array('statu' =>'0' ));
          }

    }

    if(!empty($cart))
    {
      $creat = Orders::create($order_inputs);
      if($creat)
      {
        $order_id = $creat->id;
        foreach ($cart as $key => $value) {

          $product = Product::find($key);

          $inputs = array(
                          'orders_id' => $order_id ,
                          'pro_id'  => $key,
                          'name_ar' => $cart[$key]['name_ar'],
                          'name_en' => $cart[$key]['name_en'],
                          'quantity'=> $cart[$key]['quantity'],
                          'size_num'=> $cart[$key]['size_num'],
                          //'size'=> $cart[$key]['size'],
                          'color'=> $cart[$key]['color'],
                          'photo' => $cart[$key]['photo']
                        );

          if($product->sale_percentage > 0 )
          {
            $inputs['price'] = $product->price - ( $product->price * $product->sale_percentage/100 ) ;
            $inputs['price_befor_sale'] = $product->price;
            $inputs['sale_percent'] = $product->sale_percentage;
          }else{
            $inputs['price'] = $product->price;
          }


          // $inputs = array(
          //                 'orders_id' => $order_id ,
          //                 'pro_id'  => $key,
          //                 'name_ar' => $cart[$key]['name_ar'],
          //                 'name_en' => $cart[$key]['name_en'],
          //                 'quantity'=> $cart[$key]['quantity'],
          //                 'size'=> $cart[$key]['size'],
          //                 'color'=> $cart[$key]['color'],
          //                 'price' => $cart[$key]['price'],
          //                 'photo' => $cart[$key]['photo']
          //               );
             Orders_details::create($inputs);
             unset($cart[$key]);
        }
        session()->put('cart', $cart);
        return response()->json(['success'=> __('front.order_added') ]);

      }else{
        return response()->json(['success'=> __('front.error_added_order') ]);
      }
    }

  }

  public function done_order()
  {
    return view('front.done_order');
  }

  public function my_profile()
  {
    $user_data = auth('users')->user();
    return view('front.my_profile',compact('user_data'));
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

  public function my_orders()
  {
    $user_id = auth('users')->user()->id;
    $my_orders = Orders::where("user_id", $user_id)->get();
    $status[0] =  __('front.status_0') ;
    $status[1] =  __('front.status_1') ;
    $status[2] =  __('front.status_2') ;
    $status[3] =  __('front.status_3') ;
    $status[4] =  __('front.cancel_order') ;

    return view('front.my_orders',compact('my_orders','status'));
  }

  public function order_details($order_id)
  {

    $order = Orders::find($order_id);
    $order_details = Orders_details::where("orders_id", $order_id)->get();
                          //->leftjoin('orders', 'orders.id', '=', 'orders_details.orders_id')

    return view('front.order_details',compact('order_details','order'));
  }

  public function cancel_order()
  {
    $validator = Validator::make(request()->all(), [
      'order_id'  => 'required|integer|exists:orders,id',
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()->all()]);
    }
    else{
      $order_id = request()->order_id;
      $affectedRows = Orders::where("id", $order_id)->update(array('status' =>'4' ));
       if($affectedRows > 0)
       {
         return response()->json(['success'=> __('front.cancel_order_done') ]);
       }else{
          return response()->json(['success'=> __('front.cancel_order_error') ]);
       }

    }

  }

// public function session_veiw()
// {
//   dd(session()->all());
// }

}
