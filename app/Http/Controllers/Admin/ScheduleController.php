<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class ScheduleController extends BaseController
{
    public function index()
    {
        return 'Schedule - Admin';
    }
}
