<?php

namespace App\Http\Controllers\user\register;

use App\Http\Controllers\Controller;
use App\Repositories\SaveRepository;
use App\Repositories\ValidationRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $vr;
    private $save;
    public function __construct(ValidationRepository $validationRepository, SaveRepository $saveRepository)
    {
        $this->vr   = $validationRepository;
        $this->save = $saveRepository;
    }

    public function store(Request $request)
    {
        $this->vr->isValidUserForm($request);
        $status = $this->save->UserForm($request);
        if ($status == 'success') {
            return redirect()->route('login')->withInput($request->only('email', 'remember'))->with(['success'=> 'successfully created']);
        } else {
            return back()->withInput($request->only('name'))->with(['errors_' => $status]);
        }
    }
}
