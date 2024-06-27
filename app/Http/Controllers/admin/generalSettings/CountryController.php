<?php

namespace App\Http\Controllers\admin\generalSettings;

use App\Http\Controllers\Controller;
use App\Models\Country;
use yajra\Datatables\DataTables;

class CountryController extends Controller
{

    public function index()
    {
        return view('admin.generalSettings.country.index');
    }

    public function datatable()
    {
        $query = Country::orderBy('name', 'ASC');
    
        return DataTables::of($query)
            ->editColumn('code', function ($data) {
                return $data->code ?? '';
            })
            ->editColumn('name', function ($data) {
                return '<div class="text-left">' . ($data->name ?? '') . '</div>';
            })          
            ->editColumn('phone', function ($data) {
                return $data->phone ?? '';
            })
            ->editColumn('capital', function ($data) {
                return $data->capital ?? '';
            })
            ->editColumn('languages', function ($data) {
                return '<div style="text-align:center">' . ($data->languages ?? '') . '</div>';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('capital', 'like', '%' . $keyword . '%')
                    ->orWhere('languages', 'like', '%' . $keyword . '%');
            })
            ->rawColumns(['code', 'name', 'phone', 'capital', 'languages'])
            ->make(true);
    }
}
