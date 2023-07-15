<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    //store register

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:50',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        auth()->loginUsingId($user->id);

        return redirect()->route('home');
    }
}
