<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Repositories\SaveRepository;
use App\Repositories\ValidationRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
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
        return view('admin.groups.index');
    }

    public function save(Request $request, $id = null)
    {
        $this->vr->isValidGroup($request,$id);
        $status = $this->save->Group($request,$id);

        if ($status == 'success') {
            if (!empty($id)) {
                return redirect(route('groups'))->with(['success' => 'successfully saved']);
            }
            return back()->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }
    public function datatable()
    {
        $info = Group::with('userGroup')->withTrashed()->orderBy('id', 'DESC');
    
        return DataTables::of($info)
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->addColumn('total_user', function ($data) {
                return $data->userGroup->count();
            })
            ->addColumn('deleted_at', function ($data) {
                if (empty($data->deleted_at)) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } else {
                    return '<span class="badge bg-danger">' . __('msg.closed') . '</span>';
                }
            })
            ->addColumn('created_at', function ($data) {
                return '<span class="badge badge-pill bg-success">' . commonDateFormat($data->created_at) . '</span>';
            })

            ->addColumn('action', function ($data) {
                $edit_url = route('group.edit', $data->id);
                $block = route('group.block', $data->id);
                $unblock = route('group.unblock', $data->id);
    
                $html = '<div class="text-center">';
                if (empty($data->deleted_at)) {
                    $html .= '<a href="' . $edit_url . '">' . '<i class="fas fa-edit"></i>' . '</a>';
                    $html .= '<a onclick="return confirm(\'' . __('Block This Group?') . '\')" href="' . $block . '"><span style="margin-left:10px;"><i class="fas fa-lock text-danger"></i></span></a>';
                } else {
                    $html .= '<a onclick="return confirm(\'' . __('Unblock this group?') . '\')" href="' . $unblock . '"><i class="fas fa-unlock text-success"></i></a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['title', 'description', 'deleted_at', 'created_at', 'action'])
            ->make(true);
    }
    
    public function edit($id)
    {
        $record = Group::where('id', $id)->firstOrFail();
        
        return view('admin.groups.index',compact('record'));
    }

    public function block($id)
    {
        $status = $this->save->BlockGroup($id);
        if ($status == 'success') {
            return redirect(route('groups'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }

    public function unblock($id)
    {
        $status = $this->save->UnblockGroup($id);
        if ($status == 'success') {
            return redirect(route('groups'))->with(['success' => 'successfully saved']);
        } else {
            return back()->with(['errors_' => $status]);
        }
    }
}
