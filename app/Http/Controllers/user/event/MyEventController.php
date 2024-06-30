<?php

namespace App\Http\Controllers\user\event;

use App\Http\Controllers\Controller;
use App\Repositories\SaveRepository;
use Illuminate\Http\Request;

class MyEventController extends Controller
{
    private $save;
    public function __construct(SaveRepository $saveRepository)
    {
        $this->save = $saveRepository;
    }

    public function upcomingEvent() {
        return view('admin.userPanel.event.upcoming_event');
    }

    public function myEvent() {
        return view('admin.userPanel.event.my_event');
    }

    public function eventAssignRequest($id)
    {
        $status = $this->save->EventAssignRequest($id);
        if ($status == 'success') {
            return redirect(route('event.index'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    
}
