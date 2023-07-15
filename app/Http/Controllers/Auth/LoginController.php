<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email'     => 'required|email|exists:users',
            'password'  => 'required|min:6|max:50'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }
}
