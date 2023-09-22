<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Config;

class UserController extends BaseController
{
    protected $request;
    protected $userService;
    protected $userRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        UserService $userService,
        UserRepository $userRepo
    )
    {
        $this->request = $request;
        $this->userService = $userService;
        $this->userRepo = $userRepo;
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

    public function store()
    {
        return 'store';
    }

    public function edit()
    {
        return 'edit';
    }

    public function delete()
    {
        return 'delete';
    }
}
