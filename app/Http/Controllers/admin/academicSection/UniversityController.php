<?php

namespace App\Http\Controllers\admin\academicSection;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;
use App\Models\Log;
use App\Models\UnUniversity;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UniversityController extends Controller
{
    private $repository;
    private $request;

    public function __construct(UniversityRepositoryInterface $repository,Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->repository->getIndex();
        return view('admin.academic-section.university.index', $data);
    }

    public  function university($id = null) {
        if($id) {
            $data = $this->repository->getEditPreRequisite($id);

        } else {
            $data = $this->repository->getIndex();
        }
        return view('admin.academic-section.university.university', $data);

    }

    public function store(UniversityRequest $request) {
        DB::beginTransaction();
    
        try {
            $this->repository->create($request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Created Successful');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Operation Failed');        
        }
    }

    public function datatable()
    {
    $info = UnUniversity::withTrashed()
        ->with('createdby', 'updatedby', 'deletedby')
        ->join('countries', 'un_universities.country_id', '=', 'countries.id')
        ->join('cities', 'un_universities.city_id', '=', 'cities.id')
        ->join('un_university_types', 'un_universities.un_type_id', '=', 'un_university_types.id')
        ->select('un_universities.*', 'countries.name as country_name', 'cities.name as city_name', 'un_university_types.name as university_type_name')
        ->orderBy('un_universities.id', 'DESC');

    return DataTables::of($info)
        ->editColumn('name', function ($data) {
            return $data->name;
        })
        ->filterColumn('name', function ($query, $keyword) {
            $query->where('un_universities.name', 'like', '%' . $keyword . '%')
                ->orWhere('un_universities.phone', 'like', '%' . $keyword . '%')
                ->orWhere('un_universities.email', 'like', '%' . $keyword . '%')
                ->orWhere('countries.name', 'like', '%' . $keyword . '%')
                ->orWhere('un_university_types.name', 'like', '%' . $keyword . '%');
        })
        ->editColumn('information', function ($data) {
            $html = '';
            if (!empty($data->country_id)) {
                $html .= '<span> <strong>' . __('msg.country') . ' :  </strong>' . ($data->country_name) . '</span>';
            }
            if (!empty($data->city_id)) {
                $html .= '<span> <strong>' . __('msg.city') . ' :  </strong>' . ($data->city_name) . '</span>' . '</br>';
            }
            if (!empty($data->email)) {
                $html .= '<span> <strong>' . __('msg.email') . ' :  </strong>' . ($data->email) . '</span>';
            }
            if (!empty($data->phone)) {
                $html .= '<br> <strong>' . __('msg.phone') . ' : </strong>' . $data->phone;
            }
            return $html;
        })
        ->editColumn('deleted_at', function ($data) {
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
        ->editColumn('created_at', function ($data) {
            $html = '<span class="badge badge-pill bg-success">' . $data->created_at . '</span>';
            if (!empty($data->createdby)) {
                $html .= '<br><span class="badge bg-success">' . $data->createdby->name . '</span>';
            }
            if ($data->created_at != $data->updated_at) {
                $html .= '<br><span class="badge badge-pill bg-warning mt-1" style="margin-top: 5px">' . $data->updated_at . '</span>';
                if (!empty($data->updatedby)) {
                    $html .= '<br><span class="badge bg-warning">' . $data->updatedby->name . '</span>';
                }
            }
            return $html;
        })
        ->addColumn('action', function ($data) {
            $edit_url = route('company.edit', $data->id);
            $block = route('company.block', $data->id);
            $unblock = route('company.unblock', $data->id);

            $html = '<div class="text-center">';
            if (empty($data->deleted_at)) {
                $html .= '<a href="' . $edit_url . '"><i class="fas fa-edit"></i></a>';
                $html .= '<a onclick="return confirm(\'' . __('msg.block_this_company?') . ' \')" href="' . $block . '"><span style="margin-left:10px;"><i class="fas fa-lock text-danger"></i></span></a>';
            } else {
                $html .= '<a onclick="return confirm(\'' . __('msg.unblock_this_company?') . ' \')" href="' . $unblock . '"><i class="fas fa-unlock text-success"></i></a>';
            }
            $html .= '</ul></div>';
            return $html;
        })
        ->rawColumns(['name', 'deleted_at', 'created_at', 'information', 'action'])
        ->make(true);
    }

}
