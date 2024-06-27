<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests,DispatchesJobs, ValidatesRequests;

    public function have_permission($id) 
    {
        $auth = Auth::user()->role->permission;
        if(empty(session('permission'))) {
            session()->put('permissions',$auth );
        }
        if ($id == 0) return true;

        #$permissions = json_decode(session('permissions')); #for production
        $permissions = json_decode($auth);
        
        if(in_array($id, $permissions)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_permissions()
    {
        return [
            'can_handle_all_organization'   => $this->have_permission(1),
            'can_handle_all_branch'         => $this->have_permission(2),
            'can_save'                      => $this->have_permission(3),
            'can_block'                     => $this->have_permission(4),
            'can_delete'                    => $this->have_permission(5),
        ];
    }
}
