<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends ResponseController
{
    public function index(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
        ]);
        $inputs['title'] = $request->title;
        $inputs['message'] = $request->message;
        $create = Contact::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.contact.success')],200);

    }
}
