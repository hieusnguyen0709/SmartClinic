<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserService
{
    public function getList()
    {
        return User::All();
    }
}
