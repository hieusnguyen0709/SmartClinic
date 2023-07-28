<?php

namespace App\Repositories\User;

use App\Models\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package App\Repositories\User;
 */
class UserRepositoryEloquent implements UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
