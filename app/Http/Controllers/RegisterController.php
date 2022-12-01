<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login-and-register.register',[
            'title' => 'Register - Pradita University\'s Guest Lecturers'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required',
            'password1' => 'required',
            'password2' => 'required|same:password1',
        ]);

        $user = [
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password1']),
            'id_role' => '2'
        ];
        User::create($user);
        return redirect()->intended(route('login.index'))->with('success','Register success please login now!');
    }
}
