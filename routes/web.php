<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/login', 'Auth\\AuthController@login')->name('auth.login');
    Route::post('/sign-in', 'Auth\\AuthController@signIn')->name('auth.sign_in');
    Route::get('/register', 'Auth\\AuthController@register')->name('auth.register');
    Route::post('/sign-up', 'Auth\\AuthController@signUp')->name('auth.sign_up');

    Route::get('/', 'Frontend\\IndexController@index')->name('index');

    Route::get('/admin', 'Admin\\DashboardController@index')->name('dashboard');
    Route::get('/appointment', 'Admin\\AppointmentController@index')->name('appointment.index');
    Route::get('/case-history', 'Admin\\CaseHistoryController@index')->name('case_history.index');
    Route::get('/category', 'Admin\\CategoryController@index')->name('category.index');
    Route::get('/department', 'Admin\\DepartmentController@index')->name('department.index');
    Route::get('/frame', 'Admin\\FrameController@index')->name('frame.index');
    Route::get('/medicine', 'Admin\\MedicineController@index')->name('medicine.index');
    Route::get('/prescription', 'Admin\\PrescriptionController@index')->name('prescription.index');
    Route::get('/qr-code', 'Admin\\QrCodeController@index')->name('qr_code.index');
    Route::get('/role', 'Admin\\RoleController@index')->name('role.index');
    Route::get('/schedule', 'Admin\\ScheduleController@index')->name('schedule.index');
    Route::get('/test', 'Admin\\TestController@index')->name('test.index');
    Route::get('/test-type', 'Admin\\TestTypeController@index')->name('test_type.index');
    Route::get('/user', 'Admin\\UserController@index')->name('user.index');
});

