<?php

namespace App\Repositories\Schedule;
use App\Repositories\RepositoryInterface;

/**
 * Interface ScheduleRepository.
 *
 * @package namespace App\Repositories;
 */
interface ScheduleRepository extends RepositoryInterface
{
    public function getSchedules($search = null, $numPerPage = null, $sortColumn = null, $sortType = null);
    public function getSchedulesToCalendar();
}
