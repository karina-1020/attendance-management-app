<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
{
    return view('attendance');
}

public function show()
{
$today = now()->format('Y年n月j日(D)');
$now = now()->format('H:i');

$status = 'off';

$status_label = match($status) {
'off' => '勤務外',
'working' => '出勤中',
'break' => '休憩中',
default => '勤務外',
};

return view('attendance', compact('status', 'status_label', 'today', 'now'));
}
}