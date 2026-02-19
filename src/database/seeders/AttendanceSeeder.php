<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AttendanceSeeder extends Seeder
{
public function run(): void{
$user = User::first() ?? User::create([
'name' => 'テスト太郎',
'email' => 'test@example.com',
'password' => Hash::make('password'),
]);

$start = Carbon::now()->startOfMonth();
$end = Carbon::now()->endOfMonth();

for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
if ($date->isWeekend()) {
continue;
              }

Attendance::create([
'user_id' => $user->id,
'work_date' => $date->toDateString(),
'clock_in' => '09:00',
'clock_out' => '18:00',
'break_start' => '12:00',
'break_end' => '13:00',
'break2_start' => null,
'break2_end' => null,
'note' => $date->isSameDay('2023-06-01') ? '電車遅延のため' : null,
 ]);
}
}
}