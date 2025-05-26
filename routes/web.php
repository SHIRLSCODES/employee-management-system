<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $employees = Employee::all();
    return view('dashboard', compact('employees'));
})->name('dashboard');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::get('/{employee}/show', [EmployeeController::class, 'show'])->name('show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::patch('/{employee}/update', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee}/delete', [EmployeeController::class, 'delete'])->name('delete');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
    });
});

require __DIR__.'/auth.php';
