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
    public function getUsers($search = null, $numPerPage = null, $sortColumn = null, $sortType = null, $roleId = null);
    public function getPatients();
    public function getPatientById($patientId = null);
    public function getDoctors();
}
