<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends BaseController
{
    public function index()
    {
        return 'Role - Admin';
    }
}
