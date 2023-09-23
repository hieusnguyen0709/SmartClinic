<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ServiceTrait;
use Auth;

class UserController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $userService;
    protected $userRepo;
    protected $roleRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        UserService $userService,
        UserRepository $userRepo,
        RoleRepository $roleRepo
    )
    {
        $this->request = $request;
        $this->userService = $userService;
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $search = $this->request->input('search');
        $numPerPage = $this->request->input('num_per_page');
        if (empty($numPerPage)) {
            $numPerPage = \Config::get('constants.NUM_PER_PAGE');;
        }
        $sortColumn = 'id';
        $sortType = 'desc';
        if (!empty($this->request->input('sort_column'))) {
            $sortColumn = $this->request->input('sort_column');
        }
        if (!empty($this->request->input('sort_type'))) {
            $sortType = $this->request->input('sort_type');
        }
        $users = $this->userRepo->getUsers($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.user.index', compact('users', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $user = $roleId = '';
        if (!empty($input['id'])) {
            $user = $this->userRepo->find($input['id']);
            $roleId = $user['role_id'];
        }
        $roles = $this->roleRepo->getAllRecordActive();
        $roleList = $this->getListSelect($roles, $roleId);
        
        return response()->json([
            'user' => $user,
            'roleList' => $roleList
        ]);
    }

    public function store()
    {
        $input = $this->request->all();
        if (!empty($input['id'])) {
            $rules = [
                'role_id' => 'required',
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('users')->where(function ($query) use ($input) {
                    return $query->where('is_delete', 0)->where('id', '<>', $input['id']);
                })],
                'password' => 'nullable|regex:/^(?=.*[A-Z])(?=.*\d).{10,}$/',
                'confirm_password' => 'nullable|same:password',
                'gender' => 'nullable',
                'phone' => 'nullable',
                'age' => 'nullable',
                'address' => 'nullable',
                'avatar' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            ];
        } else {
            $rules = [
                'role_id' => 'required',
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('users')->where(function ($query) {
                    return $query->where('is_delete', 0);
                })],
                'password' => 'required|regex:/^(?=.*[A-Z])(?=.*\d).{10,}$/',
                'confirm_password' => 'required|same:password',
                'gender' => 'nullable',
                'phone' => 'nullable',
                'age' => 'nullable',
                'address' => 'nullable',
                'avatar' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            ];
        }
        
        $message = [
            'role_id.required' => 'Please fill out this field.',
            'name.required' => 'Please fill out this field.',
            'email.required' => 'Please fill out this field.',
            'email.email' => '*The email address must be a valid email address.',
            'password.required' => 'Please fill out this field.',
            'password.regex' => 'The password must contain at least <strong>10 characters</strong> including <strong>capital letter</strong> and <strong>a number<strong>.',
            'confirm_password.same' => '<strong>Password</strong> and <strong>confirm password</strong> fields must match.',
            'confirm_password.required' => 'Please fill out this field.',
            'avatar.required' => 'Please fill out this field.',
            'avatar.mimes' => 'Only accepts format jpeg,jpg,png,gif',
            'avatar.max' => 'Please upload file less than 2MB.'
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            $response = [
                'code' => '422',
                'errors' => $validator->messages()->toArray()
            ];
            return response()->json($response);
        }
        
        $data = [
            'role_id' => $input['role_id'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'age' => $input['age'],
            'address' => $input['address'],
        ];
        $avatarName = '';
        if ($this->request->has('avatar')) {
            $avatarName = $this->uploadFile($this->request->file('avatar'), Config::get('constants.IMG_USER_PATH'));
        }
        $data['avatar'] = $avatarName;
        
        if (!empty($input['id'])) {
            $user = $this->userRepo->find($input['id']);
            if (empty($input['password'])) {
                $data['password'] = $user['password'];
            }
            if (empty($input['avatar'])) {
                $data['avatar'] = $user['avatar'];
            }
        }

        if (!empty($input['id'])) {
            $this->userRepo->update($input['id'], $data);
        } else {
            $this->userRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->userRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }

    public function updateStatus()
    {
        $input = $this->request->all();
        if ($input['status'] == 1) {
            $data = ['status' => 0];
        } else {
            $data = ['status' => 1];
        }
        $this->userRepo->update($input['id_update_status'], $data);

        return redirect()->back();
    }
}
