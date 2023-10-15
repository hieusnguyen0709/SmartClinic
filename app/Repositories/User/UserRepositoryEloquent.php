<?php

namespace App\Repositories\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Config;

/**
 * Class UserRepositoryEloquent.
 *
 * @package App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUsers($search = null, $numPerPage = null, $sortColumn = null, $sortType = null, $roleId = null)
    {
        return $this->model->join('roles', 'roles.id', '=', 'users.role_id')
        ->selectRaw('users.*, roles.name as role')
        ->where('users.is_delete', 0)
        ->where('roles.is_delete', 0)
        ->when(!empty($search), function ($query1) use ($search) {
            $query1->where(function ($query1)  use ($search) {
                $query1->where('users.email', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orWhere('roles.name', 'like', '%' . $search . '%');
            });
        })
        ->when(!empty($roleId), function ($query) use ($roleId) {
            return $query->where('role_id', $roleId);
        })
        ->orderBy($sortColumn, $sortType)
        ->paginate($numPerPage);
    }

    public function getPatients()
    {
        return $this->model->where('is_delete', 0)
        ->where(function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('permission', Config::get('constants.PERMISSION_BY_ROLE.PATIENT'));
            });
        })
        ->get();
    }

    public function getPatientById($patientId = null)
    {
        return $this->model->where('is_delete', 0)
        ->where(function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('permission', Config::get('constants.PERMISSION_BY_ROLE.PATIENT'));
            });
        })
        ->when(!empty($patientId), function ($query) use ($patientId) {
            return $query->where('id', $patientId);
        })
        ->get();
    }

    public function getDoctors()
    {
        return $this->model->where('is_delete', 0)
        ->where(function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('permission', Config::get('constants.PERMISSION_BY_ROLE.DOCTOR'));
            });
        })
        ->get();
    }
}
