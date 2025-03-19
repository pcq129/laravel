<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Modifier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ModifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modifiers = Modifier::all();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'message' => $modifiers,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\Modifier,name',
            'description' => 'required|string|max:180',
            'modifier_group_id' => 'required|min_digits:2|max_digits:3',
            'rate' => 'required|gt:0|lte:500',
            'quantity' => 'required|gt:0|lte:20',
            'unit' => 'required|in:grams,pieces'

        ], [
            'name.unique' => 'please add unique name',
            'name' => 'invalid name',
            'rate' => 'invlaid price'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }

        $newModifier = new Modifier();
        $newModifier->name = $request->name;
        $newModifier->description = $request->description;
        $newModifier->modifier_group_id = $request->modifier_group_id;
        $newModifier->quantity = $request->quantity;
        $newModifier->rate = $request->rate;
        $newModifier->unit = $request->unit;
        $newModifier->save();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'modifier added successfully'
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

        $modifier = Modifier::find($request->id);
        if($modifier){
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'message' => $modifier,
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'Modifier not found',
        ], 404);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $modifier = Modifier::find($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\Modifier,name,'.$request->id.',id',
            'description' => 'required|string|max:180',
            'modifier_group_id' => 'required|min_digits:2|max_digits:3',
            'rate' => 'required|gt:0|lte:500',
            'quantity' => 'required|gt:0|lte:20',
            'unit' => 'required|in:grams,pieces',
            'id'=> 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }
        $modifier->name = $request->name;
        $modifier->description = $request->description;
        $modifier->modifier_group_id = $request->modifier_group_id;
        $modifier->quantity = $request->quantity;
        $modifier->rate = $request->rate;
        $modifier->unit = $request->unit;
        $modifier->update();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'modifier updated successfully'
        ],  201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }


        $modifier = Modifier::find($request->id);
        if($modifier){
            $modifier->delete();
            return response()->json([
                'code' => '204',
                'status' => 'true',
                'message' => 'modifier deleted successfully'
            ],  200);
        }

        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'modifier not found'
        ],  200);
    }
}
