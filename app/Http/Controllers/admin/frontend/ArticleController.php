<?php

namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendArticleRequest;
use App\Models\Article;
use App\Repositories\Interfaces\FrontendArticleRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    private $repository;
    private $request;

    public function __construct(FrontendArticleRepositoryInterface $repository,Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->repository->getIndex();
        return view('admin.fronted-article.index',$data);
    }

    public function save(FrontendArticleRequest $request, $id = null) 
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

    public function frontendArticle($id = null)
    {
        $record = $this->repository->getEditPreRequisite($id);
        return view('admin.fronted-article.index',compact('record'));
    }

    public function block($id)
    {
        $this->repository->block($id);

        return redirect()->route('frontend.article.index')->with('success', 'Blocked Successful');
    }

    public function unblock($id)
    {
        $this->repository->unblock($id);
        return redirect()->route('frontend.article.index')->with('success', 'Unblocked Successful');
    }

    public function datatable()
    {
        $info = Article::withTrashed()->with( 'country','city','createdby', 'updatedby', 'deletedby')->orderby('id', 'DESC');

        return DataTables::of($info)
            ->editColumn('title', function ($data) {
                return $data->title ;
            })
            ->filterColumn('title', function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->editColumn('information', function ($data) {
                return @$data->country->name;
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
                $edit_url = route('frontend-article.frontendArticle', $data->id);
                $block = route('frontend-article.block', $data->id);
                $unblock = route('frontend-article.unblock', $data->id);

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
            ->rawColumns(['title','information' ,'deleted_at', 'created_at', 'action'])
            ->make(true);
    }
}
