<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Frame\FrameRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ServiceTrait;
use Auth;

class FrameController extends BaseController
{
    use ServiceTrait;
    protected $request;
    protected $frameRepo;

    /**
     * Constructor
     */
    public function __construct(
        Request $request,
        FrameRepository $frameRepo
    )
    {
        $this->request = $request;
        $this->frameRepo = $frameRepo;
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
        $frames = $this->frameRepo->getFrames($search, $numPerPage, $sortColumn, $sortType);
        
        return view('admin.frame.index', compact('frames', 'search', 'numPerPage', 'sortColumn', 'sortType'));
    }

    public function getEdit()
    {
        $input = $this->request->all();
        $frame = '';
        if (!empty($input['id'])) {
            $frame = $this->frameRepo->find($input['id']);
        }
        
        return response()->json([
            'frame' => $frame,
        ]);
    }

    public function store()
    {
        $input = $this->request->all();
        $rules = [
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ];
        $message = [
            'name.required' => 'Please fill out this field.',
            'start_time.required' => 'Please fill out this field.',
            'end_time.required' => 'Please fill out this field.',
            'end_time.after' => 'End time must be after start time.'
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
            'start_time' => $input['start_time'],
            'end_time' => $input['end_time'],
            'user_id' => 1
        ];

        if (!empty($input['id'])) {
            $this->frameRepo->update($input['id'], $data);
        } else {
            $this->frameRepo->create($data);
        }

        return response()->json([
            'code' => '200'
        ]);
    }

    public function delete()
    {
        $input = $this->request->all();
        $ids = explode(',', $input['id_delete']);
        $this->frameRepo->updateMulti($ids ,['is_delete' => 1]);
        
        return redirect()->back();
    }
}
