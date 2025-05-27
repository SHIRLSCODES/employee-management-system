<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use Illuminate\Http\Request;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\DepartmentController;
use App\Models\Employee;


Route::get('/login/admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminLoginController::class, 'login']);
Route::post('/logout/admin', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $query = Employee::query();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $employees = $query->paginate(5)->withQueryString();

        $departments = Employee::select('department')->distinct()->pluck('department');

        return view('dashboard', compact('employees', 'departments'));
    })->name('dashboard');

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
