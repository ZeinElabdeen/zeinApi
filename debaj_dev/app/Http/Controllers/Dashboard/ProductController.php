<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Product_images;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::with('category','product_images')->orderBy('id','desc')->get();

        return view('dashboard.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Colors::all();
        return view('dashboard.product.create',compact('categories','colors'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name_ar'  => 'required',
            'name_en'  => 'required',
            'shortDetails_ar'  => 'required',
            'shortDetails_en'  => 'required',
            //'quantity'  => 'required',
            'category'  => 'required',
          //  'size'  => 'required|array',
            'color'  => 'required|array',
            'ref'  => 'required',
            'description_ar'  => 'required',
            'description_en'  => 'required',
            'additionalInfo_ar'  => 'required',
            'additionalInfo_en'  => 'required',
            'price'  => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);

        $admin_id = auth()->guard('admin')->user()->id;

        if($request->hasfile('images')) {

            $files = $request->file('images');
            $products = Product::create([
                'category_id' => $request->category,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'shortDetails_ar' => $request->shortDetails_ar,
                'shortDetails_en' => $request->shortDetails_en,
              //  'quantity' => $request->quantity,
              //  'size' => implode(',',$request->size),
                'color' => implode(',',$request->color),
                'ref' => $request->ref,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'additionalInfo_ar' => $request->additionalInfo_ar,
                'additionalInfo_en' => $request->additionalInfo_en,
                'price' => $request->price,
                'sale_percentage' => $request->sale_percentage,
                'admin_id' => $admin_id,
            ]);
            $i=1;
            foreach ($files as $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $pro_id = $products->id;
                $imageMove = $image->move(public_path('uploads/upload'),$imageName);
                 Product_images::create([
                    "product_id" => $pro_id,
                    "imageName" => $imageName

                 ]);
                 if($i == 1)
                 {
                   Product::where('id', $pro_id)->update(array('main_image' => $imageName));
                 }
              $i++;
            }
        }
        if(!$products)
        {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        else
        {
          return redirect('/dashboard/product/index')->with('success', 'تم الاضافة بنجاح');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
  {

        $images = Product_images::where('product_id',$id)->get();
        $categories =  Category::all();
        $product = Product::findOrFail($id);
        $colors = Colors::all();
        return view('dashboard.product.edit',with([
            'product' => $product,
            'categories' => $categories,
            'colors' => $colors,
            'images' => $images
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name_ar'  => 'required',
            'name_en'  => 'required',
            'shortDetails_ar'  => 'required',
            'shortDetails_en'  => 'required',
          //  'quantity'  => 'required',
            'category'  => 'required',
          //  'size'  => 'required|array',
            'color'  => 'required|array',
            'ref'  => 'required',
            'description_ar'  => 'required',
            'description_en'  => 'required',
            'additionalInfo_ar'  => 'required',
            'additionalInfo_en'  => 'required',
            'price'  => 'required',
        ]);

        $product = Product::find($id);

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->shortDetails_ar = $request->shortDetails_ar;
        $product->shortDetails_en = $request->shortDetails_en;
      //  $product->size  = implode(',',$request->size);
        $product->color = implode(',',$request->color);
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->additionalInfo_ar = $request->additionalInfo_ar;
        $product->additionalInfo_en = $request->additionalInfo_en;
        $product->ref = $request->ref;
        $product->price = $request->price;
        $product->sale_percentage = $request->sale_percentage;
        $product->category_id = $request->category;


    if($request->hasfile('images')) {
       $files = $request->file('images');
            foreach ($files as $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $pro_id = $id;
                $imageMove = $image->move(public_path('uploads/upload'),$imageName);
                Product_images::create([
                    "product_id" => $pro_id,
                    "imageName" => $imageName
                ]);
            }
      }
        $product->save();
        if (!$product) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {

        $product = Product::findOrFail($id);
        $delete = $product->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المنتج بنجاح');
    }

    public function image_delete(Request $request)
    {
      $this->validate($request,[
          'img_id'  => 'required|integer',
        ]);

      $img_id = $request->img_id;
      $is_delete = Product_images::where('id',$img_id)->delete();
      if(!$is_delete)
      {
        return response()->json(['is_done'=>'0']);
      }else{
        return response()->json(['is_done'=>'1']);
      }
    }

    public function homeimg(Request $request)
    {
      $this->validate($request,[
          'img_name'  => 'required|string',
          'pro_id'  => 'required|integer',
        ]);

      $pro_id= $request->pro_id;
      $proudect = Product::find($pro_id);
      $proudect->main_image = $request->img_name;
      $proudect->save();
      if(!$proudect)
      {
        return response()->json(['is_done'=>'0']);
      }else{
        return response()->json(['is_done'=>'1']);
      }
    }

    public function destroy($id)
    {
        //
    }
}
