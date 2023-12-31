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
    public function getSchedules($search = null, $numPerPage = null, $sortColumn = null, $sortType = null, $doctorId = null, $startDate = null, $endDate = null);
    public function getSchedulesToCalendar();
    public function getSchedulesByStartDate($startDate = null);
    public function getSchedulesByDoctorId($doctorId = null);
}
