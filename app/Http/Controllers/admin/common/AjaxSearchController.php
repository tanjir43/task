<?php

namespace App\Http\Controllers\admin\common;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxSearchController extends Controller
{
    public function ajaxSelectCountryGetCity(Request $request)
    {
        $cityIds = City::where('country_id', $request->id)->get();
        return response()->json([$cityIds]);
    }

    public function ajaxGetEventsAndUsers(Request $request)
    {
        $events = Event::where('city_id', $request->city_id)->get(['id', 'title']);
    
        $users = User::whereHas('userDetail', function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
        })->get(['id', 'name']);
        return response()->json(['events' => $events, 'users' => $users]);
    }
}
