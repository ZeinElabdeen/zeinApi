<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Attach;

class AttachController extends ResponseController
{
    public function delete () {
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:attaches,id',
            ]);
        $data = Attach::findOrFail(request()->id);

        $delete = $data->delete();

        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('response.deleted')],200);

    }
}
