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
    protected $categoryRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        CategoryRepository $categoryRepo
    )
    {
        $this->request = $request;
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
        $categories = $this->categoryRepo->getCategories($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.category.index', compact('categories', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $parentId = 0;
        $category = [];
        $parentList = '';
        $textDropDown = '';
        if (!empty($input['id'])) {
            $category = $this->categoryRepo->find($input['id']);
            $parentId = $category['parent_id'];
            if ($parentId > 0) { // Has parent
                $parentCategory = $this->categoryRepo->find($category['parent_id']);
                $textDropDown = $parentCategory['name'];
            }
        }
        $parentList = $this->createDropDown($textDropDown);

        return response()->json([
            'parentId' => $parentId,
            'category' => $category,
            'parentList' => $parentList
        ]);
    }

    public function getView()
    {
        $input = $this->request->all();
        $parentId = 0;
        $category = [];
        $parentList = '';
        $textDropDown = '';
        if (!empty($input['id'])) {
            $category = $this->categoryRepo->find($input['id']);
            $parentId = $category['parent_id'];
            if ($parentId > 0) { // Has parent
                $parentCategory = $this->categoryRepo->find($category['parent_id']);
                $textDropDown = $parentCategory['name'];
            }
        }
        $parentList = "<select class='form-control' disabled> <option>" . $textDropDown . "</option> </select>";

        return response()->json([
            'parentId' => $parentId,
            'category' => $category,
            'parentList' => $parentList
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
            'name' => 'required'
        ];
        $message = [
            'name.required' => 'Please fill out this field.'
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) 
        {
            $response = [
                'code' => '422',
                'errors' => $validator->messages()->toArray()
            ];
            return response()->json($response);
        }

        $data = [
            'name' => $input['name'],
            'parent_id' => $input['parent_id'],
            'description' => $input['description'],
            'user_id' => 1
        ];

        if (!empty($input['id'])) {
            $this->categoryRepo->update($input['id'], $data);
        } else {
            $this->categoryRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->categoryRepo->updateMulti($ids, ['is_delete' => 1]);

        return redirect()->back();
    }
}
