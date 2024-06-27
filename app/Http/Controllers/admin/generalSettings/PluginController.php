<?php

namespace App\Http\Controllers\admin\generalSettings;

use App\Models\Role;
use App\Models\Plugin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PluginRequest;
use Brian2694\Toastr\Facades\Toastr;

class PluginController extends Controller
{
    public function tawkTo()
    {
        $roles = Role::pluck('name','id')->toArray();
        $tawk_to = Plugin::where('name','tawk')->first();
        return view('admin.generalSettings.plugins.tawk_to',compact('roles','tawk_to'));
    }

    public function tawkToUpdate(PluginRequest $request)
    {
        try {
            $tawk_to = Plugin::where('name','tawk')->first();
            $tawk_to->is_enable = $request->is_enable ?? 0;
            $tawk_to->applicable_for = json_encode($request->input('roles'));
            $tawk_to->availability = $request->availability ?? 'both';
            $tawk_to->show_admin_panel = $request->show_admin_panel ?? 0;
            $tawk_to->show_website = $request->show_website ?? 0;
            $tawk_to->showing_page = $request->showing_page ?? 'all'; #conditionally check on frontend
            $tawk_to->position = $request->position ?? 'right';
            $tawk_to->short_code = $request->short_code ?? '';
            $tawk_to->save();

            return redirect()->back()->with('success','Updated Successful');

		} catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

		}
        
    }
}
