<?php

namespace App\Repositories\Prescription;
use App\Repositories\RepositoryInterface;

/**
 * Interface PrescriptionRepository.
 *
 * @package namespace App\Repositories;
 */
interface PrescriptionRepository extends RepositoryInterface
{
    public function getPrescriptions($search, $numPerPage, $sortColumn, $sortType);
}
