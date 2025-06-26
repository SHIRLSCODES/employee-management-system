<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements Authorizable
{
    use HasRoles;
    
    protected $guard = 'admin';

    protected $fillable= [
      'name',
      'email',
      'password',
      'department_id',
    ];

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
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function stockRequisitions() {
        return $this->morphMany(StockRequisition::class, 'requestable');
    }

    public function stockTransactions() {
        return $this->morphMany(StockTransaction::class, 'transactionable');
    }

    public function stockReturns() {
        return $this->morphMany(StockReturn::class, 'returnable');
    }
}
