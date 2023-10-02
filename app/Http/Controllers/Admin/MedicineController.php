<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Medicine\MedicineRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class MedicineController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $medicineRepo;
    protected $categoryRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        MedicineRepository $medicineRepo,
        CategoryRepository $categoryRepo
    )
    {
        $this->request = $request;
        $this->medicineRepo = $medicineRepo;
        $this->categoryRepo = $categoryRepo;
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
        $textDropDown = '';
        if (!empty($input['id'])) {
            $medicine = $this->medicineRepo->find($input['id']);
            $categoryId = $medicine['category_id'];
            $category = $this->categoryRepo->find($categoryId);
            $textDropDown = $category['name'];
        }
        $categoryList = $this->createDropDown($textDropDown);
        
        return response()->json([
            'medicine' => $medicine,
            'categoryId' => $categoryId,
            'categoryList' => $categoryList
        ]);
    }

    public function getView()
    {
        $input = $this->request->all();
        $medicine = $categoryId = '';
        $textDropDown = '';
        if (!empty($input['id'])) {
            $medicine = $this->medicineRepo->find($input['id']);
            $categoryId = $medicine['category_id'];
            $category = $this->categoryRepo->find($categoryId);
            $textDropDown = $category['name'];
        }
        $categoryList = "<select class='form-control' disabled> <option>" . $textDropDown . "</option> </select>";
        
        return response()->json([
            'medicine' => $medicine,
            'categoryId' => $categoryId,
            'categoryList' => $categoryList
        ]);
    }

    private function buildTreeCategory($categories)
    {
        $result = '<ul>';
        foreach ($categories as $category) {
            $result .= '<li class="dropdown-item" value="'. $category['id'] .'">' . $category['name'] . '</li>';
            if (count($category->children) > 0) {
                $result .= $this->buildTreeCategory($category->children);
            } 
        }
        $result .= '</ul>';

        return $result;
    }

    private function createDropDown($textDropDown = '')
    {
        if (empty($textDropDown)) {
            $textDropDown = '----';
        }
        $categoryParent = $this->categoryRepo->getCategoryParent();
        $parentList = '<button class="btn dropdown-toggle btn-select" data-bs-toggle="dropdown">'. $textDropDown .'</button>';
        $parentList .= '<div class="dropdown-menu">';
        $parentList .= $this->buildTreeCategory($categoryParent);
        $parentList .= '</div>';

        return $parentList;
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'instruction' => 'nullable',
            'unit' => 'required',
            'quantity' => 'required|numeric',
        ];
        $message = [
            'category_id.required' => 'Please fill out this field.',
            'name.required' => 'Please fill out this field.',
            'unit.required' => 'Please fill out this field.',
            'quantity.required' => 'Please fill out this field.',
            'quantity.numeric' => 'Please use number on this field.',
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
            'user_id' => 1,
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
