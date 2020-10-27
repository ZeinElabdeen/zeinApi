<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends ResponseController
{
    public function index(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $inputs['title'] = $request->title;
        $inputs['phone'] = $request->phone;
        $inputs['message'] = $request->message;
        $create = Contact::create($inputs);
        if (!$create) {
            return response()->json(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.contact.success')], 200);

    }

}
