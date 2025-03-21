<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ModifierGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ModifierGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modifierGroup = ModifierGroup::all();
        return response()->json([
            "code" => "201",
            "status" => "true",
            "data" => $modifierGroup,
            "message" => "modifier group fetched successfully"
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\ModifierGroup,name',
            'description' => 'required|string|max:180',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }

        $modifierGroup = new ModifierGroup();
        $modifierGroup->name = $request->name;
        $modifierGroup->description = $request->description;
        $modifierGroup->save();

        return response()->json([
            'code' => '201',
            'status' => 'true',
            'message' => 'Modifier-Group added successfully'
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

        $modifierGroup = ModifierGroup::find($request->id);
        if ($modifierGroup) {
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'data' => $modifierGroup,
                'message' => 'data fetched successfully'
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'true',
            'message' => 'not found',
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $modifierGroup = ModifierGroup::find($request->id);



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:App\Models\ModifierGroup,name,' . $request->id . ',id',
            'description' => 'required|string|max:180',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'success' => 'false', 'message' => $validator->messages(),], 200);
        }


        if ($modifierGroup) {
            $modifierGroup->name = $request->name;
            $modifierGroup->description = $request->description;
            $modifierGroup->update();

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $modifierGroup = ModifierGroup::find($request->id);
        if ($modifierGroup) {
            $modifierGroup->delete();

            return response()->json([
                'code' => '204',
                'status' => 'true',
                'message' => 'modifier-group deleted successfully'
            ],  200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'modifier-group not found'
        ],  200);
    }
}
