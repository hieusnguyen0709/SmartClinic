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
    Route::get('/department', 'DepartmentController@index')->name('department.index');
    Route::get('/frame', 'FrameController@index')->name('frame.index');
    Route::get('/qr-code', 'QrCodeController@index')->name('qr_code.index');
    Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');

    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/get-edit', 'UserController@getEdit')->name('user.get.edit');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::post('/delete', 'UserController@delete')->name('user.delete');
        Route::post('/update-status', 'UserController@updateStatus')->name('user.update.status');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', 'RoleController@index')->name('role.index');
        Route::get('/create', 'RoleController@create')->name('role.create');
        Route::get('/edit/{slug}/{is_view?}', 'RoleController@edit')->name('role.edit');
        Route::post('/store', 'RoleController@store')->name('role.store');
        Route::post('/delete', 'RoleController@delete')->name('role.delete');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/get-edit', 'CategoryController@getEdit')->name('category.get.edit');
        Route::get('/get-view', 'CategoryController@getView')->name('category.get.view');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::post('/delete', 'CategoryController@delete')->name('category.delete');
    });

    Route::prefix('medicine')->group(function () {
        Route::get('/', 'MedicineController@index')->name('medicine.index');
        Route::get('/get-edit', 'MedicineController@getEdit')->name('medicine.get.edit');
        Route::get('/get-view', 'MedicineController@getView')->name('medicine.get.view');
        Route::post('/store', 'MedicineController@store')->name('medicine.store');
        Route::post('/delete', 'MedicineController@delete')->name('medicine.delete');
    });

    Route::prefix('prescription')->group(function () {
        Route::get('/', 'PrescriptionController@index')->name('prescription.index');
        Route::get('/get-edit', 'PrescriptionController@getEdit')->name('prescription.get.edit');
        Route::post('/store', 'PrescriptionController@store')->name('prescription.store');
        Route::post('/delete', 'PrescriptionController@delete')->name('prescription.delete');
    });
});
