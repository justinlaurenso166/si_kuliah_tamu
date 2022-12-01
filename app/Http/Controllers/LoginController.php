<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login-and-register.login',[
            'title' => 'Login - Pradita University\'s Guest Lecturers'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        // dd($credentials);
        if(Auth::attempt($credentials)){
            if(auth()->user()->id_role == '1'){
                return redirect()->intended(route('dashboardadmin.index'));
            }else if(auth()->user()->id_role == '2'){
                return redirect()->intended(route('dashboarduser.index'));
            }
        }
        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
