<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('view')->composer('*', function ($view) {
            $pageGroup = 0;
            if (app('request')->route()) {
                $action = app('request')->route()->getAction();
                $controller = class_basename($action['controller']);
                $arrPageGroupByController = [
                    '1' => [
                        'UserController@index',
                    ],
                    '2' => [
                        'RoleController@index',
                        'RoleController@create',
                        'RoleController@edit',
                    ],
                    '3' => [
                        'CategoryController@index',
                    ],
                    '4' => [
                        'MedicineController@index',
                    ],
                    '5' => [
                        'PrescriptionController@index',
                        'PrescriptionController@create',
                        'PrescriptionController@edit',
                    ],
                    '6' => [
                        'FrameController@index',
                    ],
                    '7' => [
                        'ScheduleController@index',
                        'ScheduleController@calendar',
                    ],
                    '8' => [
                        'AppointmentController@index',
                    ],
                ];
            }
            foreach ($arrPageGroupByController as $key => $item) {
                if (in_array($controller, $item)) {
                    $pageGroup = $key;
                }
            }
            $view->with(compact('pageGroup'));
        });
    }
}
