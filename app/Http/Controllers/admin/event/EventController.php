<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
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
            ->editColumn('country_id', function ($data) {
                return $data->country->name ?? '';
            })
            ->editColumn('name', function ($data) {
                $is_capital = $data->is_capital ? 'Capital' : '';

                return $data->name . '<br/> <p class="badge bg-success">' . $is_capital . '</p>';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->editColumn('status', function ($data) {
                if (empty($data->deleted_at)) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } else {
                    $html = '<p class="text-center"><span class="badge bg-danger">' . __('msg.closed') . '</span>';
                    if ($data->deletedby) {
                        $html .= '<br><span class="badge bg-danger mt-1">' . $data->deletedby->name . '</span></p>';
                    }
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
                $edit_url = route('event.edit', $data->id);
                $block = route('event.block', $data->id);
                $unblock = route('event.unblock', $data->id);
    
                $html = '<div class="text-center">';
                if (empty($data->deleted_at)) {
                    $html .= '<a href="' . $edit_url . '"><i class="fas fa-edit"></i></a>';
                    $html .= '<a onclick="return confirm(\'' . __('msg.block_this_event?') . '\')" href="' . $block . '"><span style="margin-left:10px;"><i class="fas fa-lock text-danger"></i></span></a>';
                } else {
                    $html .= '<a onclick="return confirm(\'' . __('msg.unblock_this_event?') . '\')" href="' . $unblock . '"><i class="fas fa-unlock text-success"></i></a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['country_id', 'name', 'status', 'action_by', 'action'])
            ->make(true);
    }
    
    public function edit($id)
    {
        $record = Event::where('id', $id)->firstOrFail();
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        return view('admin.events.event.index',compact('record','countries'));
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
        $status = $this->save->UnblockCity($id);
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
