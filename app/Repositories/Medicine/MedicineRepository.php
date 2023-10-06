<?php

namespace App\Repositories\Medicine;
use App\Repositories\RepositoryInterface;

/**
 * Interface MedicineRepository.
 *
 * @package namespace App\Repositories;
 */
interface MedicineRepository extends RepositoryInterface
{
    public function getMedicines($search, $numPerPage, $sortColumn, $sortType);
    public function getMedicineById($medicineId);
}
