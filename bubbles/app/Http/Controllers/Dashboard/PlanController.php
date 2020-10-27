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

    public function create() {
        return view('dashboard.plan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'description_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'description_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'price'     => 'required|integer',
            'period'     => 'required|integer',
        ]);
        $create = Plan::create($request->all());
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة البيانات بنجاح');
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
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'description_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'description_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'price'     => 'required|integer',
            'period'     => 'required|integer',
        ]);
        $category = Plan::findOrFail($request->id);

        $update = $category->update($request->all());
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }

    public function delete ($id) {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:plans,id',
        ]);
        $data = Plan::findOrFail($id);
        $delete = $data->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف البيانات بنجاح');
    }
}
