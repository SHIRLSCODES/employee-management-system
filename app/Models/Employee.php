<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LeaveRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $guard = 'web';

    protected $fillable = [
        'employee_no',
        'first_name',
        'password',
        'last_name',
        'nin',
        'email',
        'phone_number',
        'gender',
        'date_of_birth',
        'department_id',
        'designation',
        'status',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array{
        return [
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'employee_id');
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


    

