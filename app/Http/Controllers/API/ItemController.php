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
            $query->select ('item_categories.id','name');
        }, 'ModifierGroups'=> function($query){
            $query->select ('modifier_groups.id', 'name');
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
            'name' => ['required','string','max:50',Rule::unique('items', 'name')->withoutTrashed()],
            'rate' => 'required|numeric',
            'unit'=> ['required',Rule::in(['pcs','gms'])],
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:6500',
            'quantity' => 'required|numeric',
            'item_type'=> ['required', Rule::in(['veg','non-veg','vegan'])],
            'available'=> ['required','boolean'],
            'short_code'=> ['numeric','nullable'],
            'default_tax'=> ['required','boolean'],
            'category_id' => 'required|min_digits:1|max_digits:3|exists:item_categories,id',
            'description' => 'string|nullable|max:180',
            'tax_percentage' => 'numeric|min:0|max:60',
            'modifier_groups_id'=> ['required'],
        ], [
            'name' => 'Invalid name',
            'rate' => 'Invalid price',
            'name.unique' => 'Please add unique name',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'status' => 'false', 'message' => ($validator->messages()),], 200);
        }





        $newItem = new Item();
        $newItem->name = $request->name;
        $newItem->description = $request->description;
        $newItem->category_id = $request->category_id;
        $newItem->quantity = $request->quantity;
        $newItem->rate = $request->rate;
        $newItem->tax_percentage = $request->tax_percentage;
        $newItem->unit = $request->unit;
        $newItem->item_type = $request->item_type;
        $newItem->available = $request->available ;
        $newItem->short_code = $request->short_code ;
        // $newItem->image = $request->image ;
        $newItem->default_tax = $request->default_tax ;

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $newItem -> image = 'images/'.$imageName;
        $newItem->save();
        $newItem->ModifierGroups()->sync($request->modifier_groups_id);

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
            return response()->json(['code' => 400, 'status' => 'false', 'message' => $validator->messages(),], 200);
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
        dd($request);
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required','string','max:50',Rule::unique('items', 'name')->ignore($request->id, 'id')->withoutTrashed()],
            'rate' => 'required|numeric',
            'unit'=> ['required',Rule::in(['pcs','gms'])],
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif',
            'quantity' => 'required|numeric',
            'item_type'=> ['required', Rule::in(['veg','non-veg','vegan'])],
            'available'=> ['required','boolean'],
            'short_code'=> ['numeric','nullable'],
            'default_tax'=> ['required','boolean'],
            'category_id' => 'required|min_digits:1|max_digits:3|exists:item_categories,id',
            'description' => 'string|nullable|max:180',
            'tax_percentage' => 'numeric|min:0|max:60',
            'modifier_groups_id'=> ['required'],
            // 'name' => ['required','string','max:50',Rule::unique('item_categories', 'name')->withoutTrashed()->ignore($request->id)],
            // // 'name' => 'required|string|max:50|unique:App\Models\Item,name,'.$request->id.',id',
            // 'description' => 'nullable|string|max:180',
            // 'category_id' => 'required|min_digits:1|max_digits:3|exists:item_categories,id',
            // 'rate' => 'required|numeric',
            // 'quantity' => 'required|numeric',
            // 'tax' => 'required|numeric',
            // // 'unit'=> [Rule::enum(ServerStatus::class)->only([ServerStatus::gms, ServerStatus::pcs])],
            // 'unit' => 'required'
        ], [
            'name->unique' => 'Please provide a unique name',
            // 'name'=> 'invalid',/
            'rate' => 'Invalid price'
        ]);


        if ($validator->fails()) {
            return response()->json(['code' => 400, 'status' => 'false', 'message' => $validator->messages(),], 200);
        }

        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->quantity = $request->quantity;
        $item->rate = $request->rate;
        $item->tax_percentage = $request->tax_percentage;
        $item->unit = $request->unit;
        $item->item_type = $request->item_type;
        $item->available = $request->available ;
        $item->short_code = $request->short_code ;
        $item->image = $request->image ;
        $item->default_tax = $request->default_tax ;
        $item->update();
        $item->ModifierGroups()->sync($request->modifier_groups_id);

        // $item->name = $request->name;
        // $item->description = $request->description;
        // $item->category_id = $request->category_id;
        // $item->quantity = $request->quantity;
        // $item->rate = $request->rate;
        // $item->tax = $request->tax;
        // $item->unit = $request->unit;
        // $item->update();

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
