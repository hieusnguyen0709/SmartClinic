<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('admin.index');
    }
}
