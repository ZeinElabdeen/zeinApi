<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Validation\Rule;
use Validator;
use App\Models\Faq;
use App\Http\Controllers\Controller;

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
            'question'  => 'required|string|regex:/[اأإء-ي]/ui',
            'answer'  => 'required|string|regex:/[اأإء-ي]/ui',
        ]);

        $inputs['question'] = request()->question;
        $inputs['answer'] = request()->answer;

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
            'question'  => 'required|string|regex:/[اأإء-ي]/ui',
            'answer'  => 'required|string|regex:/[اأإء-ي]/ui',
        ]);

        $inputs['question'] = request()->question;
        $inputs['answer'] = request()->answer;

        $update = Faq::find(request()->id)->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return redirect('dashboard')->with('success','تم تعديل البيانات بنجاح');
    }

    public function delete ($id) {

        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:settings,id',
            ])->validate();

        $data = Faq::find($id);

        $delete = $data->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف البيانات بنجاح');
    }
}
