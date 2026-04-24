<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StampCorrectionRequestController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AttendanceController  as AdminAttendanceController;
use App\Http\Controllers\Admin\StaffController;
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

Route::get('/attendance', [AttendanceController::class, 'show'])
->name('attendance.show');
Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
Route::post('/break/start', [AttendanceController::class, 'breakStart'])->name('break.start');
Route::post('/break/end', [AttendanceController::class, 'breakEnd'])->name('break.end');
Route::get('/attendance/list', [AttendanceController::class, 'list'])
->name('attendance.list');
Route::get('/attendance/detail/{id}', [AttendanceController::class, 'detail'])
->name('attendance.detail');
Route::get('/stamp_correction_request/list', [StampCorrectionRequestController::class, 'index'])
->name('stamp_correction_request.list');
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');

    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
    Route::prefix('admin')->group(function () {
    Route::get('/attendance/list', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('admin.attendance.list');
    Route::get('/attendance/{id}', [\App\Http\Controllers\Admin\AttendanceController::class, 'detail']) ->name('admin.attendance.detail');
    Route::get('/staff/list', [StaffController::class, 'index'])
        ->name('admin.staff.list');
});
