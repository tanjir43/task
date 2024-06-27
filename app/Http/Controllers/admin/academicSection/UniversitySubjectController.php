<?php

namespace App\Http\Controllers\admin\academicSection;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversitySubjectRequest;
use App\Models\UnSubject;
use App\Repositories\Interfaces\UniversitySubjectRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UniversitySubjectController extends Controller
{
    private $repository;
    private $request;


    public function __construct(UniversitySubjectRepositoryInterface $repository,Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->repository->getIndex();
        return view('admin.academic-section.university-subject.index', $data);
    }


    public function save(UniversitySubjectRequest $request, $id) 
    {
        DB::beginTransaction();
    
        try {
            if ($id) {
                $updateResult = $this->repository->update($id, $request->all());
                if ($updateResult) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Updated Successfully');
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Update Failed');
                }
            } else {
                $this->repository->create($request->all());
                DB::commit();
                return redirect()->back()->with('success', 'Created Successfully');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Operation Failed');        
        }
    }

    public function universitySubject($id = null)
    {
        $record = $this->repository->findById($id);
        return view('admin.academic-section.university-subject.index',compact('record'));
    }

    public function block($id)
    {
        $this->repository->block($id);

        return redirect()->route('academic-subject.index')->with('success', 'Blocked Successful');
    }

    public function unblock($id)
    {
        $this->repository->unblock($id);
        return redirect()->route('academic-subject.index')->with('success', 'Unblocked Successful');
    }

    public function datatable()
    {
        $info = UnSubject::withTrashed()->with( 'createdby', 'updatedby', 'deletedby')->orderby('id', 'DESC');

        return DataTables::of($info)
            ->editColumn('name', function ($data) {
                return ConvertToLang($data);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('name_l', 'like', '%' . $keyword . '%');
            })
            ->editColumn('deleted_at', function ($data) {
                if (empty($data->deleted_at)) {
                    return '<span class="badge bg-success">' . __('msg.running') . '</span>';
                } else {
                    $html= '<p class="text-center"><span class="badge bg-danger">'.__('msg.closed').'</span>';
                    if ($data->deletedby) {
                        $html.= '<br><span class="badge bg-danger mt-1">'.$data->deletedby->name.'</span></p>';
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
                $edit_url = route('academic-subject.universitySubject', $data->id);
                $block = route('acadmic-subject.block', $data->id);
                $unblock = route('acadmic-subject.unblock', $data->id);

                $html = '<div class="text-center">';

                    if (empty($data->deleted_at)) {
                        $html .= '<a  href="' . $edit_url . '">' . '<i class="fas fa-edit"></i>' . '</a>';
                 
                            $html .= '<a onclick="return confirm(\'' . __('msg.block_this_subject?') . ' \')" href="' . $block . '">' .'<span style="margin-left:10px;"><i class="fas fa-lock  text-danger"></i></span>' . '</a>'  ;
                       
                    } else {
                        $html .= '<a onclick="return confirm(\'' . __('msg.unblock_this_subject?') . ' \')" href="' . $unblock . '">' . '<i class="fas fa-unlock text-success"></i>' . '</a>';
                    }
               
                $html .= '</ul></div>';
                return $html; 
            })
            ->rawColumns(['name', 'deleted_at', 'created_at', 'action'])
            ->make(true);
    }
}
