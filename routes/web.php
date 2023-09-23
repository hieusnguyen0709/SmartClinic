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
    Route::get('/', 'Frontend\\IndexController@index')->name('frontend.index');
    Route::get('/login', 'Auth\\AuthController@login')->name('auth.login');
    Route::post('/sign-in', 'Auth\\AuthController@signIn')->name('auth.sign_in');
    Route::get('/register', 'Auth\\AuthController@register')->name('auth.register');
    Route::post('/sign-up', 'Auth\\AuthController@signUp')->name('auth.sign_up');
});

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/appointment', 'AppointmentController@index')->name('appointment.index');
    Route::get('/case-history', 'CaseHistoryController@index')->name('case_history.index');
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::get('/department', 'DepartmentController@index')->name('department.index');
    Route::get('/frame', 'FrameController@index')->name('frame.index');
    Route::get('/medicine', 'MedicineController@index')->name('medicine.index');
    Route::get('/prescription', 'PrescriptionController@index')->name('prescription.index');
    Route::get('/qr-code', 'QrCodeController@index')->name('qr_code.index');
    Route::get('/role', 'RoleController@index')->name('role.index');
    Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');
    Route::get('/test', 'TestController@index')->name('test.index');
    Route::get('/test-type', 'TestTypeController@index')->name('test_type.index');

    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/get-edit', 'UserController@getEdit')->name('user.get.edit');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::get('/edit', 'UserController@edit')->name('user.edit');
        Route::post('/delete', 'UserController@delete')->name('user.delete');
        Route::post('/update-status', 'UserController@updateStatus')->name('user.update.status');
    });
});
