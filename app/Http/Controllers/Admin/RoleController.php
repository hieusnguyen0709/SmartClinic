<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Role\RoleRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Auth;

class RoleController extends BaseController
{
    protected $request;
    protected $roleRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        RoleRepository $roleRepo
    )
    {
        $this->request = $request;
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
        $roles = $this->roleRepo->getRoles($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.role.index', compact('roles', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function create()
    {
        $menus = \Config::get('permission.menu');
        $categories = \Config::get('permission.cate');
        $permissions = \Config::get('permission.permission');
        $cateByMenu = $permissionByCate = [];
        foreach ($categories as $category) {
            $cateByMenu[$category['menu_id']][] = $category;
        }
        foreach ($permissions as $permission) {
            $permissionByCate[$permission['cate_id']][] = $permission;
        }

        return view('admin.role.create', compact('menus', 'cateByMenu', 'permissionByCate'));
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'name' => 'required',
        ];     
        $message = [
            'name.required' => 'Please fill out this field.',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            $response = [
                'code' => '422',
                'errors' => $validator->messages()->toArray()
            ];
            return response()->json($response);
        }
        $permission = "";
        if (isset($input['permission_ids'])) {
            $permission = implode(',', $input['permission_ids']);
        }
        $data = [
            'name' => $input['name'],
            'description' => $input['description'],
            'permission' => $permission
        ];

        if (!empty($input['id'])) {
            $this->roleRepo->update($input['id'], $data);
        } else {
            $this->roleRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->roleRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }
}
