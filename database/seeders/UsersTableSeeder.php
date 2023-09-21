<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'           => 'Admin',
                'email'          => 'admin@gmail.com',
                'password'       => bcrypt('123@admin'),
                'remember_token' => Str::random(60),
                'role_id'        => 1,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'admin',
            ],
            [
                'name'           => 'User',
                'email'          => 'user@gmail.com',
                'password'       => bcrypt('123@user'),
                'remember_token' => Str::random(60),
                'role_id'        => 2,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'user',
            ],
            [
                'name'           => 'Doctor',
                'email'          => 'doctor@gmail.com',
                'password'       => bcrypt('123@doctor'),
                'remember_token' => Str::random(60),
                'role_id'        => 3,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'doctor',
            ],
            [
                'name'           => 'Test Doctor',
                'email'          => 'test_doctor@gmail.com',
                'password'       => bcrypt('123@test_doctor'),
                'remember_token' => Str::random(60),
                'role_id'        => 4,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'test_doctor',
            ],
            [
                'name'           => 'Receptionist',
                'email'          => 'receptionist@gmail.com',
                'password'       => bcrypt('123@receptionist'),
                'remember_token' => Str::random(60),
                'role_id'        => 5,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'receptionist',
            ],
            [
                'name'           => 'Pharmacist',
                'email'          => 'pharmacist@gmail.com',
                'password'       => bcrypt('123@pharmacist'),
                'remember_token' => Str::random(60),
                'role_id'        => 6,
                'gender'         => 1,
                'phone'          => '',
                'age'            => rand(20, 50),
                'address'        => '',
                'avatar'         => '',
                'slug'           => 'pharmacist',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate($user);
        }
    }
}
