<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'message' => $items,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\Item,name',
            'description' => 'required|string|max:180',
            'category_id' => 'required|min_digits:2|max_digits:3',
            'rate' => 'required|gt:0|lte:500',
            'quantity' => 'required|gt:0|lte:20',
            'tax' => 'required|gt:8|lte:30'

        ], [
            'name.unique' => 'please add unique name',
            'name' => 'invalid name',
            'rate' => 'invlaid price'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }



        $newItem = new Item();
        $newItem->name = $request->name;
        $newItem->description = $request->description;
        $newItem->category_id = $request->category_id;
        $newItem->quantity = $request->quantity;
        $newItem->rate = $request->rate;
        $newItem->tax = $request->tax;
        $newItem->save();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'item added successfully'
        ],  201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }

        $item = Item::find($request->id);
        if($item){
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'message' => $item,
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'item not found',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $item = Item::find($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\Item,name,'.$request->id.',id',
            'description' => 'required|string|max:180',
            'category_id' => 'required|min_digits:2|max_digits:3',
            'rate' => 'required|gt:0|lte:500',
            'quantity' => 'required|gt:0|lte:20',
            'tax' => 'required|gt:8|lte:30'
        ], [
            'name->unique' => 'uniq name',
            // 'name'=> 'invalid',/
            'rate' => 'invlaid price'
        ]);


        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->quantity = $request->quantity;
        $item->rate = $request->rate;
        $item->tax = $request->tax;
        $item->update();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'item updated successfully'
        ],  201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $item = Item::find($request->id);
        if($item){
            $item->delete();
            return response()->json([
                'code' => '204',
                'status' => 'true',
                'message' => 'item deleted successfully'
            ],  200);
        }

        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'item not found'
        ],  200);
    }
}
