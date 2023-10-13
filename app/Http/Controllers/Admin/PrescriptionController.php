<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Prescription\PrescriptionRepository;
use App\Repositories\PrescriptionMedicine\PrescriptionMedicineRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Medicine\MedicineRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class PrescriptionController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $prescriptionRepo;
    protected $prescriptionMedicineRepo;
    protected $userRepo;
    protected $medicineRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        PrescriptionRepository $prescriptionRepo,
        PrescriptionMedicineRepository $prescriptionMedicineRepo,
        UserRepository $userRepo,
        MedicineRepository $medicineRepo,
    )
    {
        $this->request = $request;
        $this->prescriptionRepo = $prescriptionRepo;
        $this->prescriptionMedicineRepo = $prescriptionMedicineRepo;
        $this->userRepo = $userRepo;
        $this->medicineRepo = $medicineRepo;
    }

    public function index()
    {
        $search = $this->request->input('search');
        $numPerPage = $this->request->input('num_per_page');
        if (empty($numPerPage)) {
            $numPerPage = \Config::get('constants.NUM_PER_PAGE');
        }
        $sortColumn = 'id';
        $sortType = 'desc';
        if (!empty($this->request->input('sort_column'))) {
            $sortColumn = $this->request->input('sort_column');
        }
        if (!empty($this->request->input('sort_type'))) {
            $sortType = $this->request->input('sort_type');
        }
        $prescriptions = $this->prescriptionRepo->getPrescriptions($search, $numPerPage, $sortColumn, $sortType);

        return view('admin.prescription.index', compact('prescriptions', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function changePatient()
    {
        $input = $this->request->all();
        $patient = $this->userRepo->getPatientById($input['patient_id']);

        return response()->json([
            'patient' => $patient
        ]);
    }

    public function changeMedicine()
    {
        $input = $this->request->all();
        $medicine = $this->medicineRepo->getMedicineById($input['medicine_id']);

        return response()->json([
            'medicine' => $medicine
        ]);
    }

    public function create()
    {
        $patients = $this->userRepo->getPatients();
        $doctors = $this->userRepo->getDoctors();
        $medicines = $this->medicineRepo->getAllRecordActive();

        return view('admin.prescription.create', compact('patients', 'doctors', 'medicines'));
    }

    public function edit($slug)
    {
        $prescription = $this->prescriptionRepo->findBySlugOrFail($slug);
        $patients = $this->userRepo->getPatients();
        $doctors = $this->userRepo->getDoctors();
        
        return view('admin.prescription.edit', compact('prescription', 'patients', 'doctors'));
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'name' => 'required',
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'medicine.*.id' => 'required',
            'medicine.*.quantity' => 'required|numeric',
            'medicine.*.unit' => 'required'
        ];
        $message = [
            'name.required' => 'Please fill out this field.',
            'patient_id.required' => 'Please fill out this field.',
            'doctor_id.required' => 'Please fill out this field.',
            'medicine.*.id.required' => 'Please fill out this field.',
            'medicine.*.quantity.required' => 'Please fill out this field.',
            'medicine.*.quantity.numeric' => 'Please use number on this field.',
            'medicine.*.unit.required' => 'Please fill out this field.'
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
            'name' => $input['name'],
            'patient_id' => $input['patient_id'],
            'doctor_id' => $input['doctor_id'],
            'appointment_id' => $input['appointment_id'] ?? 0,
            'code' => 'PRES-'.str_pad(mt_rand(1, 1000), 4, '0', STR_PAD_LEFT)
        ];

        $detail = [
            'symptom' => $input['symptom'] ?? '',
            'diagnosis' => $input['diagnosis'] ?? '',
            'advice' => $input['advice'] ?? '',
            'usage' => $input['usage'] ?? '',
        ];
        $data['detail'] = json_encode($detail);

        $medicines = $this->processMedicineToStore($input['medicine']);
        $data['medicine'] = json_encode($medicines);

        if (!empty($input['id'])) {
            $prescription = $this->prescriptionRepo->update($input['id'], $data);
        } else {
            $prescription = $this->prescriptionRepo->create($data);

            foreach ($input['medicine'] as $medicine) {
                $this->prescriptionMedicineRepo->create([
                    'prescription_id' => $prescription['id'],
                    'medicine_id' => $medicine['id'],
                ]);
            }
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->prescriptionRepo->updateMulti($ids, ['is_delete' => 1]);

        return redirect()->back();
    }

    private function processMedicineToStore($medicines)
    {
        $result = [];
        foreach ($medicines as $key => $item) {
            $medicine = [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'note' => $item['note'],
            ];

            array_push($result, $medicine);
        }

        return $result;
    }
}
