<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\Attach;
use App\Http\Controllers\Controller;

class AttachController extends Controller
{
    public function delete ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:attaches,id'])->validate();
        $data = Attach::find($id);
        $delete = $data->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        if ($data->image != null && file_exists(public_path('uploads/attaches/'.$data->image))) {
            unlink(public_path('uploads/attaches/'.$data->image));
        }
        return back()->with('success','تم حذف العنصر بنجاح');

    }
}
