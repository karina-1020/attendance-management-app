<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
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

    $attendances = Attendance::with('user')
    ->whereDate('work_date', $date)
    ->get();

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

    return view('admin.attendance_detail', compact('attendance'));
}

public function staffList($id, Request $request)
{
    $user = User::findOrFail($id);

    $month = $request->query('month');

    $base = $month
        ? Carbon::createFromFormat('Y-m', $month)->startOfMonth()
        : Carbon::now()->startOfMonth();

    $start = $base->copy()->startOfMonth();
    $end   = $base->copy()->endOfMonth();

    $days = [];

    for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
        $days[] = $d->copy();
    }

    $attendances = Attendance::where('user_id', $id)
        ->whereBetween('work_date', [
            $start->toDateString(),
            $end->toDateString()
        ])
        ->get();

    return view('admin.staff.show', [ 
        'user' => $user,
        'days' => $days,
        'attendances' => $attendances,
        'currentMonth' => $base->format('Y/m'),
        'prevMonth' => $base->copy()->subMonth()->format('Y-m'),
        'nextMonth' => $base->copy()->addMonth()->format('Y-m'),
    ]);
}

};