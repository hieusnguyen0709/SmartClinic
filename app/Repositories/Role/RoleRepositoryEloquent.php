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
}
