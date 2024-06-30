<?php
namespace App\Repositories;

use App\Mail\UserMail;
use App\Models\City;
use App\Models\Event;
use App\Models\Group;
use App\Models\Media;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserEvent;
use App\Models\UserGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SaveRepository {

    public function UploadFile(Request $request,$fileName = null)
    {
        $created_by = Auth::user()->id;
        
        $upload = $request->file($fileName ?? 'file');
        $path   = $upload->getRealPath();
        $file   = file_get_contents($path);
        $base64 = base64_encode($file);
        $file = [
            'name'          =>  $upload->getClientOriginalName(),
            'mime'          =>  $upload->getClientMimeType(),
            'size'          =>  number_format(($upload->getSize() / 1024), 1),
            'attachment'    =>  'data:'.$upload->getClientMimeType().';base64,'.$base64,
            'created_by'    =>  $created_by
        ];
        $info = Media::create($file);
        return $info->id;
    }

    public function RemoveMedia($id)
    {
        try {
            Media::where('id',$id)->delete();
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

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

                    if ($request->group_id) {
                        $group = UserGroup::where('user_id',$id)->first();
                        if ($group->group_id != $request->group_id) {
                            $group->delete();
                            $group              = new UserGroup();
                            $group->user_id     = $id;
                            $group->group_id    = $request->group_id;
                            $group->save();
                        }
                    }
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

            if ($request->group_id) {
                $group              = new UserGroup();
                $group->user_id     = $user->id;
                $group->group_id    = $request->group_id;
                $group->save();
            }

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

    public function Event(Request $request,$id)
    {
        $user_id = Auth::user()->id;

        if ($request->hasFile('file')) {
            $media_id = $this->UploadFile($request);
        }

        if (!empty($id)) {
            $info = Event::find($id);

            if (!empty($info)){
                $info->title            = $request->title;
                $info->for_whom         = $request->for_whom;
                $info->description      = $request->description;
                $info->location         = $request->location;
                $info->from_date        = $request->from_date;
                $info->to_date          = $request->to_date;
                $info->is_specific      = $request->is_specific;
                $info->country_id       = $request->country_id;
                $info->city_id          = $request->city_id;
                $info->updated_by       = $user_id;

                if ($request->hasFile('file')) {
                    $info->media_id     = $media_id;
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
            'title'                 => $request->title,
            'for_whom'              => $request->for_whom,
            'description'           => $request->description,
            'location'              => $request->location,
            'from_date'             => $request->from_date,
            'to_date'               => $request->to_date,
            'is_specific'           => $request->is_specific,
            'country_id'            => $request->country_id,
            'city_id'               => $request->city_id,
            'status'                => 1,
            'created_by'            => $user_id,
        ];

        if ($request->hasFile('file')) {
            $data['media_id'] = $media_id;
        }

        DB::beginTransaction();
        try {
            Event::create($data);
            DB::commit();
            return 'success';
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return $e;
        }
    }

    public function BlockEvent($id)
    {
        $deleted_by = Auth::user()->id;
        $info = Event::find($id);
        if (!empty($info)){
            $info->status       = 0;
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

    public function UnblockEvent($id)
    {
        $updated_by = Auth::user()->id;
        $info = Event::withTrashed()->find($id);
        if (!empty($info)){
            $info->updated_by   = $updated_by;
            $info->deleted_by   = null;
            $info->status       = 1;

            DB::beginTransaction();
            try {
                $info->save();
                $info->restore();
                DB::commit();
                return 'success';
            } catch (Exception $e) {
                dd($e);
                DB::rollback();
                return $e;
            }
        }
        else{
            return __('msg.no_record_found');
        }
    }

    public function RemoveEventMedia($id)
    {
        $updated_by = Auth::user()->id;
        $info = Event::find($id);

        if (!empty($info)){
            $media_id           =   $info->media_id;
            $info->media_id     =   null;
            $info->updated_by   =   $updated_by;

            DB::beginTransaction();
            try {
                $info->save();
                DB::commit();
                $this->RemoveMedia($media_id);
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

    public function AssignEvent(Request $request, $id)
    {
        if (!empty($id)) {
            $info = Event::find($id);

            if (!$info) {
                return "Event not found";
            }
        } else {
            return "Event ID is required";
        }

        DB::beginTransaction();

        try {
            if ($request->user_id == 'all_user') {
                if ($request->country_id && $request->city_id) {
                    $users = User::whereHas('userDetail', function ($q) use ($request) {
                        $q->where('country_id', $request->country_id)
                        ->where('city_id', $request->city_id);
                    })->get();

                    foreach ($users as $user) {
                        $this->updateOrCreateUserEvent($user->id, $request->event_id);
                    }
                } else {
                    $users = User::where('block', 0)->where('role_id', 2)->get();

                    foreach ($users as $user) {
                        $this->updateOrCreateUserEvent($user->id, $request->event_id);
                    }
                }
            } else {
                $this->updateOrCreateUserEvent($request->user_id, $request->event_id);
            }

            DB::commit();
            return 'success';
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    private function updateOrCreateUserEvent($userId, $eventId)
    {
        if (!UserEvent::where('user_id', $userId)->where('event_id', $eventId)->exists()) {
            $user_event = new UserEvent();
            $user_event->user_id = $userId;
            $user_event->event_id = $eventId;
            $user_event->save();
        }
    }

}
