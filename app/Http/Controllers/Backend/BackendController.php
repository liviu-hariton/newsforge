<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ModelCache;
use App\Traits\UniqueSlug;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    use UniqueSlug, ModelCache;

    public function changeAttribute(Request $request) {
        // Convert the model name received in the request, replacing "^" with "\"
        $model = str_replace("^", "\\", $request->model);

        // If the 'id' in the request is an array, use it; otherwise, create an array with a single element
        $ids = is_array($request->id) ? $request->id : [$request->id];

        // Update records in the database where the 'id' is in the provided array
        // Set the specified attribute to the provided 'enabled' value
        $model::whereIn('id', $ids)
            ->update([$request->attribute => $request->enabled]);

        $this->forceClearCache($model);

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
