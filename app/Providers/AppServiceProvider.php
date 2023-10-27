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
            $pageGroupAdmin = $pageGroupFrontend = 0;
            if (app('request')->route()) {
                $action = app('request')->route()->getAction();
                $controller = class_basename($action['controller']);
                $arrPageGroupAdminByController = [
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
                $arrPageGroupFrontendByController = [
                    '1' => [
                        'IndexController@index',
                    ],
                    '2' => [
                        'AboutController@index',
                    ],
                    '3' => [
                        'ServiceController@index',
                    ],
                    '4' => [
                        'DoctorController@index',
                    ],
                    '5' => [
                        'BookingController@index',
                        'BookingController@byDay',
                        'BookingController@byDoctor',
                    ],
                    '6' => [
                        'ContactController@index',
                    ],
                ];
            }

            foreach ($arrPageGroupAdminByController as $key => $item) {
                if (in_array($controller, $item)) {
                    $pageGroupAdmin = $key;
                }
            }
            foreach ($arrPageGroupFrontendByController as $key => $item) {
                if (in_array($controller, $item)) {
                    $pageGroupFrontend = $key;
                }
            }
            
            $view->with(compact('pageGroupAdmin', 'pageGroupFrontend'));
        });
    }
}
