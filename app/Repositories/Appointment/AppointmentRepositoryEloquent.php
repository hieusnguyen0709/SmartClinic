<?php

namespace App\Repositories\Appointment;
use App\Repositories\BaseRepository;

/**
 * Class AppointmentRepositoryEloquent.
 *
 * @package App\Repositories\Appointment;
 */
class AppointmentRepositoryEloquent extends BaseRepository implements AppointmentRepository
{
  public function getModel()
  {
      return \App\Models\Appointment::class;
  }

  public function getAppointments($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->join('users as patients', 'patients.id', '=', 'appointments.patient_id')
    ->join('users as doctors', 'doctors.id', '=', 'appointments.doctor_id')
    ->selectRaw('appointments.*, patients.name as patient, doctors.name as doctor')
    ->where('appointments.is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('appointments.code', 'like', '%' . $search . '%')
            ->orWhere('patients.name', 'like', '%' . $search . '%')
            ->orWhere('doctors.name', 'like', '%' . $search . '%');
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
  }
}
