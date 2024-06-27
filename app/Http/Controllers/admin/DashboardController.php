<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        session()->put('role',strtolower($role));
        if($role->id != 3){
            return view('dashboard');
        }
        else{
            return redirect()->back()->with(['errors_' => [__('msg.access_deny')]]);  
        }
    }
}
