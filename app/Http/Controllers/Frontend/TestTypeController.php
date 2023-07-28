<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\TestType\TestTypeRepository;

class TestTypeController extends BaseController
{
    protected $repository;

    public function __construct(TestTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAll();
        return $list;
    }
}
