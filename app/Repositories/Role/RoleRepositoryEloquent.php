<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package App\Repositories\Role;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function getModel()
    {
        return \App\Models\Role::class;
    }

    public function getRoles($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
    {
        return $this->model->where('is_delete', 0)
        ->when(!empty($search), function ($query) use ($search) {
            $query->where(function ($query)  use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        ->orderBy($sortColumn, $sortType)
        ->paginate($numPerPage);
    }
}
