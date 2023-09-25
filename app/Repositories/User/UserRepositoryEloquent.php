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

    public function getUsers($search = null, $numPerPage = null, $sortColumn = null, $sortType = null, $roleId = null)
    {
        return $this->model->join('roles', 'roles.id', '=', 'users.role_id')
        ->selectRaw('users.*, roles.name as role')
        ->where('users.is_delete', 0)
        ->where('roles.is_delete', 0)
        ->when(!empty($search), function ($query1) use ($search) {
            $query1->where(function ($query1)  use ($search) {
                $query1->where('users.email', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orWhere('roles.name', 'like', '%' . $search . '%');
            });
        })
        ->when(!empty($roleId), function ($query) use ($roleId) {
            return $query->where('role_id', $roleId);
        })
        ->orderBy($sortColumn, $sortType)
        ->paginate($numPerPage);
    }
}
