<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index() {
        $deposits = Transaction::where(['transaction_type'=>'deposit','status'=>1,'deleted'=>0])->get();
        $users = User::all();
        return view('home.deposit',compact('deposits','users'));
    }

    public function store(Request $request) {
        //validate
        $request->validate([
            'user_id'   => 'required',
            'amount' => 'required|numeric|min:1',
          
        ]);
        //store
        $deposit = new Transaction();
        $deposit->user_id = $request->user_id;
        $deposit->amount = $request->amount;
        $deposit->date = now();
        $deposit->transaction_type = 'deposit';
        $deposit->status = 1;
        $deposit->deleted = 0;
        $deposit->save();

        //update user balance
        $user = User::find($request->user_id);
        $user->balance = $user->balance + $request->amount;
        $user->save();

        return redirect()->route('deposit')->with('success','Deposit added successfully');
    }
}
