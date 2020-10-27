<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Plan;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index () {
        $data = Plan::all();
        return view('dashboard.plan.index', compact('data'));
    }

    public function edit ($id) {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:plans,id',
        ]);
        $data = Plan::findOrFail($id);
        return view('dashboard.plan.edit', compact('data'));
    }

    public function update (Request $request) {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
            'price'     => 'required|integer',
            'ads_count' => 'required|integer'
        ]);
        $category = Plan::findOrFail($request->id);

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['price'] = $request->price;
        $inputs['ads_count'] = $request->ads_count;

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }
}
