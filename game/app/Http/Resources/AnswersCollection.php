<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnswersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $x = $this->collection->transform(function($data) {
		  if(!empty($data->title))	{
            return [
                'id' => $data->id,
                'title' => $data->title,
            ];
		  }
        });
		
		if(!empty($x))
		{
			return array_filter($x->toArray());
			
		}	
    }
}
