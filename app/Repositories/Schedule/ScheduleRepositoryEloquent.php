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
}
