<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationRepository
{

    public function isValidFile(Request $request, $fileName = null)
    {
        if(!empty($fileName))  {
            return $request->validate([
                $fileName   => 'required|image|max:2048|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,xlx,pptx,ppt'
            ]);
        }
        return $request->validate([
            'file'      => 'required|image|max:2048|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,xlx,pptx,ppt'
        ]);
    }

    public function isValidCompany(Request $request, $id)
    {
        if(!empty($id)) {
            return Validator::make($request->all(), [
                'name'              => 'required|max:190',
                'name_l'            => 'nullable|max:190',
                'address'           => 'nullable|max:3000',
                'email'             => 'nullable|max:150',
                'phone'             => 'nullable|min:9|max:18|unique:companies,phone'.$id,
                'trade_license'     => 'nullable|max:100|unique:companies,trade_license'.$id,
                'vat'               => 'nullable|min:0|max:100',
                'vat_area_code'     => 'nullable|max:100',
                'mashuk_no'         => 'nullable|max:100|unique:companies,mashuk_no'.$id,
                'tin'               => 'nullable|max:100|unique:companies,tin'.$id,
                'registration_no'   => 'nullable|max:100|unique:companies,registration_no'.$id,
            ]);
        }
        return Validator::make($request->all(), [
            'name'              => 'required|max:190',
            'name_l'            => 'nullable|max:190',
            'address'           => 'nullable|max:3000',
            'email'             => 'nullable|max:150',
            'phone'             => 'nullable|min:9|max:18|unique:companies,phone',
            'trade_license'     => 'nullable|max:100|unique:companies,trade_license',
            'vat'               => 'nullable|min:0|max:100',
            'vat_area_code'     => 'nullable|max:100',
            'mashuk_no'         => 'nullable|max:100|unique:companies,mashuk_no',
            'tin'               => 'nullable|max:100|unique:companies,tin',
            'registration_no'   => 'nullable|max:100|unique:companies,registration_no',
        ]);
    }

    public function isValidUserForm(Request $request)
    {
        return $request->validate([
            'name'          => 'required|max:190',
            'email'         => 'required|email|unique:users,email|unique:employees,email|unique:temp_employees,email',
            'password'      => 'required|min:8|max:190|confirmed',
            'phone'         => 'min:9|max:18|unique:employees,phone|unique:temp_employees,phone',
            'nid'           => 'required|unique:employees,nid|unique:temp_employees,nid',
        ]);
    }
}