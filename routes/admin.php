<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Models\Employee;

Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::patch('/{employee}/update', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee}/delete', [EmployeeController::class, 'delete'])->name('delete');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/search-employees', [EmployeeController::class, 'search'])->name('search');
        
    });
       Route::get('employee/{employee}/show', [EmployeeController::class, 'show'])->name('employee.show');
       Route::get('/departments/{department}/show', [DepartmentController::class, 'show'])->name('departments.show');
});

require __DIR__.'/auth.php';
