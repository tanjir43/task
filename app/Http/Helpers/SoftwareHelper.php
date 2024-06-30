<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if(!function_exists('DebugMe')) {
    function DebugMe($value, $die = 0) {
        echo '<pre>';
        if(is_array($value)) {
            print_r($value);
        } elseif(is_object($value)) {
            print_r($value);
        } else {
            echo $value;
        }
        echo '</pre>';
        if($die != 0) {
            die();
        }
    }
}

if(!function_exists('Organization')) {
    function Organization($name) {
        $orga = DB::table('organizations')->where('name',$name)->first();
        if(!empty($orga)) {
            return $orga;
        }
        return null;
    }
}

if (!function_exists('arrayGetValue')) {
    function arrayGetValue($params, $key, $default = null)
    {
        return (isset($params[$key]) && $params[$key]) ? $params[$key] : $default;
    }
}

if(!function_exists('is_admin')) {
    function is_admin() {
        if(!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        if(in_array($user->role->id,[1,2])) {
            return true;
        }
        return false;
    }
}

if(!function_exists('commonDateFormat')) {
    function commonDateFormat($date) {
        $date=  Carbon::parse($date)->isoFormat('MMMM DD [at] hh:mm A'); 
        return $date;
    }
}

if (!function_exists('mailCheck')) {
    function mailCheck() {
        return !empty(config('mail.mailers.smtp.username')) &&
               !empty(config('mail.mailers.smtp.password')) &&
               !empty(config('mail.from.address'));
    }
}

if (!function_exists('checkUserRole')) {
    function checkUserRole() {
        if(!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        if(in_array($user->role->id,[2])) {
            return true;
        }
        return false;
    }
}