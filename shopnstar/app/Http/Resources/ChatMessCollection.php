<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class
ChatMessCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
          //  $image = ($data->user->image != null)? config('user_storage').$data->user->image :null;
          if($data->sender_type == 1)
          {
            $sender_name = $data->chat->user->username;
            $sender_image = ($data->chat->user->image != null)? config('user_storage').$data->chat->user->image :null;
            $sender_type ='user';
          }else{
            $sender_name = $data->chat->vendor->name;
            $sender_image = ($data->chat->vendor->image != null)? config('vendor_storage').$data->chat->vendor->image :null;
            $sender_type ='vendor';
          }

            return [
                'id' => $data->id,
                'chat_id' => $data->chat_id,
                'mesg' => $data->mesg,
                'type' => $data->type,
                'sender_type' => $sender_type,
                'sender_name'   => $sender_name,
                'sender_image' => $sender_image,
                'created_at' => $data->created_at->format('d/m/Y h:i A'),

            ];
        });
    }
}
