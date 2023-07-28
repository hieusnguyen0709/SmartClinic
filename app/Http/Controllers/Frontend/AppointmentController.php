<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Appointment\AppointmentRepository;

class AppointmentController extends BaseController
{   
    protected $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $app = $this->repository->getAll();
        return $app;
    }
}
