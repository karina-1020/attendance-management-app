<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
      /**
    * Define the model's default state.
    *@return array
     */
public function definition(): array
   {
     return [
        'user_id' => 1,
        'work_date' => now()->toDateString(),
        'clock_in' => '09:00',
        'clock_out' => '18:00',
        'break_start' => '12:00',
        'break_end' => '13:00',
        'break2_start' => null,
        'break2_end' => null,
        'note' => $this->faker->optional()->realText(20),
        ];
   }
}