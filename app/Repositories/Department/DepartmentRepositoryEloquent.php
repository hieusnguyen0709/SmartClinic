<?php

namespace App\Repositories\Department;

use App\Models\Department;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package App\Repositories\Department;
 */
class DepartmentRepositoryEloquent implements DepartmentRepository
{
    protected $model;

    public function __construct(Department $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
