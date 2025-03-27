<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use App\Enums\ServerStatus;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with(['Category'=> function($query){
            $query->select ('id','name');
        }])->orderBy('created_at', 'desc')->get();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'data' => $items,
            'message'=> 'Items fetched successfully'
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:50',Rule::unique('item_categories', 'name')->withoutTrashed()],
            'description' => 'required|string|max:180',
            'category_id' => 'required|min_digits:1|max_digits:3|exists:item_categories,id',
            'rate' => 'required|numeric',
            'quantity' => 'required|numeric',
            'tax' => 'required|numeric',
            // 'unit'=>  [Rule::enum(ServerStatus::class)->only([ServerStatus::gms, ServerStatus::pcs])],
            'unit'=> 'required'
        ], [
            'name.unique' => 'Please add unique name',
            'name' => 'Invalid name',
            'rate' => 'Invalid price'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => ($validator->messages()),], 200);
        }



        $newItem = new Item();
        $newItem->name = $request->name;
        $newItem->description = $request->description;
        $newItem->category_id = $request->category_id;
        $newItem->quantity = $request->quantity;
        $newItem->rate = $request->rate;
        $newItem->tax = $request->tax;
        $newItem->unit = $request->unit;
        $newItem->save();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'Item added successfully'
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
                'data' => $item,
                'message'=>'Item fetched successfully'
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'Item not found',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $item = Item::find($request->id);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:50',Rule::unique('item_categories', 'name')->withoutTrashed()->ignore($request->id)],
            // 'name' => 'required|string|max:50|unique:App\Models\Item,name,'.$request->id.',id',
            'description' => 'required|string|max:180',
            'category_id' => 'required|min_digits:1|max_digits:3|exists:item_categories,id',
            'rate' => 'required|numeric',
            'quantity' => 'required|numeric',
            'tax' => 'required|numeric',
            // 'unit'=> [Rule::enum(ServerStatus::class)->only([ServerStatus::gms, ServerStatus::pcs])],
            'unit' => 'required'
        ], [
            'name->unique' => 'Please provide a unique name',
            // 'name'=> 'invalid',/
            'rate' => 'Invalid price'
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
        $item->unit = $request->unit;
        $item->update();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'Item updated successfully'
        ],  201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item){
            $item->delete();
            return response()->json([
                'code' => '204',
                'status' => 'true',
                'message' => 'Item deleted successfully'
            ],  200);
        }

        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'Item not found'
        ],  200);
    }
}
