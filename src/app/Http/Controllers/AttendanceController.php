<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
{
    return view('attendance');
}

public function show()
{
    $todayLabel = now()->isoFormat('Y年M月D日(ddd)');
    $nowLabel   = now()->format('H:i');
    $userId = Auth::id() ?? 1;
    $today  = Carbon::today()->toDateString();
    $a = Attendance::where('user_id', $userId)
        ->where('work_date', $today)
        ->first();
    // status決定
    $status = 'off';

    if ($a && $a->clock_out) {
    $status = 'done';
     } elseif ($a && $a->clock_in && !$a->clock_out) {
    $status = ($a->break_start && !$a->break_end) ? 'break' : 'working';
    } else {
    $status = 'off';
    }
    
    $status_label = match ($status) {
        'off'     => '勤務外',
        'working' => '出勤中',
        'break'   => '休憩中',
        'done'=>'退勤済',
        default   => '不明',
    };
    return view('attendance', [
        'status' => $status,
        'status_label' => $status_label,
        'today' => $todayLabel,
        'now' => $nowLabel,
    ]);
}

public function list(Request $request)
    {
        $userId = Auth::id() ?? 1;
        $month = $request->query('month');
        $base = $month
            ? Carbon::createFromFormat('Y-m', $month)->startOfMonth()
            : Carbon::now()->startOfMonth();
        $start = $base->copy()->startOfMonth();
        $end   = $base->copy()->endOfMonth();
        $currentMonth = $base->format('Y/m');
        $prevMonth = $base->copy()->subMonth()->format('Y-m');
        $nextMonth = $base->copy()->addMonth()->format('Y-m');
        $days = [];
        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $days[] = $d->copy();
        }
        $attendances = Attendance::where('user_id', $userId)
            ->whereBetween('work_date', [$start->toDateString(), $end->toDateString()])
            ->get()
            ->keyBy(fn ($a) => Carbon::parse($a->work_date)->toDateString());
        return view('attendance_list', compact(
            'days',
            'attendances',
            'currentMonth',
            'prevMonth',
            'nextMonth'
        ));
    }
    public function detail($id)
    {
        $userId = Auth::id() ?? 1;
        $attendance = Attendance::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();
        // dd($id);
        return view('attendance_detail', compact('attendance'));
    }

    public function clockIn(Request $request)
{
    $userId = Auth::id() ?? 1;
    $today = Carbon::today()->toDateString();

    // 今日の勤怠が無ければ作る、あれば更新する
    Attendance::updateOrCreate(
        ['user_id' => $userId, 'work_date' => $today],
        ['clock_in' => Carbon::now()->format('H:i:s')]
    );

    return redirect()->route('attendance.show');
}

public function clockOut(Request $request)
{
    $userId = Auth::id() ?? 1;
    $today = Carbon::today()->toDateString();

    $a = Attendance::where('user_id', $userId)
        ->where('work_date', $today)
        ->first();

    if ($a && $a->clock_in && !$a->clock_out) {
        $a->update(['clock_out' => Carbon::now()->format('H:i:s')]);
    }

    return redirect()->route('attendance.show');
}

public function breakStart(Request $request)
{
    $userId = Auth::id() ?? 1;
    $today = Carbon::today()->toDateString();

    $a = Attendance::where('user_id', $userId)
        ->where('work_date', $today)
        ->first();

    if ($a && $a->clock_in && !$a->clock_out && !$a->break_start) {
        $a->update(['break_start' => Carbon::now()->format('H:i:s')]);
    }

    return redirect()->route('attendance.show');
}

public function breakEnd(Request $request)
{
    $userId = Auth::id() ?? 1;
    $today = Carbon::today()->toDateString();

    $a = Attendance::where('user_id', $userId)
        ->where('work_date', $today)
        ->first();

    if ($a && $a->break_start && !$a->break_end) {
        $a->update(['break_end' => Carbon::now()->format('H:i:s')]);
    }

    return redirect()->route('attendance.show');
}

}