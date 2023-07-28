<?php

namespace App\Repositories\Medicine;

use App\Models\Medicine;

/**
 * Class MedicineRepositoryEloquent.
 *
 * @package App\Repositories\Medicine;
 */
class MedicineRepositoryEloquent implements MedicineRepository
{
    protected $model;

    public function __construct(Medicine $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
