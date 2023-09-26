<?php

namespace App\Repositories\Role;
use App\Repositories\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function getRoles($search, $numPerPage, $sortColumn, $sortType);
}
