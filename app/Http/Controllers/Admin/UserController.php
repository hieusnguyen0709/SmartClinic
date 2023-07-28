<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositories\User\UserRepository;

class UserController extends BaseController
{
    protected $service;
    protected $repository;

    /**
     * Constructor
     */
    public function __construct(
        UserService $service,
        UserRepository $repository
    )
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        $users = $this->repository->getAll();
        return view('frontend.user.index', compact('users'));
    }
}
