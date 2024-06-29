<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\Group;
use App\Repositories\SaveRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    private $save;
    public function __construct(SaveRepository $saveRepository)
    {
        $this->save = $saveRepository;
    }

    public function index()
    {
        $groups     = Group::pluck('title','id');
        $countries  = Country::get();
        return view('admin.events.event.index',compact('countries'));
    }

    public function save(EventRequest $request, $id = null)
    {
        $status = $this->save->Event($request,$id);

        if ($status == 'success') {
            if (!empty($id)) {
                return redirect(route('event.index'))->with(['success' => 'successfully saved']);
            }
            return back()->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function datatable()
    {
        $info = Event::withTrashed()->with('createdby', 'updatedby', 'deletedby', 'country')->orderby('id', 'DESC');
    
        return DataTables::of($info)
            ->editColumn('title', function ($data) {
                return $data->title ?? '';
            })
            ->editColumn('image',function ($data){
                if(!empty($data->media)){
                    return '<img src="data:'.$data->media->attachment.'" class="img-thumbnail">';
                }
                return '<img src="'.asset('images/none.png').'" class="img-thumbnail">';
            })
            ->editColumn('image',function ($data){
                if(!empty($data->media)){
                    return '<img src="data:'.$data->media->attachment.'" class="img-thumbnail">';
                }
                return '<img src="'.asset('images/none.png').'" class="img-thumbnail">';
            })
            ->filterColumn('title', function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
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
                if (empty($data->deleted_at)) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } else {
                    return '<span class="badge bg-danger">' . __('msg.closed') . '</span>';
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
                $edit_url = route('event.edit', $data->id);
                $block = route('event.block', $data->id);
                $unblock = route('event.unblock', $data->id);
    
                $html = '<div class="text-center">';
                if (empty($data->deleted_at)) {
                    $html .= '<a href="' . $edit_url . '"><i class="fas fa-edit"></i></a>';
                    $html .= '<a onclick="return confirm(\'' . __('Block This Event?') . '\')" href="' . $block . '"><span style="margin-left:10px;"><i class="fas fa-lock text-danger"></i></span></a>';
                } else {
                    $html .= '<a onclick="return confirm(\'' . __('Unblock This Event?') . '\')" href="' . $unblock . '"><i class="fas fa-unlock text-success"></i></a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['title', 'image','information' ,'status', 'action_by', 'action'])
            ->make(true);
    }
    
    public function edit($id)
    {
        $record = Event::where('id', $id)->with('media')->firstOrFail();
        $groups = Group::pluck('title','id');
        $countries = Country::get();
        $cities = City::get();
        $record->countries = $countries;
        $record->cities = $cities;
        return view('admin.events.event.index',compact('record','countries','groups','cities'));
    }

    public function block($id)
    {
        $status = $this->save->BlockEvent($id);
        if ($status == 'success') {
            return redirect(route('event.index'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function unblock($id)
    {
        $status = $this->save->UnblockEvent($id);
        if ($status == 'success') {
            return redirect(route('event.index'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function removeMedia($id)
    {
        $status = $this->save->RemoveEventMedia($id);
        if ($status == 'success') {
            return back()->with(['success'=> 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }
}
