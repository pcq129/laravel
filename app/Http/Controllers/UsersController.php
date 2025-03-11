<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'description' => 'required|string|max:255',
        // ]);

        $user = new Users;
        $user->first_name = $request->get('firstName');
        $user->last_name = $request->get('lastName');
        $user->user_name = $request->get('userName');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->password = $request->get('password');
        $user->save();



    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $user)
    {

        $user->update(
            $user->first_name = $request->get('firstName'),
            $user->last_name = $request->get('lastName'),
            $user->user_name = $request->get('userName'),
            $user->phone = $request->get('phone'),
            $user->email = $request->get('email'),
            $user->address = $request->get('address'),
            // $user->password = $request->get('password'),
        );

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','Product deleted successfully');
    }
}
