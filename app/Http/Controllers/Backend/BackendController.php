<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactOption;
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

    public function saveContactOptionMap(Request $request)
    {
        $contact_option = ContactOption::findOrFail($request->id);

        $contact_option->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response([
            'status' => 'success',
            'message' => 'Contact option map has been successfully updated!'
        ]);
    }
}
