<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    public function index()
    {
        return view('frontend.service.index');
    }
}