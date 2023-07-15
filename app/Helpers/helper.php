<?php

use Carbon\Carbon;

if (!function_exists('showDateFormat')) {
    function showDateFormat($date, $format='d M Y', $default='') {
        if ($date != '') {
            $date = Carbon::make($date)->format($format);
        } else {
            $date = $default;
        }
        return $date;
    }
}

?>