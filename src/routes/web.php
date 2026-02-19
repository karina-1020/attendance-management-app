<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

