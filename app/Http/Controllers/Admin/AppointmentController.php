<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Appointment\AppointmentRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class AppointmentController extends BaseController
{   
    use ServiceTrait;
    protected $request;
    protected $appointmentRepo;
    protected $userRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        AppointmentRepository $appointmentRepo,
        UserRepository $userRepo
    )
    {
        $this->request = $request;
        $this->appointmentRepo = $appointmentRepo;
        $this->userRepo = $userRepo;
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
        $appointments = $this->appointmentRepo->getAppointments($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.appointment.index', compact('appointments', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $appointment = $patientId = $doctorId = '';
        if (!empty($input['id'])) {
            $appointment = $this->appointmentRepo->find($input['id']);
            $patientId = $appointment['patient_id'];
            $doctorId = $appointment['doctor_id'];
        }
        $patients = $this->userRepo->getPatients();
        $patientList = $this->getListSelect($patients, $patientId);
        $doctors = $this->userRepo->getDoctors();
        $doctorList = $this->getListSelect($doctors, $doctorId);
        
        return response()->json([
            'appointment' => $appointment,
            'patientList' => $patientList,
            'doctorList' => $doctorList,
        ]);
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'date_time' => 'required',
        ];
        $message = [
            'patient_id.required' => 'Please fill out this field.',
            'doctor_id.required' => 'Please fill out this field.',
            'date_time.required' => 'Please fill out this field.',
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
            'patient_id' => $input['patient_id'],
            'doctor_id' => $input['doctor_id'],
            'qr_id' => $input['qr_id'] ?? 1,
            'code' => 'APPO-'.str_pad(mt_rand(1, 1000), 4, '0', STR_PAD_LEFT),
            'date_time' => $input['date_time'],
            'note' => $input['note'],
        ];

        if (!empty($input['id'])) {
            $this->appointmentRepo->update($input['id'], $data);
        } else {
            $this->appointmentRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->appointmentRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }

    public function updateStatus()
    {
        $input = $this->request->all();
        if ($input['status'] == 1) {
            $data = ['status' => 0];
        } else {
            $data = ['status' => 1];
        }
        $this->appointmentRepo->update($input['id_update_status'], $data);

        return redirect()->back();
    }
}
