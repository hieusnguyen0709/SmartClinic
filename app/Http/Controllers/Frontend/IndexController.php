<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        return view('frontend.index');
    }

    public function template()
    {
        return view('frontend.template.index');
    }
}
