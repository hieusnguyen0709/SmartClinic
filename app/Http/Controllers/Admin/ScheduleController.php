<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Schedule\ScheduleRepository;

class ScheduleController extends BaseController
{
    protected $request;
    protected $scheduleRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        ScheduleRepository $scheduleRepo
    )
    {
        $this->request = $request;
        $this->scheduleRepo = $scheduleRepo;
    }

    public function index()
    {
        return view('admin.schedule.index');
    }
}
