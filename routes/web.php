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


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/login/employee', [EmployeeLoginController::class, 'showLoginForm'])->name('employee.login');
Route::post('/login/employee', [EmployeeLoginController::class, 'login']);
Route::post('/logout/employee', [EmployeeLoginController::class, 'logout'])->name('employee.logout');


Route::middleware(['auth'])->group(function () {
   

    Route::get('/dashboard',[EmployeeController::class, 'dashboard'])->name('dashboard');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('{employee}/my-details', [EmployeeController::class, 'show'])->name('show');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
