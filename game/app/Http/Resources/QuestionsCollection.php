<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
            return [
                'id' => $data->id,
                'title' => $data->title,
                'image' => $data->image,
                'is_uploaded' => $data->is_uploaded,
                'answers' => ($data->answers == [])? []: new AnswersCollection($data->answers),
            ];
        });
    }
}
