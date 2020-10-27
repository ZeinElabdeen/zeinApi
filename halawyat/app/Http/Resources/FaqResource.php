<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FaqResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(request()->header('lang') == 'ar'){
            $answer = 'answer_ar';
            $question = 'question_ar';
        }else{
            $answer = 'answer_en';
            $question = 'question_en';
        }
        return $this->collection->transform(function($data) use ($question,$answer){
            return [
                'id' => $data->id,
                'question' => $data->$question,
                'answer' => $data->$answer,

            ];
        });
    }
}
