<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SavePermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function store(SavePermissionRequest $request)
    {
        Permission::create(['name' => $request->name]);

        return back()->with('success', 'Permission successfully created.');
    }
}
