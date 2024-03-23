<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;

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
        $this->request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $this->request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 2) {
                return redirect()->route('frontend.index'); 
            } else {
                return redirect()->route('dashboard.index');
            }
        }
        return redirect("login")->withSuccess('Login details are not valid');
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

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect("login");
    }
}
