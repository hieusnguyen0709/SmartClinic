<?php

namespace App\Repositories\CaseHistory;

use App\Models\CaseHistory;

/**
 * Class CaseHistoryRepositoryEloquent.
 *
 * @package App\Repositories\CaseHistory;
 */
class CaseHistoryRepositoryEloquent implements CaseHistoryRepository
{
    protected $model;

    public function __construct(CaseHistory $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
