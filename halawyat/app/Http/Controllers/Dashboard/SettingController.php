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

    public function edit ($key) {

        Validator::make(['key' => $key],['key' => 'required|string'])->validate();

        switch ($key) {

            case 'contact':
                $title = 'ارقام التواصل';
                $data = Setting::where('setting','contact')->get();
                return view('dashboard.setting.contacts',compact('data','title'));
                break;

            case 'about_us':
                $data = Setting::where('key',$key)->first();
                $title = 'عن التطبيق';
                return view('dashboard.setting.edit',compact('data','title'));
                break;

            case 'terms_and_conditions':
                $title = "الشروط والاحكام";
                $data = Setting::where('key','terms')->first();
                return view('dashboard.setting.edit',compact('data','title'));
                break;
        }
    }

    public function update()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'id' => 'required|integer|exists:settings,id',
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

    public function updateContact()
    {
        $this->validate(request(),[
            'id' => 'required|integer|exists:settings,id',
            'value'  => 'required|string',
        ]);

        $inputs['value_ar'] = request()->value;
        $inputs['value_en'] = request()->value;

        $update = Setting::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');
    }

}
