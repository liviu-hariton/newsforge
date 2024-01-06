<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactOption;
use App\Traits\UniqueSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BackendController extends Controller
{
    use UniqueSlug;

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

    public function setSortOrder(Request $request)
    {
        $model = str_replace("^", "\\", $request->model);
        $items = $request->items;

        // Remove the last empty item from the array
        // as it is added by the Javascript Sortable library
        unset($items[count($items) - 1]);

        foreach($items as $item_order=>$item_id) {
            $model::where('id', $item_id)
                ->update([
                    'sort_order' => $item_order
                ]);
        }

        $this->forceClearCache($model);

        return response([
            'status' => 'success',
            'message' => 'Order updated successfully'
        ]);
    }

    public function inlineEdit(Request $request)
    {
        $model = str_replace("^", "\\", $request->model);

        if($request->check_exists == "true") {
            $object = $model::where($request->field, $request->value)
                ->where('id', '!=', $request->id)
                ->first();

            if($object) {
                return response([
                    'status' => 'warning',
                    'message' => 'The value already exists!'
                ], 419);
            }
        }

        $object = $model::findOrFail($request->id);
        $object->{$request->field} = $request->value;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'The value has been successfully updated!'
        ]);
    }
}
