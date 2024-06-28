<?php
namespace App\Repositories;

use App\Mail\UserMail;
use App\Models\City;
use App\Models\Group;
use App\Models\User;
use App\Models\UserDetail;
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
                $info->gender           =   $request->gender;
                $info->group_id         =   $request->group_id;
                $info->updated_by       =   $user_id;

                if ($request->filled('password')) {
                    $info->password = Hash::make($request->password);
                }

                DB::beginTransaction();
                try {
                    $info->save();

                    $user_details = UserDetail::where('user_id',$id)->first();
                    $user_details->country_id   = $request->country_id;
                    $user_details->city_id      = $request->city_id;
                    $user_details->save();

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
            'gender'                =>  $request->gender,
            'group_id'              =>  $request->group_id,
            'password'              =>  Hash::make($request->password),
            'created_by'            =>  $user_id,
            'role_id'               =>  2,
            'email_verified_at'     =>  now(), 
        ];

        $info  = [
            'name'  =>  $request->name
        ];

        DB::beginTransaction();
        try {

            $user = User::create($data);

            $user_details  =new UserDetail();
            $user_details->user_id      = $user->id;
            $user_details->country_id   = $request->country_id;
            $user_details->city_id      = $request->city_id;
            $user_details->save();

            if (mailCheck()) {
                Mail::to($request->email)->send(new UserMail((object)$info));
            }
           
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

    public function City(Request $request,$id)
    {
        if (!empty($id)) {
            $info = City::find($id);

            if (!empty($info)){
                $info->name             =   $request->name;
                $info->is_capital       =   $request->is_capital;
                $info->country_id       =   $request->country;
                $info->status           =   1;

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
            'name'                  => $request->name,
            'country_id'            => $request->country,
            'is_capital'            => $request->is_capital,
            'status'                => 1,
        ];
        DB::beginTransaction();
        try {
            City::create($data);
            DB::commit();
            return 'success';
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function BlockCity($id)
    {
        $info = City::find($id);
        if (!empty($info)){
            DB::beginTransaction();
            try {
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

    public function UnblockCity($id)
    {
        $info = City::withTrashed()->find($id);
        if (!empty($info)){
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

    public function Group(Request $request,$id)
    {
        if (!empty($id)) {
            $info = Group::find($id);
            if (!empty($info)){
                $info->title            =   $request->title;
                $info->description      =   $request->description;

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
            'title'                 => $request->title,
            'description'           => $request->description,
        ];
        DB::beginTransaction();
        try {
            Group::create($data);
            DB::commit();
            return 'success';
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function BlockGroup($id)
    {
        $info = Group::find($id);
        if (!empty($info)){
            DB::beginTransaction();
            try {
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

    public function UnblockGroup($id)
    {
        $info = Group::withTrashed()->find($id);
        if (!empty($info)){
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
