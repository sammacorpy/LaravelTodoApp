<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index(){
        Auth::logout();
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|alpha|max:50|min:4',
            'email' => 'required|email|unique:users|max:120',
            'password' => 'required|min:8|confirmed',
            'password_confirmation'=> 'required|same:password'
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60)
        ]);

        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect()->route('/');

    }
}
