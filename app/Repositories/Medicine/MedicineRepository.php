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
    public function getMedicines($search = null, $numPerPage = null, $sortColumn = null, $sortType = null);
    public function getMedicineById($medicineId = null);
}
