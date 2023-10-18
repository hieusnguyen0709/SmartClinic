<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Schedule\ScheduleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Frame\FrameRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ServiceTrait;

class ScheduleController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $scheduleRepo;
    protected $userRepo;
    protected $frameRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        ScheduleRepository $scheduleRepo,
        UserRepository $userRepo,
        FrameRepository $frameRepo,
    )
    {
        $this->request = $request;
        $this->scheduleRepo = $scheduleRepo;
        $this->userRepo = $userRepo;
        $this->frameRepo = $frameRepo;
    }

    public function index()
    {
        $events = [];
        $schedules = $this->scheduleRepo->getSchedules();

        foreach ($schedules as $schedule) {
            $events[] = [
                'id'   => $schedule->id,
                'title' => $schedule->doctor->name,
                'start' => '2023-10-20 06:30:00',
                'end' => '2023-10-20 00:00:00',
            ];
        }

        return view('admin.schedule.index', compact('events', 'schedules'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $schedule = $doctorId = '';
        if (!empty($input['id'])) {
            $schedule = $this->scheduleRepo->find($input['id']);
            $doctorId = $schedule['doctor_id'];
        }
        $doctors = $this->userRepo->getDoctors();
        $doctorList = $this->getListSelect($doctors, $doctorId);
        $frames = $this->frameRepo->getAllRecordActive();
        
        return response()->json([
            'schedule' => $schedule,
            'doctorList' => $doctorList,
            'frames' => $frames
        ]);
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'doctor_id' => 'required',
            'frame_ids' => 'required'
        ];
        $message = [
            'doctor_id.required' => 'Please fill out this field.',
            'frame_ids.required' => 'Please fill out this field.'
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            $response = [
                'code' => '422',
                'errors' => $validator->messages()->toArray()
            ];
            return response()->json($response);
        }
        
        $data = [
            'doctor_id' => $input['doctor_id'],
            'frame_ids' => $input['frame_ids'],
        ];

        if (!empty($input['id'])) {
            $this->scheduleRepo->update($input['id'], $data);
        } else {
            $this->scheduleRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }
}
