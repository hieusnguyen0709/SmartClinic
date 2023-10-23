<?php

namespace App\Http\Controllers\Admin;

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

class ScheduleController extends BaseController
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
        $doctorId = $this->request->input('select_doctor');
        $startDate = $this->request->input('select_start_date');
        $endDate = $this->request->input('select_end_date');
        $schedules = $this->scheduleRepo->getSchedules($search, $numPerPage, $sortColumn, $sortType, $doctorId,  $startDate, $endDate);
        $doctors = $this->userRepo->getDoctors();

        return view('admin.schedule.index', compact('schedules', 'search', 'numPerPage', 'sortColumn', 'sortType', 'doctors', 'doctorId', 'startDate', 'endDate'));
    }

    public function calendar()
    {
        $schedules = $this->scheduleRepo->getSchedulesToCalendar();
        $events = $this->scheduleService->parseToViewEvent($schedules);
        
        return view('admin.schedule.calendar', compact('events'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $schedule = $doctorId = $frameIds = '';
        if (!empty($input['id'])) {
            $schedule = $this->scheduleRepo->find($input['id']);
            $doctorId = $schedule['doctor_id'];
            $frameIds = $schedule['frame_ids'];
        }
        $doctors = $this->userRepo->getDoctors();
        $doctorList = $this->getListSelect($doctors, $doctorId);
        $frames = $this->frameRepo->getAllRecordActive();
        
        return response()->json([
            'schedule' => $schedule,
            'doctorList' => $doctorList,
            'frames' => $frames,
            'frameIds' => $frameIds
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
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'color' => $input['color']
        ];

        if (!empty($input['id'])) {
            $this->scheduleRepo->update($input['id'], $data);
        } else {
            $schedule = $this->scheduleRepo->create($data);
            foreach (explode(',', $schedule->frame_ids) as $frameId) {
                $this->scheduleFrameRepo->create([
                    'schedule_id' => $schedule['id'],
                    'frame_id' => $frameId
                ]);
            }
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function updateCalendar()
    {
        $input = $this->request->all();
        $this->scheduleRepo->update($input['id'], [
            'start_date' => $input['start_date'], 
            'end_date' => $input['end_date']
        ]);

        return response()->json([
            'code' => '200'
        ]);

    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->scheduleRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }
}
