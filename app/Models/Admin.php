<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable= [
      'name',
      'email',
      'password',
    ];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function usedLeaveDays()
    {
        return $this->leaveRequests()
                    ->where('status', 'approved')
                    ->sum('number_of_days');
    }

    public function leaveBalance()
    {
        return $this->total_leave_days - $this->usedLeaveDays();
    }
    
}
