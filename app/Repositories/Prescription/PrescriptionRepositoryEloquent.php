<?php

namespace App\Repositories\Prescription;
use App\Repositories\BaseRepository;

/**
 * Class PrescriptionRepositoryEloquent.
 *
 * @package App\Repositories\Prescription;
 */
class PrescriptionRepositoryEloquent extends BaseRepository implements PrescriptionRepository
{
  public function getModel()
  {
      return \App\Models\Prescription::class;
  }

  public function getPrescriptions($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->join('users as patients', 'patients.id', '=', 'prescriptions.patient_id')
    ->join('users as doctors', 'doctors.id', '=', 'prescriptions.doctor_id')
    ->selectRaw('prescriptions.*, patients.name as patient, doctors.name as doctor')
    ->where('prescriptions.is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('prescriptions.name', 'like', '%' . $search . '%')
            ->orWhere('prescriptions.code', 'like', '%' . $search . '%')
            ->orWhere('patients.name', 'like', '%' . $search . '%')
            ->orWhere('doctors.name', 'like', '%' . $search . '%');
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
   }
}
