<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
/**
 * Class UserRepositoryEloquent.
 *
 * @package App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
      $this->model = $model;
    }

    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }
}
