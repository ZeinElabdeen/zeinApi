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

    public function edit ($type) {
        Validator::make(['type' => $type],['type' => 'required|string|in:about_us,contacts,terms_and_conditions'])->validate();
        switch ($type) {

            case 'contacts':
                $title = 'ارقام التواصل';
                $data = Setting::where('setting','contacts')->get();
                return view('dashboard.setting.contacts',compact('data','title'));
                break;

            case 'about_us':
                $title = "عن التطبيق";
                $data = Setting::where('key','about_us')->first();
                return view('dashboard.setting.edit',compact('data','title'));
                break;

            case 'terms_and_conditions':
                $title = "الشروط والاحكام";
                $data = Setting::where('key','terms_and_conditions')->first();  
                return view('dashboard.setting.edit',compact('data','title'));
                break;
        }
    }

    public function update()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'id' => 'required|integer|exists:settings,id',
            'value'  => 'required|string|regex:/[اأإء-ي]/ui',
        ]);

        $inputs['value'] = request()->value;

        $update = Setting::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');
    }

    public function updateContact()
    {
//        dd(request()->all());
        $this->validate(request(),[
            'id' => 'required|integer|exists:settings,id',
            'value'  => 'required|string',
        ]);

        $inputs['value'] = request()->value;

        $update = Setting::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');
    }
}
