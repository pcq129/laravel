<?php

namespace App\Http\Controllers\API;

use App\Models\Table;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = Table::all();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'data' => $table,
            'messge' => 'Table data fetched successfully'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexBySection($id)
    {
        $section = Section::with('tables')->find($id);
        // dd($section);
        // $table = $section->tables();
        $table = Table::all();
        return response()->json([
            'code' => '200',
            'status' => 'true',
            'data' => $section,
            'messge' => 'Table data fetched successfully'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->name);
        $validator = Validator::make($request->all(), [
            'name' => [Rule::Unique('tables', 'name')->withoutTrashed(), 'required'],
            'status' => ['required', Rule::in(['Available', 'Running', 'Assigned'])],
            'capacity' => ['required', 'numeric', 'between:1,25'],
            'section_id' => ['numeric', 'lt:99'],
        ],$message = ['name.unique' => 'Table already exists']);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'status' => 'false', 'message' => $validator->messages(),], 200);
        }

        $table = new Table();
        $table->name = $request->name;
        $table->status = $request->status;
        $table->capacity = $request->capacity;
        if ($request->section_id) {
            $section = Section::find($request->section_id);
            $table->section()->associate($section);
        }
        $table->save();

        return response()->json([
            'code' => '200',
            'status' => 'true',
            'message' => "Table added successfully"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $table = Table::find($id);
        if ($table) {
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'data' => $table,
                'message' => 'Table data fetched successfully'
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'Table not found',
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => [Rule::Unique('tables', 'name')->ignore($request->id)->withoutTrashed(), 'required'],
            'status' => ['required', Rule::in(['Available', 'Running', 'Assigned'])],
            'capacity' => ['required', 'numeric', 'between:1,25'],
            'section_id' => ['numeric', 'lt:99'],
        ],$message = ['name.unique' => 'Table already exists']);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'status' => 'false', 'message' => $validator->messages(),], 200);
        }

        $table = Table::findOrFail($request->id);
        $table->name = $request->name;
        $table->status = $request->status;
        $table->capacity = $request->capacity;
        $table->section()->dissociate();
        $section = Section::find($request->section_id);
        $table->section()->associate($section);
        $table->save();

        return response()->json([
            'code' => '200',
            'status' => 'true',
            'message' => "Table updated successfully"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        // dd($table->status);

        if ($table && $table->status == "Available") {
            $table->delete();
            return response()->json([
                'code' => '200',
                'status' => 'true',
                'message' => 'Table deleted successfully'
            ], 200);
        }
        else if($table && $table->status == "Running"){
            return response()->json([
                'code' => '200',
                'status' => 'false',
                'message' => 'Table cannot be deleted when occupied',
            ], 200);
        }
        return response()->json([
            'code' => '404',
            'status' => 'false',
            'message' => 'Table not found',
        ], 200);
    }



}
