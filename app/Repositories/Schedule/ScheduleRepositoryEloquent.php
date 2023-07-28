<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;

/**
 * Class ScheduleRepositoryEloquent.
 *
 * @package App\Repositories\Schedule;
 */
class ScheduleRepositoryEloquent implements ScheduleRepository
{
    protected $model;

    public function __construct(Schedule $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
