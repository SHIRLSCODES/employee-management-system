<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'status',
        'created_by', 'last_updated_by',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}

    

