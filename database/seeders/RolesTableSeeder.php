<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

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
               'permission' => '1,100,101,102,103,104,200,201,202,203,300,301,302,303,400,401,402,403,500,501,502,503,600,601,602,603,700,701,702,703,800,801,802,803',
               'description' => 'Administrator - All privileges'
            ],
            [
               'id' => 2,
               'name' => 'User',
               'slug' => 'user',
               'permission' => '',
               'description' => 'Normal user - Books appointments'
            ],
            [
                'id' => 3,
                'name' => 'Doctor',
                'slug' => 'doctor',
                'permission' => '1,500,501,502,503,600,601,602,603,800,801,802,803',
                'description' => 'Doctor - Examines'
            ],
            [
                'id' => 4,
                'name' => 'Receptionist',
                'slug' => 'receptionist',
                'permission' => '1,100,101,102,103,104,800,801,802,803',
                'description' => 'Receptionist - Handles appointments status'
            ],
            [
                'id' => 5,
                'name' => 'Pharmacist',
                'slug' => 'pharmacist',
                'permission' => '1,400,401,402,403',
                'description' => 'Pharmacist - Prescribes medicine to patients'
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
