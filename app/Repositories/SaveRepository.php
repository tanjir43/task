<?php
namespace App\Repositories;

use App\Mail\UserMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SaveRepository {

    public function User(Request $request,$id)
    {
        $user_id = Auth::user()->id;

        if (!empty($id)) {
            $info = User::find($id);

            if (!empty($info)){
                $info->name             =   $request->name;
                $info->email            =   $request->email;
                $info->updated_by       =   $user_id;

                if ($request->filled('password')) {
                    $info->password = Hash::make($request->password);
                }

                DB::beginTransaction();
                try {
                    $info->save();
                    DB::commit();
                    return 'success';
                } catch (Exception $e) {
                    DB::rollback();
                    return $e;
                }
            }
            else {
                return  "No record found";
            }
        }

        $data = [
            'name'                  =>  $request->name,
            'email'                 =>  $request->email,
            'password'              =>  Hash::make($request->password),
            'created_by'            =>  $user_id,
            'role_id'               =>  3,
            'email_verified_at'     =>  now(), 
        ];

        $info  = [
            'name'  =>  $request->name
        ];

        DB::beginTransaction();
        try {
            User::create($data);
            Mail::to($request->email)->send( new UserMail((object)$info));
            DB::commit();
            return 'success';

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return $e;
        }
    }

    public function BlockUser($id)
    {
        $deleted_by = Auth::user()->id;
        $info = User::find($id);
        if (!empty($info)){
            $info->block      = 1;
            $info->deleted_by   = $deleted_by;
            DB::beginTransaction();
            try {
                $info->save();
                $info->delete();
                DB::commit();
                return 'success';
            } catch (Exception $e) {
                DB::rollback();
                return $e;
            }
        }
        else{
            return __('msg.no_record_found');
        }
    }

    public function UnblockUser($id)
    {
        $updated_by = Auth::user()->id;
        $info = User::withTrashed()->find($id);
        if (!empty($info)){
            $info->updated_by   = $updated_by;
            $info->deleted_by   = null;
            $info->block      = 0;

            DB::beginTransaction();
            try {
                $info->save();
                $info->restore();
                DB::commit();
                return 'success';
            } catch (Exception $e) {
                DB::rollback();
                return $e;
            }
        }
        else{
            return __('msg.no_record_found');
        }
    }
}
