<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $transactions = Transaction::where(['status'=>1,'deleted'=>0])->get();
        return view('home.index',compact('transactions'));
    }
}
