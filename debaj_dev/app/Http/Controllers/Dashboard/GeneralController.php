<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact_data;
use App\Models\Pages;
use App\Models\Seo_settings;
use App\Models\Social_page;

use App\Http\Controllers\Controller;
use Validator;

class GeneralController extends Controller
{
     /*public function index () {
        $data = Faq::get();
       return view('dashboard.general.index',compact('data'));
     }*/

    public function settings_seo() {
        $data = Seo_settings::find('1');
        $title = 'Seo settings';
        return view('dashboard.general.seo_settings',compact('data','title'));
    }

    public function settings_exe() {

      $this->validate(request(),[
          'title_en'  => 'required|string',
          'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
          'description_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
          'description_en'  => 'required|string',
          'keywords_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
          'keywords_en'  => 'required|string',
      ]);
        $inputs['title_en'] = request()->title_en;
        $inputs['title_ar'] = request()->title_ar;
        $inputs['description_ar'] = request()->description_ar;
        $inputs['description_en'] = request()->description_en;
        $inputs['keywords_ar'] = request()->keywords_ar;
        $inputs['keywords_en'] = request()->keywords_en;
        $update = Seo_settings::find(1)->update($inputs);

        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');

    }

    public function contact_data() {
        $data = Contact_data::find('1');
        $title = 'Contact data';
        return view('dashboard.general.contact_data',compact('data','title'));
    }

    public function contact_data_exe() {

      $this->validate(request(),[
          'mobile'  => 'required|numeric',
          'tel'  => 'numeric',
          'mail'  => 'required|email|max:255',
          'adress_ar'  => 'required|string',
          'adress_en'  => 'required|string',
          'map_fram'  => 'required|string',
      ]);
        $inputs['mobile'] = request()->mobile;
        $inputs['tel'] = request()->tel;
        $inputs['mail'] = request()->mail;
        $inputs['adress_en'] = request()->adress_en;
        $inputs['adress_ar'] = request()->adress_ar;
        $inputs['map_fram'] = request()->map_fram;

        $update = Contact_data::find(1)->update($inputs);

        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');

    }

    public function social_pages() {
        $data = Social_page::find('1');
        $title = 'social pages';
        return view('dashboard.general.social_page',compact('data','title'));
    }

    public function social_pages_exe() {
      $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
      $this->validate(request(),[
          'facebook'  => 'string|regex:'.$regex,
          'twiter'    => 'string|regex:'.$regex,
          'instgram'  => 'string|regex:'.$regex,
          'pintrist'  => 'string|regex:'.$regex,
      ]);
        $inputs['facebook'] = request()->facebook;
        $inputs['twiter'] = request()->twiter;
        $inputs['instgram'] = request()->instgram;
        $inputs['pintrist'] = request()->pintrist;


        $update = Social_page::find(1)->update($inputs);

        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');

    }

    public function about_us() {
        $data = Pages::find('1');
        $title = 'about us';
        return view('dashboard.general.about_us',compact('data','title'));
    }

    public function terms() {
        $data = Pages::find('2');
        $title = 'Terms and Conditions';
        return view('dashboard.general.about_us',compact('data','title'));
    }

    public function about_us_exe() {
      $this->validate(request(),[
          'title_en'  => 'required|string',
          'title_ar'    => 'required|string|regex:/[اأإء-ي]/ui',
          'content_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
          'content_en'  => 'required|string',
      ]);
        $inputs['title_en'] = request()->title_en;
        $inputs['title_ar'] = request()->title_ar;
        $inputs['content_ar'] = request()->content_ar;
        $inputs['content_en'] = request()->content_en;


        $update = Pages::find(request()->id)->update($inputs);

        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');

    }
}
