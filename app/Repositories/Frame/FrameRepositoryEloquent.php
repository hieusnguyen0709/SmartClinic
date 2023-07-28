<?php

namespace App\Repositories\Frame;

use App\Models\Frame;

/**
 * Class FrameRepositoryEloquent.
 *
 * @package App\Repositories\Frame;
 */
class FrameRepositoryEloquent implements FrameRepository
{
    protected $model;

    public function __construct(Frame $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
