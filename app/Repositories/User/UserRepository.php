<?php

namespace App\Repositories\User;
use App\Repositories\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function getAll();
}
