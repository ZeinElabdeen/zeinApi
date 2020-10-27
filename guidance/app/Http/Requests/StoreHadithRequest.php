<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHadithRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'body' => 'required|max:1000',
            'page_number' =>'required|required_without_all:number',
            'number' =>'required|required_without_all:page_number',
            'first_rawy' =>'required|max:191',
            'source_id' =>'required|exists:hadith_source_models,id',
            'book_id' =>'required|exists:books,id'
        ];

        $rules['bab_id'] = request('bab_id') ? 'exists:babs,id' : '';
        return $rules;
    }
}
