<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\QrCode\QrCodeRepository;

class QrCodeController extends BaseController
{
    protected $repository;

    public function __construct(QrCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAll();
        return $list;
    }
}
