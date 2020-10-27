<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ItemDetails;
use Validator;
use App\Http\Controllers\Controller;

class ItemDetailsController extends Controller
{
    public function delete ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:item_details,id'])->validate();
        $data = ItemDetails::find($id);
        $delete = $data->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }

        return back()->with('success','تم حذف العنصر بنجاح');

    }
}
