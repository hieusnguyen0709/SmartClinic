<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class QrCodeController extends BaseController
{
    public function index()
    {
        return 'QrCode - Admin';
    }
}
