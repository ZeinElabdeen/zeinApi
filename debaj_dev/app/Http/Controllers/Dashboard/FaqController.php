<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Validator;

class FaqController extends Controller
{
    public function index () {
        $data = Faq::get();
        return view('dashboard.faq.index',compact('data'));
    }

    public function create () {
        return view('dashboard.faq.create');
    }

    public function store()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'question_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'answer_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'question_en'  => 'required|string',
            'answer_en'  => 'required|string',
        ]);

        $inputs['question_ar'] = request()->question_ar;
        $inputs['answer_ar'] = request()->answer_ar;
        $inputs['question_en'] = request()->question_en;
        $inputs['answer_en'] = request()->answer_en;

        $create = Faq::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة العناصر بنجاح');
    }

    public function edit ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:faq,id'])->validate();
        $data = Faq::find($id);
        $title = 'Faq';
//        dd($data);
        return view('dashboard.faq.edit',compact('data','title'));
    }

    public function update()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'question_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'answer_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'question_en'  => 'required|string',
            'answer_en'  => 'required|string',
        ]);

        $inputs['question_ar'] = request()->question_ar;
        $inputs['answer_ar'] = request()->answer_ar;
        $inputs['question_en'] = request()->question_en;
        $inputs['answer_en'] = request()->answer_en;

        $update = Faq::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل البيانات بنجاح');
    }

    public function delete ($id) {

      Validator::make(['id' => $id],[
          'id'  => 'required|integer',
      ])->validate();

        $question = Faq::find($id);

        $delete = $question->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف البيانات بنجاح');
     }
}
