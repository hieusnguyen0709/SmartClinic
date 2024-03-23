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

// Auth //
Route::namespace('App\Http\Controllers\\Auth')->group(function () {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/post-login', 'AuthController@postLogin')->name('post_login');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/sign-up', 'AuthController@signUp')->name('sign_up');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});

// Frontend //
Route::namespace('App\Http\Controllers\\Frontend')->group(function () {
    Route::get('/', 'IndexController@index')->name('frontend.index');
    Route::get('/about', 'AboutController@index')->name('frontend.about.index');
    Route::get('/service', 'ServiceController@index')->name('frontend.service.index');
    Route::get('/doctor', 'DoctorController@index')->name('frontend.doctor.index');
    Route::get('/booking', 'BookingController@index')->name('frontend.booking.index');
    Route::get('/booking/by-day', 'BookingController@byDay')->name('frontend.booking.by_day');
    Route::get('/booking/by-doctor', 'BookingController@byDoctor')->name('frontend.booking.by_doctor');
    Route::get('/booking/get-by-day', 'BookingController@getByDay')->name('frontend.booking.get_by_day');
    Route::get('/booking/get-by-doctor', 'BookingController@getByDoctor')->name('frontend.booking.get_by_doctor');
    Route::get('/booking/get-frame-by-ids', 'BookingController@getFrameByIds')->name('frontend.booking.get_frame_by_ids');
    Route::get('/contact', 'ContactController@index')->name('frontend.contact.index');

    Route::get('/template', 'IndexController@template')->name('frontend.template');
});

// Admin //
Route::group(['middleware' => ['auth', 'admin.access']], function () {
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
            Route::get('/create', 'PrescriptionController@create')->name('prescription.create');
            Route::get('/edit/{slug}/{is_view?}', 'PrescriptionController@edit')->name('prescription.edit');
            Route::post('/store', 'PrescriptionController@store')->name('prescription.store');
            Route::post('/delete', 'PrescriptionController@delete')->name('prescription.delete');
            Route::get('/change-patient', 'PrescriptionController@changePatient')->name('prescription.change.patient');
            Route::get('/change-medicine', 'PrescriptionController@changeMedicine')->name('prescription.change.medicine');
            Route::get('/check-medicine-quantity', 'PrescriptionController@checkMedicineQuantity')->name('prescription.check.medicine.quantity');
        });

        Route::prefix('frame')->group(function () {
            Route::get('/', 'FrameController@index')->name('frame.index');
            Route::get('/get-edit', 'FrameController@getEdit')->name('frame.get.edit');
            Route::post('/store', 'FrameController@store')->name('frame.store');
            Route::post('/delete', 'FrameController@delete')->name('frame.delete');
        });

        Route::prefix('schedule')->group(function () {
            Route::get('/', 'ScheduleController@index')->name('schedule.index');
            Route::get('/calendar', 'ScheduleController@calendar')->name('schedule.calendar');
            Route::post('/update-calendar', 'ScheduleController@updateCalendar')->name('schedule.update.calendar');
            Route::get('/get-edit', 'ScheduleController@getEdit')->name('schedule.get.edit');
            Route::post('/store', 'ScheduleController@store')->name('schedule.store');
            Route::post('/delete', 'ScheduleController@delete')->name('schedule.delete');
        });

        Route::prefix('appointment')->group(function () {
            Route::get('/', 'AppointmentController@index')->name('appointment.index');
            Route::get('/get-edit', 'AppointmentController@getEdit')->name('appointment.get.edit');
            Route::post('/store', 'AppointmentController@store')->name('appointment.store');
            Route::post('/delete', 'AppointmentController@delete')->name('appointment.delete');
            Route::post('/update-status', 'AppointmentController@updateStatus')->name('appointment.update.status');
        });
    });
});