<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function isValidUser(Request $request, $id = null)
    {
       $id = (int)$id; 
        $rules = [
            'name' => 'required|max:190',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],        
        ];
    
        if ($request->filled('password')) {
            $rules['password'] = 'nullable|min:6|max:190|confirmed';
        } else {
            $rules['password'] = 'nullable';
        }
    
        return $request->validate($rules);
    }
}