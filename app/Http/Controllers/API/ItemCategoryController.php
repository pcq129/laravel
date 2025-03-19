<?php

namespace App\Http\Controllers\API;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ItemCategory::all();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'message' => $categories,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\ItemCategory,name',
            'description' => 'required|string|max:180',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }



        $item_category = new ItemCategory();
        $item_category->name = $request->name;
        $item_category->description = $request->description;
        $item_category->save();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'category added successfully'
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

        
        $itemCategory = ItemCategory::find($request->id);
        if ($itemCategory) {
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'data' => $itemCategory,
                'message' => 'data fetched successfully'
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'true',
            'message' => 'not found'
        ], 200);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request)
    {

        $itemCategory = ItemCategory::find($request->id);



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\ItemCategory,name,' . $request->id . ',id',
            'description' => 'required|string|max:180',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }


        if ($itemCategory) {
            $itemCategory->name = $request->name;
            $itemCategory->description = $request->description;
            $itemCategory->update();

            return response()->json([
                'code' => '201',
                'status' => 'true',
                'message' => 'category updated successfully'
            ],  201);
        }
        return response()->json([
            'code' => '404',
            'status' => 'true',
            'message' => 'not found'
        ], 200);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Request $request)
    {
        $itemCategory = ItemCategory::find($request->id);
        if ($itemCategory) {
            $itemCategory->delete();

            return response()->json([
                'code' => '204',
                'status' => 'true',
                'message' => 'category deleted successfully'
            ],  200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'category not found'
        ],  200);
    }
}
