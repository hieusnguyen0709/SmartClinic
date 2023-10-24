<?php

namespace App\Repositories\Appointment;
use App\Repositories\RepositoryInterface;

/**
 * Interface AppointmentRepository.
 *
 * @package namespace App\Repositories;
 */
interface AppointmentRepository extends RepositoryInterface
{
    public function getAppointments($search = null, $numPerPage = null, $sortColumn = null, $sortType = null);
}
