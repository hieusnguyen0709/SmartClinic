<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class BookingController extends BaseController
{
    public function index()
    {
        return view('frontend.booking.index');
    }
    
    public function byDay()
    {
        return view('frontend.booking.by-day');
    }

    public function byDoctor()
    {
        return view('frontend.booking.by-doctor');
    }
}