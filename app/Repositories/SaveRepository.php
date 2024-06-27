<?php
namespace App\Repositories;

use App\Mail\UserAcceptMail;
use App\Mail\UserMail;
use App\Models\City;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeHistory;
use App\Models\Media;
use App\Models\Member;
use App\Models\Membership;
use App\Models\TempEmployee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SaveRepository {

    public function UserForm(Request $request){
    
        #$role_id = 7;
        $user = [
            'name'                  =>  $request->name,
            'email'                 =>  $request->email,
            'password'              =>  Hash::make($request->password),
            'nid'                   =>  $request->nid,
            'phone'                 =>  $request->phone,
            'created_by'            =>  '0'
        ];
  
        $info  = [
            'name'  =>  $request->name
        ];

        DB::beginTransaction();
        try {
            TempEmployee::create($user);
            Mail::to($request->email)->send( new UserMail((object)$info));
            DB::commit();
            return 'success';

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return $e;
        }
    }

}
