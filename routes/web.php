<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\CaseHistoryController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\DepartmentController;
use App\Http\Controllers\Frontend\FrameController;
use App\Http\Controllers\Frontend\MedicineController;
use App\Http\Controllers\Frontend\PrescriptionController;
use App\Http\Controllers\Frontend\QrCodeController;
use App\Http\Controllers\Frontend\RoleController;
use App\Http\Controllers\Frontend\ScheduleController;
use App\Http\Controllers\Frontend\TestController;
use App\Http\Controllers\Frontend\TestTypeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::get('/case-history', [CaseHistoryController::class, 'index'])->name('case_history.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/frame', [FrameController::class, 'index'])->name('frame.index');
Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine.index');
Route::get('/prescription', [PrescriptionController::class, 'index'])->name('prescription.index');
Route::get('/qr-code', [QrCodeController::class, 'index'])->name('qr_code.index');
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/test', [TestController::class, 'index'])->name('test.index');
Route::get('/test-type', [TestTypeController::class, 'index'])->name('test_type.index');
Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/admin', [IndexController::class, 'index'])->name('dashboard.index');

// Route::group(['namespace' => 'Frontend'], function () {
//     Route::get('/users', [UserController::class, 'index'])->name('user.index');
// });

