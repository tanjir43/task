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

    public function isValidCity(Request $request){
        return Validator::make($request->all(), [
            'name'          => 'required|max:250',
            'country_id'    => 'required|exists:countries,id',
            'is_capital'    => 'sometimes|nullable',
        ]);
    }

    public function isValidGroup(Request $request){
        return Validator::make($request->all(), [
            'title'         => 'required|max:250',
            'description'   => 'nullable|max:250',
        ]);
    }

    public function isValidAssignEvent(Request $request){
        return Validator::make($request->all(), [
            'event_id'      => 'required|exists:events,id',
            'user_id'       => 'required',
        ]);
    }

}