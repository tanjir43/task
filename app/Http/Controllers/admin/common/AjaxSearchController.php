<?php

namespace App\Http\Controllers\admin\common;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class AjaxSearchController extends Controller
{
    public function ajaxSelectCountryGetCity(Request $request)
    {
        $cityIds = City::where('country_id', $request->id)->get();
        return response()->json([$cityIds]);
    }
}
