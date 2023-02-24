<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => 'personalInfo',
            'users' => User::where('id', Auth()->user()->id)->first()

        ]);
    }
    public function updateUser(Request $request)
    {
        // $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' =>  'required|min:5|max:255',
            'address' =>  'required|max:255',
            'province' =>  'required|max:255',
            'city' =>  'required|max:255',
            'zip_code' =>  'required|max:255',
            'phone_number' =>  'required|max:255',
        ]);

        $user['name'] = $validatedData['name'];
        $user['username'] = $validatedData['username'];
        $user['email'] = $validatedData['email'];
        $user['address'] = $validatedData['address'];
        $user['province'] = $validatedData['province'];
        $user['city'] = $validatedData['city'];
        $user['zip_code'] = $validatedData['zip_code'];
        $user['phone_number'] = $validatedData['phone_number'];

        if (!empty($validatedData['password'])) {
            $user['password'] = bcrypt($validatedData['password']);
        }



        User::where('id', Auth()->user()->id)->save($user);
        return redirect('/profile')->with('success', 'Personal data has been updated!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
