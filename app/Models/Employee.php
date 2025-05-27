<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'department',
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
}

    

