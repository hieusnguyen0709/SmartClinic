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
    public function getUsers($search, $numPerPage, $sortColumn, $sortType, $roleId);
    public function getPatients();
    public function getPatientById($patientId);
    public function getDoctors();
}
