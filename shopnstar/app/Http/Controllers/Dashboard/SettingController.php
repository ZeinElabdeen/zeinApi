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
        Validator::make(['key' => $key],['key' => 'required|string|in:about_us,contact,terms_and_condition'])->validate();

        switch ($key) {

          case 'contact':
              $title = 'ارقام التواصل';
              $data = Setting::where('setting','contact')->get();
              return view('dashboard.setting.contacts',compact('data','title'));
              break;

            case 'terms_and_conditions':
                $title = 'الشروط و الاحكام';
                $data = Setting::where('key',$key)->first();
                break;
            case 'about_us':
                $title = "من نحن";
                $data = Setting::where('key',$key)->first();
                break;
        }
        return view('dashboard.setting.edit',compact('data','title'));
    }

    public function update()
    {

        $this->validate(request(),[
            'value'  => 'required|string',
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
