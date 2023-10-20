<?php

namespace App\Repositories\ScheduleFrame;
use App\Repositories\BaseRepository;

/**
 * Class ScheduleFrameRepositoryEloquent.
 *
 * @package App\Repositories\ScheduleFrame;
 */
class ScheduleFrameRepositoryEloquent extends BaseRepository implements ScheduleFrameRepository
{
  public function getModel()
  {
    return \App\Models\ScheduleFrame::class;
  }
}
