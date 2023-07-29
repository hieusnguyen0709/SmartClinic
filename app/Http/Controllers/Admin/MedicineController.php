<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class MedicineController extends BaseController
{
    public function index()
    {
        return 'Medicine - Admin';
    }
}
