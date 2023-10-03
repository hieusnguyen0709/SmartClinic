<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Config;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
               'id' => 1,
               'name' => 'Admin',
               'slug' => 'admin',
               'permission' => Config::get('constants.PERMISSION_BY_ROLE.ADMIN'),
               'description' => 'Administrator - All privileges'
            ],
            [
               'id' => 2,
               'name' => 'Patient',
               'slug' => 'patient',
               'permission' => Config::get('constants.PERMISSION_BY_ROLE.PATIENT'),
               'description' => 'Patient - Books appointments'
            ],
            [
                'id' => 3,
                'name' => 'Doctor',
                'slug' => 'doctor',
                'permission' => Config::get('constants.PERMISSION_BY_ROLE.DOCTOR'),
                'description' => 'Doctor - Examines'
            ],
            [
                'id' => 4,
                'name' => 'Receptionist',
                'slug' => 'receptionist',
                'permission' => Config::get('constants.PERMISSION_BY_ROLE.RECEPTIONIST'),
                'description' => 'Receptionist - Handles appointments status'
            ],
            [
                'id' => 5,
                'name' => 'Pharmacist',
                'slug' => 'pharmacist',
                'permission' => Config::get('constants.PERMISSION_BY_ROLE.PHAMARCIST'),
                'description' => 'Pharmacist - Prescribes medicine to patients'
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
