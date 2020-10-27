<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Validator;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function setting () {
        $data = Setting::all();
        return view('dashboard.setting.index',compact('data'));
    }

    public function edit ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:settings,id'])->validate();
        $data = Setting::find($id);
        switch ($data->key) {
            case 'terms_and_conditions_ar':
                $title = 'الشروط و الاحكام بالعربية';
                break;
            case 'about_us_ar':
                $title = "عن التطبيق بالعربية";
                break;
			case 'terms_and_conditions_en':
                $title = 'الشروط و الاحكام بالانجليزية';
                break;
            case 'about_us_en':
                $title = "عن التطبيق بالانجليزية";
                break;
			case 'point_value':
                $title = "point value";
                break;	
			case 'tax':
                $title = "tax";
                break;	
			case 'item_point':
                $title = "item point";
                break;		
					
        }
        return view('dashboard.setting.edit',compact('data','title'));
    }

    public function update()
    {
//        dd(request()->all());

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
}
