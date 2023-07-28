<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;

/**
 * Class AppointmentRepositoryEloquent.
 *
 * @package App\Repositories\Appointment;
 */
class AppointmentRepositoryEloquent implements AppointmentRepository
{
    protected $model;

    public function __construct(Appointment $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
