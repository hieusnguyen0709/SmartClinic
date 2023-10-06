<?php

namespace App\Repositories\PrescriptionMedicine;
use App\Repositories\BaseRepository;

/**
 * Class PPrescriptionMedicineRepositoryEloquent.
 *
 * @package App\Repositories\PrescriptionMedicine;
 */
class PrescriptionMedicineRepositoryEloquent extends BaseRepository implements PrescriptionMedicineRepository
{
  public function getModel()
  {
      return \App\Models\PrescriptionMedicine::class;
  }
}
