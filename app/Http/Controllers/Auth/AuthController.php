<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{   
    protected $repository;
    protected $request;

    public function __construct(
        Request $request,
        UserRepository $repository
    )
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        return redirect()->route('dashboard.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function signUp()
    {
        $input = $this->request->all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*\d).{10,}$/',
            'confirm_password' => 'required|same:password',
        ];
        $message = [
            'name.required' => 'Please fill out this field.',
            'email.required' => 'Please fill out this field.',
            'password.required' => 'Please fill out this field.',
            'confirm_password.required' => 'Please fill out this field.',
        ];
        $validator = Validator::make($input, $rules, $message);
        if($validator->fails()) {
            $response = [
                'code' => '422',
                'errors' => $validator->messages()->toArray()
            ];
        }

        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'role_id' => 2,
            'password' => Hash::make($input['password']),
        ];

        $result = $this->repository->create($data);

        if ($result) {
            return back()->with('success', 'Successfully');
        } else {
            return back()->with('fail', 'Wrong');
        }
    }
}
