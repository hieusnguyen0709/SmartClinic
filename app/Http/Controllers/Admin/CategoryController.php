<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class CategoryController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $cateRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        CategoryRepository $cateRepo
    )
    {
        $this->request = $request;
        $this->cateRepo = $cateRepo;
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
        $categories = $this->cateRepo->getCategories($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.category.index', compact('categories', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }
}
