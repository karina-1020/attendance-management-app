<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StampCorrectionRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'attendance_id',
        'date',
        'reason',
        'status',
    ];

    // 申請したユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 修正対象の勤怠
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
