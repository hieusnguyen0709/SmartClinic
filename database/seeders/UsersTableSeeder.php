<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role = Role::where('name', 'admin')->firstOrFail();
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('123@admin'),
                'remember_token' => Str::random(60),
                'role_id'        => 1,
                'gender'         => 1,
                'phone'          => 1,
                'age'            => 1,
                'address'        => 1,
                'avatar'         => 1,
                'slug'           => 1,
            ]
        );
    }
}
