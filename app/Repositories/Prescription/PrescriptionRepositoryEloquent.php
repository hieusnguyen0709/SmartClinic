<?php

namespace App\Repositories\Prescription;

use App\Models\Prescription;

/**
 * Class PrescriptionRepositoryEloquent.
 *
 * @package App\Repositories\Prescription;
 */
class PrescriptionRepositoryEloquent implements PrescriptionRepository
{
    protected $model;

    public function __construct(Prescription $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
