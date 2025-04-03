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
        //     "email": "user@us.com",
        //     "name": "ha1",
        //     "mobile": "8949594859",
        //     "people": "45",
        //     "section": "Ground Floor",
        //     "section_id": 1
        // }
        // $customer = Customer::find($request->email, $email);
        // dd($customer);
        $customer = new Customer();
        $customer->email = $request->email;
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->save();
        $customer->tables()->associate($request->table);
    }
}
