<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use Illuminate\Http\Request;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Models\Employee;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/login/employee', [EmployeeLoginController::class, 'showLoginForm'])->name('employee.login');
Route::post('/login/employee', [EmployeeLoginController::class, 'login']);
Route::post('/logout/employee', [EmployeeLoginController::class, 'logout'])->name('employee.logout');


Route::middleware(['auth'])->group(function () {
   

    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('{employee}/my-details', [EmployeeController::class, 'show'])->name('my-details');

    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/store',[LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::patch('/leaves/{leave}/update', [LeaveController::class, 'update'])->name('leaves.update');
    Route::get('/leaves/{leave}/show', [LeaveController::class, 'show'])->name('leaves.show');
    Route::delete('/leaves/{leave}/delete', [LeaveController::class, 'destroy'])->name('leaves.destroy');
    Route::get('/leaves/balance', [LeaveController::class, 'balance'])->name('leaves.balance');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
