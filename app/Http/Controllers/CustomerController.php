<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Table;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function assign_table(Request $request)
        {
            // {
            //     "email": "test@test.com",
            //     "name": "Harmit",
            //     "mobile": "9485495837",
            //     "people": "75",
            //     "section": "Ground Floor",
            //     "section_id": 1,
                // "table_ids": [
                //     2
                // ]
            // }
        $customer = Customer::where('email',$request->email)->first();
        $allAvailable = 1;
        if(!$customer){
            $customer = new Customer();
            $customer->email = $request->email;
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->save();
        }
        foreach ($request->table_ids as $table_id) {
            $table = Table::find($table_id);
            if($table->status == "Available"){
                $table->status = "Assigned";
                $table->assigned_to = $customer->id;
            }else{
                $GLOBALS[$allAvailable]=0;
            }
            $table->save();
        }

        if($allAvailable){
            return response()->json([
                "code"=> "200",
                "status"=>"true",
                "message"=>"Tables assigned successfully",
            ],200);
        }else{
            return response()->json([
                "code"=> "200",
                "status"=>"false",
                "message"=>"Only available tables are assigned",
            ],200);
        }


    }
}
