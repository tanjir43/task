<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index() {
        $withdraws = Transaction::where(['transaction_type'=>'withdraw','status'=>1,'deleted'=>0])->get();
        $users = User::all();
        return view('home.withdraw',compact('withdraws','users'));
    }

    public function store (Request $request) {
        #dd(now()->dayOfWeek);
        //validate
        $request->validate([
            'user_id'   => 'required',
            'amount' => 'required|numeric|min:1',
          
        ]);
        //store
        $withdraw = new Transaction();
        $withdraw->user_id = $request->user_id;
        $withdraw->amount = $request->amount;
        $withdraw->date = now();
        $withdraw->transaction_type = 'withdraw';
        $withdraw->status = 1;
        $withdraw->deleted = 0;


        $user = User::find($request->user_id);

        if($user->account_type == 'individual' ){

            $this_month_withdraw = Transaction::where(['user_id'=> $user->id,'transaction_type'=>'withdraw'])->whereMonth('created_at', now()->month)->sum('amount');
            #dd($this_month_withdraw);
            if ($this_month_withdraw <= 5000) {
                $FreeAmount = 5000 - $this_month_withdraw;
        
                if ($request->amount <= $FreeAmount) {
                    $withdraw->fee = 0;
                } else {
                    $withdraw->fee = ($request->amount - $FreeAmount) * 0.015;
                }
            } else {
                $withdraw->fee = $request->amount * 0.015;
            }
            
            if($request->amount <= 1000){
                $withdraw->fee = 0;

            if(now()->dayOfWeek == 5){
                
                $withdraw->fee = 0;
            }else{
                $withdraw->fee = $request->amount * 0.015;
            }
           
        }else{
            $withdraws = Transaction::where(['user_id'=> $user->id,'transaction_type'=>'withdraw'])->sum('amount');

            if ($withdraws > 50000) {
                $withdraw->fee = $request->amount * 0.015; 
            } else {
                $withdraw->fee = $request->amount * 0.025; 
            }
        }
        #dd($withdraw->fee);

        $withdraw->save();

        //update user balance
        $user = User::find($request->user_id);
        $user->balance = $user->balance - $request->amount - $withdraw->fee;
        $user->save();

        return redirect()->route('withdraw')->with('success','Withdraw added successfully');
    }

}
}
