<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller
{
   
    public function index(Request $request)
    {
    $date = $request->query('date', now()->toDateString());

    $currentDate = Carbon::parse($date)->format('Y-m-d');
    $prevDate = Carbon::parse($date)->subDay()->toDateString();
    $nextDate = Carbon::parse($date)->addDay()->toDateString();

    $attendances = Attendance::whereDate('work_date', $date)->get();

    return view('admin.attendance_list', compact(
        'attendances',
        'currentDate',
        'prevDate',
        'nextDate'
    ));
    }

    public function detail($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendance_detail', compact('id'));
    }
};