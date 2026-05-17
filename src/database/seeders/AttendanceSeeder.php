<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            for ($i = 0; $i < 20; $i++) {
                $date = Carbon::create(2026, 5, 1)->addDays($i);

                Attendance::factory()->create([
                    'user_id' => $user->id,
                    'work_date' => $date->toDateString(),
                ]);
            }
        }
    }
}