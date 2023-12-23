<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function changeAttribute(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->{$request->attribute} = $request->enabled;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Attribute has been successfully updated!'
        ]);
    }
}
