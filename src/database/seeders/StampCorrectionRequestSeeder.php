<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\StampCorrectionRequest;

class StampCorrectionRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendances = Attendance::take(10)->get();

        foreach ($attendances as $attendance) {

            StampCorrectionRequest::factory()->create([

                'user_id' => $attendance->user_id,

                'attendance_id' => $attendance->id,

                'date' => $attendance->work_date,

            ]);
        }
    }
}
