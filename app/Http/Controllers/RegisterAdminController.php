<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all()->where('id_role', '=', '1');
        return view('dashboard-admin.add-admin.detail-admin.detail-admin',[
            'title' => 'Register Admin - Pradita University\'s Guest Lecturers',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard-admin.add-admin.input-admin.input-admin',[
            'title' => 'Register Admin - Pradita University\'s Guest Lecturers',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'username' => 'required|alpha_dash|unique:users',
        ]);
        $admin = [
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'username' => $validatedData['username'],
            'id_role' => '1',
        ];
        User::create($admin);
        return redirect(route('registeradmin.index'))->with('success', 'Data Admin has added successfully');
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
        User::where('id', $id)->delete();
        return redirect(route('registeradmin.index'))->with('success', 'Data Admin has deleted successfully');
    }
}
