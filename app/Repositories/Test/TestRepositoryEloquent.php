<?php

namespace App\Repositories\Test;

use App\Models\Test;

/**
 * Class TestRepositoryEloquent.
 *
 * @package App\Repositories\Test;
 */
class TestRepositoryEloquent implements TestRepository
{
    protected $model;

    public function __construct(Test $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
