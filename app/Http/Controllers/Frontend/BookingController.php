<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Services\ScheduleService;
use App\Repositories\Schedule\ScheduleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Frame\FrameRepository;
use App\Repositories\ScheduleFrame\ScheduleFrameRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;

class BookingController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $scheduleService;
    protected $scheduleRepo;
    protected $userRepo;
    protected $frameRepo;
    protected $scheduleFrameRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        ScheduleService $scheduleService,
        ScheduleRepository $scheduleRepo,
        UserRepository $userRepo,
        FrameRepository $frameRepo,
        ScheduleFrameRepository $scheduleFrameRepo,
    )
    {
        $this->request = $request;
        $this->scheduleService = $scheduleService;
        $this->scheduleRepo = $scheduleRepo;
        $this->userRepo = $userRepo;
        $this->frameRepo = $frameRepo;
        $this->scheduleFrameRepo = $scheduleFrameRepo;
    }

    public function index()
    {
        return view('frontend.booking.index');
    }
    
    public function byDay()
    {
        return view('frontend.booking.by-day');
    }

    public function getByDay()
    {
        $input = $this->request->all();
        $schedules = $this->scheduleRepo->getSchedulesByStartDate($input['start_date']);

        return response()->json([
            'schedules' => $schedules
        ]);
    }

    public function getFrameByIds()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id']);
        $frames = $this->frameRepo->getFrameByIds($ids);
        
        return response()->json([
            'frames' => $frames
        ]);
    }

    public function byDoctor()
    {
        return view('frontend.booking.by-doctor');
    }
}