<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use App\Repositories\SaveRepository;
use App\Repositories\ValidationRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AssignEventController extends Controller
{
    private $vr;
    private $save;
    public function __construct(ValidationRepository $validationRepository, SaveRepository $saveRepository)
    {
        $this->vr   = $validationRepository;
        $this->save = $saveRepository;
    }

    public function index()
    {
        $countries  = Country::get();
        $events     = Event::where('status', 1)->pluck('title', 'id');
        $users      = User::where('block',0)->where('role_id',2)->orderBy('name','Asc')->pluck('name', 'id')->toArray();
        $users      = ['all_user' => 'All User'] + $users;

        return view('admin.events.assign_event.index',compact('countries','events','users'));
    }

    public function save(Request $request, $id = null)
    {
        $this->vr->isValidAssignEvent($request,$id);
        
        $status = $this->save->AssignEvent($request,$id);

        if ($status == 'success') {
            if (!empty($id)) {
                return redirect(route('event.assign'))->with(['success' => 'successfully saved']);
            }
            return back()->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function datatable() {
        $events = Event::withCount('userEvents')->with('createdBy', 'updatedBy', 'deletedBy')->orderBy('id', 'DESC');
    
        return DataTables::of($events)
            ->addColumn('total_user', function ($event) {
                return $event->user_events_count;
            })
            ->addColumn('status', function ($event) {
                if (empty($event->deleted_at)) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } else {
                    $html = '<p class="text-center"><span class="badge bg-danger">' . __('msg.closed') . '</span>';
                    if ($event->deleted_by) {
                        $html .= '<br><span class="badge bg-danger mt-1">' . $event->deletedBy->name . '</span></p>';
                    }
                    return $html;
                }
            })
            ->addColumn('action_by', function ($event) {
                $html = '<span class="badge badge-pill bg-success">' . commonDateFormat($event->created_at) . '</span>';
    
                if ($event->created_at != $event->updated_at) {
                    $html .= '<br><span class="badge badge-pill bg-warning mt-1" style="margin-top: 5px">' . commonDateFormat($event->updated_at) . '</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($event) {
                $edit_url = route('event-assign.edit', $event->id);
                $block = route('event-assign.block', $event->id);
    
                $html = '<div class="text-center">';
                if (empty($event->deleted_at)) {
                    $html .= '<a href="' . $edit_url . '"><i class="fas fa-edit"></i></a>';
                    $html .= '<a onclick="return confirm(\'' . __('Block This Assign Event?') . '\')" href="' . $block . '"><span style="margin-left:10px;"><i class="fas fa-lock text-danger"></i></span></a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['status', 'action_by', 'action'])
            ->make(true);
    }
    
    public function edit($id)
    {
        $record = Event::with('userEvents','country','city')->find($id);
        if (!$record) {
            return "Event not found";
        }

        $countries  = Country::get();
        $cities = City::get();
        $record->cities = $cities;
        $record->countries = $countries;
        $events     = Event::where('status', 1)->pluck('title', 'id');
        $users      = User::where('block',0)->where('role_id',2)->orderBy('name','Asc')->pluck('name', 'id')->toArray();
        $users      = ['all_user' => 'All User'] + $users;
        return view('admin.events.assign_event.index', compact('record', 'countries','cities','events','users'));
    }

    public function block($id)
    {
        $status = $this->save->BlockAssignEvent($id);
        if ($status == 'success') {
            return redirect(route('event.assign'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }
}

