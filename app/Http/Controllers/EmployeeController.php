<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function create()
    {
        return view('employee.create');
    }

    public function show($id)
    {
        return view('employee.show', compact('id'));
    }

    public function edit($id)
    {
        return view('employee.edit', compact('id'));
    }
}
