<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use App\Models\UserEvent;
use App\Repositories\SaveRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventRequestController extends Controller
{
    private $save;
    public function __construct(SaveRepository $saveRepository)
    {
        $this->save = $saveRepository;
    }

    public function index()
    {
        return view('admin.events.event_request.index');
    }

    public function datatable()
    {
        $info = UserEvent::with('user','event')->where('status','pending')->orderby('id', 'DESC');
    
        return DataTables::of($info)
            ->addColumn('event', function ($data) {
                return $data->event->title ?? '';
            })
            ->editColumn('information', function ($data) {
               $html = '';
               $html .= 'Name' .':' . $data->user->name ;
               $html .= 'aEmail' .':'. $data->user->email ;
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
                
                if ($data->created_at != $data->updated_at) {
                    $html .= '<br><span class="badge badge-pill bg-warning mt-1" style="margin-top: 5px">' . commonDateFormat($data->updated_at) . '</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($data) {
                $accept = route('event-request.block', $data->id);
                $reject = route('event-request.unblock', $data->id);
    
                $html = '<div class="text-center">';
                $html .= '<a onclick="return confirm(\'' . __('Accept the requst?') . ' \')" href="' . $accept . '">' .'<span style="margin-left:10px;"><i class="fas fa-check  text-success"></i></span>' . '</a>'  ;
                 
                $html .= '<a onclick="return confirm(\'' . __('Reject the Request?') . ' \')" href="' . $reject . '">' .'<span style="margin-left:10px;"><i class="fas fa-lock  text-danger"></i></span>' . '</a>'  ;
           
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['event', 'information', 'status', 'action_by', 'action'])
            ->make(true);
    }
    

    public function block($id)
    {
        $status = $this->save->AcceptRequest($id);
        if ($status == 'success') {
            return redirect(route('event.request'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function unblock($id)
    {
        $status = $this->save->RejectRequest($id);
        if ($status == 'success') {
            return redirect(route('event.request'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }
}
