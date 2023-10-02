<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Prescription\PrescriptionRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class PrescriptionController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $prescriptionRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        PrescriptionRepository $prescriptionRepo
    )
    {
        $this->request = $request;
        $this->prescriptionRepo = $prescriptionRepo;
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
        $prescriptions = $this->prescriptionRepo->getPrescriptions($search, $numPerPage, $sortColumn, $sortType);

        return view('admin.prescription.index', compact('prescriptions', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {

    }

    public function store()
    {

    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->prescriptionRepo->updateMulti($ids, ['is_delete' => 1]);

        return redirect()->back();
    }
}
