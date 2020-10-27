<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemsCollection;
use App\Models\Attach;
use App\Models\Item;
use Illuminate\Http\Request;
use Validator;

class ItemController extends ResponseController
{
    public function index () {
        $data = Item::orderBy('id','desc')->get();
        return response()->json(['data' => ['items'=>new ItemsCollection($data)]]);
    }

    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:items,id'],
            ])->validate();
        $item = Item::findOrFail($id);
        $similars = Item::inRandomOrder()->where('id','!=',$id)
            ->where('sub_category_id',$item->sub_category_id)->limit(3)->get();;
        return response()->json(['data' => ['item' => new ItemResource($item),
            'similars' => new ItemsCollection($similars)
        ]]);


    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'title'  => 'required|string|min:3|max:255',
            'sub_category'  => 'required|integer|exists:categories,id',
            'description'     => 'required|string|min:3|max:255',
            'price'     => 'required|integer|min:1',
            'price_type'     => 'required|integer|exists:price_types,id',
            'type'      => 'required|integer|in:0,1',
            'discount'  => 'required_if:type,=,1|nullable|integer|min:1|max:100',
            'images' => 'required|array|max:3',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
        ]);

        $inputs['title'] = $request->title;
        $inputs['description'] = $request->description;
        $inputs['vendor_id'] = auth('vendor')->id();
        $inputs['sub_category_id'] = $request->sub_category;
        $inputs['price_type']    = $request->price_type;
        $inputs['price']    = $request->price;
        $inputs['type']     = $request->type;
        $inputs['discount'] = $request->discount;
//        dd($inputs);

        $create = Item::create($inputs);

        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $images = request()->file('images');
        foreach ($images as $index => $image) {
            $imageName = md5($index.time()). '.'.$image->getClientOriginalExtension();
            $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
            Attach::create([
                'item_id' => $create->id,
                'image' => $imageName
            ]);
        }
        return $this->apiResponse(['message' => trans('collection.package.store')],200);
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:items,id',
        ]);
        $data = Item::findOrFail($id);
        return response()->json(['data' => new ItemResource($data)]);

    }

    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'id'  => 'required|integer|exists:items,id',
            'title'  => 'nullable|string|min:3|max:255',
            'sub_category'  => 'nullable|integer|exists:categories,id',
            'description'     => 'nullable|string|min:3|max:255',
            'price'     => 'nullable|integer|min:1',
            'price_type'     => 'nullable|integer|exists:price_types,id',
            'type'      => 'nullable|integer|in:0,1',
            'discount'  => 'required_if:type,=,1|nullable|integer|min:1|max:100',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
        ]);
        $item = Item::findOrFail($request->id);
        if ($request->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5($index.time()). '.'.$image->getClientOriginalExtension();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
                Attach::create([
                    'item_id' => $item->id,
                    'image' => $imageName
                ]);
            }
        }
        ($request->title == null)? false:$inputs['title'] = $request->title;
        ($request->description == null)? false:$inputs['description'] = $request->description;
        ($request->sub_category == null)? false:$inputs['sub_category_id'] = $request->sub_category;
        ($request->price_type == null)? false:$inputs['price_type']    = $request->price_type;
        ($request->price == null)? false:$inputs['price']    = $request->price;
        ($request->type == null)? false:$inputs['type']     = $request->type;
        ($request->discount == null)? false:$inputs['discount'] = $request->discount;

        $update = $item->update($inputs);
        if (!$update) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('response.updated')],200);
    }


    public function delete()
    {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:items,id',
        ]);
        $item = Item::findOrFail(request()->id);
        $delete = $item->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        foreach ($item->attaches as $attach){
            if ($attach->image != null && file_exists(public_path('uploads/attaches/'.$attach->image))) {
                unlink(public_path('uploads/attaches/'.$attach->image));
            }
            $attach->delete();
        }

        return $this->apiResponse(['message' => trans('response.deleted')],200);
    }

}
