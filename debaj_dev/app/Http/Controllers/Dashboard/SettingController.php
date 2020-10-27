<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Validator;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function setting () {
        $data = Setting::where('setting','setting')->get();
        return view('dashboard.setting.index',compact('data'));
    }

    public function edit ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:settings,id'])->validate();
        $data = Setting::find($id);
        switch ($data->key) {
            case 'terms_and_conditions':
                $title = 'الشروط و الاحكام';
                break;
            case 'about_us':
                $title = "عن التطبيق";
                break;
        }
        return view('dashboard.setting.edit',compact('data','title'));
    }

    public function update()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'value_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'value_en'  => 'required|string',
        ]);

        $inputs['value_ar'] = request()->value_ar;
        $inputs['value_en'] = request()->value_en;

        $update = Setting::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');
    }
}
