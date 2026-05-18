<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StampCorrectionRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => 1,

            'attendance_id' => 1,

            'date' => now()->toDateString(),

            'reason' => $this->faker->randomElement([
                '電車遅延のため',
                '打刻漏れのため',
                '退勤時間修正',
                '休憩時間修正',
            ]),

            'status' => $this->faker->randomElement([
                'pending',
                'approved',
            ]),
        ];
    }
}