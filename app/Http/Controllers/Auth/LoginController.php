<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() {
        Auth::logout();
        return view('auth.login');
    }
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email|max:120',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('/');
        }
        return redirect()->back()->withErrors(array('error'=>'Invalid Email or Password'));

    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
