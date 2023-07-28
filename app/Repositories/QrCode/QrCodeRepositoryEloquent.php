<?php

namespace App\Repositories\QrCode;

use App\Models\QrCode;

/**
 * Class QrCodeRepositoryEloquent.
 *
 * @package App\Repositories\QrCode;
 */
class QrCodeRepositoryEloquent implements QrCodeRepository
{
    protected $model;

    public function __construct(QrCode $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
