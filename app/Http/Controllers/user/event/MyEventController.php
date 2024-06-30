<?php

namespace App\Http\Controllers\user\event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserEvent;
use App\Repositories\SaveRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function userEventdatatable()
    {
        $info = UserEvent::with('user','event')->where('user_id',auth()->id())->orderby('id', 'DESC');
    
        return DataTables::of($info)
            ->addColumn('event', function ($data) {
                return $data->event->title ?? '';
            })
            ->editColumn('information', function ($data) {
                $html = '<br> <strong>'.__('FromDate').' : </strong>';
                $html.=  commonDateFormat(@$data->event->from_date);
                $html.= '<br> <strong>'.__('To Date').' : </strong><br>'. commonDateFormat(@$data->event->to_date);
                $html.= '<br> <strong>'.__('For').' : </strong>';
                $html.= @$data->event->for_whom;
                return $html;
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'approved') {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } elseif($data->status == 'pending') {
                    $html = '<p class="text-center"><span class="badge bg-warning">' . __('Pending') . '</span>';
                    return $html;
                } else {
                    $html = '<p class="text-center"><span class="badge bg-danger">' . __('Rejcted') . '</span>';
                    return $html;
                }
            })
            ->editColumn('action_by', function ($data) {
                $html = '<span class="badge badge-pill bg-success">' . commonDateFormat($data->created_at) . '</span>';
                
                if ($data->event->created_at != $data->event->updated_at) {
                    $html .= '<br><span class="badge badge-pill bg-warning mt-1" style="margin-top: 5px">' . commonDateFormat($data->updated_at) . '</span>';
                }
                return $html;
            })
            
            ->rawColumns(['event', 'information', 'status', 'action_by'])
            ->make(true);
    }

    public function upcomingEventdatatable()
    {
        $current_time = date('Y-m-d');
        $info = Event::where('status',1)->where('from_date','>=',$current_time)->orderby('id', 'DESC')->get();
    
        return DataTables::of($info)
            ->addColumn('title', function ($data) {
                return $data->title ?? '';
            })
            ->editColumn('information', function ($data) {
                $html = '<br> <strong>'.__('FromDate').' : </strong>';
                $html.=  commonDateFormat(@$data->from_date);
                $html.= '<br> <strong>'.__('To Date').' : </strong><br>'. commonDateFormat(@$data->to_date);
                $html.= '<br> <strong>'.__('For').' : </strong>';
                $html.= @$data->for_whom;
                return $html;
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } elseif($data->status == 0) {
                    $html = '<p class="text-center"><span class="badge bg-warning">' . __('Pending') . '</span>';
                    return $html;
                }
            })
            ->editColumn('action_by', function ($data) {
                $html = '<span class="badge badge-pill bg-success">' . commonDateFormat($data->created_at) . '</span>';
                
                if ($data->created_at != $data->updated_at) {
                    $html .= '<br><span class="badge badge-pill bg-warning mt-1" style="margin-top: 5px">' . commonDateFormat($data->updated_at) . '</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($data) {
                if (checkUserRole()) {
                    $request_url = route('event.assign.request', $data->id);
                    $html = '<div class="text-center">';
                    
                    if ($data->userEvents->isEmpty()) {
                        $html .= '<a href="' . $request_url . '"><i class="fas fa-floppy-disk"></i></a>';
                    } else {
                        $userEvent = $data->userEvents->first();
                        if ($userEvent->status == 'pending') {
                            $html .= '<i class="fas fa-floppy-disk text-warning" data-toggle="tooltip" title="Pending"></i>';
                        } elseif ($userEvent->status == 'rejected') {
                            $html .= '<i class="fas fa-floppy-disk text-danger" data-toggle="tooltip" title="Rejected"></i>';
                        } elseif($userEvent->status == 'approved') {
                            $html .= '<i class="fas fa-floppy-disk text-success" data-toggle="tooltip" title="Approved"></i>';
                        }
                    }
            
                    $html .= '</div>';
                    return $html;
                }
                  
            })
            
            ->rawColumns(['title', 'information', 'status', 'action_by','action'])
            ->make(true);
    }
}
