<?php

namespace App\Repositories\Role;

use App\Models\Role;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package App\Repositories\Role;
 */
class RoleRepositoryEloquent implements RoleRepository
{
    protected $model;

    public function __construct(Role $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
