<?php

namespace App\Repositories\TestType;

use App\Models\TestType;

/**
 * Class TestTypeRepositoryEloquent.
 *
 * @package App\Repositories\TestType;
 */
class TestTypeRepositoryEloquent implements TestTypeRepository
{
    protected $model;

    public function __construct(TestType $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
