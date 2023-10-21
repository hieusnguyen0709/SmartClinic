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

  public function getSchedules($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->join('users as doctors', 'doctors.id', '=', 'schedules.doctor_id')
    ->selectRaw('schedules.*, doctors.name as doctor')
    ->where('schedules.is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('doctors.name', 'like', '%' . $search . '%');
        });
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
}
