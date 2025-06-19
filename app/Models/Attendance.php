<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Attendance extends Model
{
    protected $fillable = [
        'attendable_id',
        'attendable_type',
        'branch',
        'attendance_date',
        'check_in',
        'check_out',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in' => 'datetime:H:i:s',
        'check_out' => 'datetime:H:i:s',
    ];

    public function attendable(): MorphTo
    {
        return $this->morphTo();
    }
    /**
     * Get the user associated with the attendance record.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getUser()
    {
        return $this->attendable;
    }
    
    public function getDisplayNameAttribute()
    {
        if ($this->attendable instanceof \App\Models\Employee) {
            return $this->attendable->first_name . ' ' . $this->attendable->last_name;
        }

        if ($this->attendable instanceof \App\Models\Admin) {
            return $this->attendable->name;
        }

        return 'Unknown';
    }

    public function getIsLateAttribute(): bool
    {
        if (!$this->check_in) {
        return false;
        }

        $checkInTime = $this->check_in->copy()->setDateFrom(now());
        $lateCutoff = now()->copy()->setTime(8, 30, 0);

        return $checkInTime->gt($lateCutoff);
    }

}
