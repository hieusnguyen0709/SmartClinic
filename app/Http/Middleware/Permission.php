<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
 
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userPermissions = explode(',', Auth::user()->role->permission);
        if (empty($userPermissions)) {
            abort(403, 'Forbidden');
        }
        $permissions = (Config::get('permission.permission'));
        $permissionsById  = array_column($permissions, 'action', 'id');
        $listUserActions = [];
        foreach ($userPermissions as $id) {
            if (array_key_exists($id, $permissionsById)) {
                array_push($listUserActions, $permissionsById[$id]);
            }
        }
        $route = Route::getRoutes()->match($request);
        $currentRoute = $route->getName();
        if (!in_array($currentRoute, $listUserActions)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
