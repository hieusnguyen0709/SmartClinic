<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Medicine\MedicineRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class MedicineController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $medicineRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        MedicineRepository $medicineRepo
    )
    {
        $this->request = $request;
        $this->medicineRepo = $medicineRepo;
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
        $roleId = $this->request->input('select_role');
        $medicines = $this->medicineRepo->getMedicines($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.medicine.index', compact('medicines', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $medicine = $categoryId = '';
        if (!empty($input['id'])) {
            $medicine = $this->medicineRepo->find($input['id']);
            // $categoryId = $medicine['category_id'];
        }
        // $categories = $this->cateRepo->getAllRecordActive();
        // $cateList = $this->getListSelect($categories, $categoryId);
        
        return response()->json([
            'medicine' => $medicine
            // 'roleList' => $roleList
        ]);
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'instruction' => 'nullable',
            'unit' => 'required',
            'quantity' => 'required',
        ];
        $message = [
            'category_id.required' => 'Please fill out this field.',
            'name.required' => 'Please fill out this field.',
            'unit.required' => 'Please fill out this field.',
            'quantity.required' => 'Please fill out this field.',
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
            'category_id' => $input['category_id'],
            'name' => $input['name'],
            'instruction' => $input['instruction'],
            'unit' => $input['unit'],
            'quantity' => $input['quantity'],
        ];

        if (!empty($input['id'])) {
            $this->medicineRepo->update($input['id'], $data);
        } else {
            $this->medicineRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->medicineRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }
}
