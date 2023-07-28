<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends BaseController
{   
    protected $appointmentModel;

    public function __construct(Appointment $appointmentModel)
    {
        $this->appoimentModel = $appointmentModel;
    }

    public function index()
    {
        return view('welcome');
    }
}
