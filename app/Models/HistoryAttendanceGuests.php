<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAttendanceGuests extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'keperluan' => 'array',
        'rak' => 'array'
    ];

    public function user_tamus()
    {
        return $this->belongsTo(UserTamu::class, 'user_id', 'id');
    }
}
