<?php

namespace App\Http\Controllers\user\event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyEventController extends Controller
{
    public function upcomingEvent() {
        return view('admin.userPanel.event.upcoming_event');
    }

    public function myEvent() {
        return view('admin.userPanel.event.my_event');
    } 

    
}
