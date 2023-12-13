<?php

namespace App\Repositories\Schedule;
use App\Repositories\BaseRepository;

/**
 * Class ScheduleRepositoryEloquent.
 *
 * @package App\Repositories\Schedule;
 */
class ScheduleRepositoryEloquent extends BaseRepository implements ScheduleRepository
{
  public function getModel()
  {
    return \App\Models\Schedule::class;
  }

  public function getSchedules($search = null, $numPerPage = null, $sortColumn = null, $sortType = null, $doctorId = null, $startDate = null, $endDate = null)
  {
    return $this->model->join('users as doctors', 'doctors.id', '=', 'schedules.doctor_id')
    ->selectRaw('schedules.*, doctors.name as doctor')
    ->where('schedules.is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('doctors.name', 'like', '%' . $search . '%');
        });
    })
    ->when(!empty($doctorId), function ($query) use ($doctorId) {
      $query->where('doctor_id', $doctorId);
    })
    ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
      $query->whereDate('start_date', '>=', $startDate)
            ->whereDate('end_date', '<=', $endDate);
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
   }

  public function getSchedulesToCalendar()
  {
      return $this->model->where('is_delete', 0)
      ->with(['doctor', 'scheduleFrames', 'scheduleFrames.schedule', 'scheduleFrames.frame'])
      ->get();
  }

  public function getSchedulesByStartDate($startDate = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($startDate), function ($query) use ($startDate) {
      $query->where('start_date', $startDate);
    })
    ->with(['doctor', 'scheduleFrames', 'scheduleFrames.schedule', 'scheduleFrames.frame'])
    ->get();
  }

  public function getSchedulesByDoctorId($doctorId = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($doctorId), function ($query) use ($doctorId) {
      $query->where('doctor_id', $doctorId);
    })
    ->with(['doctor', 'scheduleFrames', 'scheduleFrames.schedule', 'scheduleFrames.frame'])
    ->get();
  }
}
