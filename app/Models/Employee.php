<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_no',
        'first_name',
        'last_name',
        'nin',
        'email',
        'phone_number',
        'gender',
        'date_of_birth',
        'department',
        'designation',
        'status',
        'address',
    ];

}
