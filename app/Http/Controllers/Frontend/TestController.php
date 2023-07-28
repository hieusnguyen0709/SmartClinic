<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Test\TestRepository;

class TestController extends BaseController
{
    protected $repository;

    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAll();
        return $list;
    }
}
