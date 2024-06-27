<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request):RedirectResponse
    {
        $user = User::find($request->route('id'));
        if($user->hasVerifiedEmail()) {
            return redirect()->intended(config('fortify.home')). '?verfied=1';
        }
        if($user->markEmailAsVerifed()) {
            event(new Verified($user));
        }
        $message = __('Your email has been verified');

        return redirect('login')->with('status',$message);
    }

    public function activateUser($activation_code)
    {
        $info = DB::table('password_reset_tokens')->where('token',$activation_code)->first();
        if(!empty($info)){
            try {
                DB::table('users')->where('email',$info->email)->update([
                    'email_verified_at' => now()
                ]);
                DB::table('password_reset_tokens')->where('token',$activation_code)->delete();
                return redirect(route('login'))->with(['success'=> 'successfully verified']);
            }catch (Exception $e) {
                dd($e);
                return back()->with(['errors_' => ['try again']]);   
            }
        }
        abort(404);  
    }
}
