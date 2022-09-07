<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTamu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function history_attendance_guests()
    {
        return $this->hasMany(HistoryAttendanceGuests::class);
    }
}
