<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\CaseHistory\CaseHistoryRepository;

class CaseHistoryController extends BaseController
{
    protected $repository;

    public function __construct(CaseHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $case_history = $this->repository->getAll();
        return $case_history;
    }
}
