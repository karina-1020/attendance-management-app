
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // 誰の勤怠か（usersテーブルと紐付け）
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 勤務日
            $table->date('work_date');

            // 出勤・退勤
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();

            // 休憩（1回目）
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();

            // 休憩（2回目）
            $table->time('break2_start')->nullable();
            $table->time('break2_end')->nullable();

            // 備考
            $table->string('note', 255)->nullable();

            $table->timestamps();

            // 同じユーザーが同じ日に複数レコード作れないようにする（超大事）
            $table->unique(['user_id', 'work_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}

