<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact;
use Validator;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index () {
        $data = Contact::orderBy('id','desc')->get();

        return view('dashboard.contact_us',compact('data'));
    }

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:ads,id',
        ])->validate();
        $ad = Contact::findOrFail($id);
        $delete = $ad->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
