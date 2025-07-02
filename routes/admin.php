<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\StockReturnController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StockRequestController;
use App\Http\Controllers\Admin\PaymentRequestController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleAssignmentController;
use App\Http\Controllers\Admin\PermissionController;
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
        Route::get('/{employee}/show', [EmployeeController::class, 'show'])->name('show');
    });

    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('store');
        Route::get('/{department}/show', [DepartmentController::class, 'show'])->name('show');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::patch('/{department}/update', [DepartmentController::class, 'update'])->name('update');
        Route::post('/{department}/destroy', [DepartmentController::class, 'destroy'])->name('destroy');
        Route::get('/search-departments', [DepartmentController::class, 'search'])->name('search');

    });

    Route::prefix('leaves')->name('leaves.')->group(function () {
        Route::get('/', [LeaveController::class, 'index'])->name('index');
        Route::get('/create', [LeaveController::class, 'create'])->name('create');
        Route::get('/{leave}/show', [LeaveController::class, 'show'])->name('show');
        Route::patch('/{leave}/approve', [LeaveController::class, 'approve'])->name('approve');
        Route::patch('/{leave}/deny', [LeaveController::class, 'deny'])->name('deny');
        Route::post('/store',[LeaveController::class, 'store'])->name('store');
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])->name('edit');
        Route::patch('/{leave}/update', [LeaveController::class, 'update'])->name('update');
        Route::get('/setup', [LeaveController::class, 'setup'])->name('setup');
        Route::patch('/setup/update', [LeaveController::class, 'updateLeaveDays'])->name('updateLeaveDays');
        Route::patch('/setup/updateAllEmployees', [LeaveController::class, 'updateAllEmployees'])->name('updateAllEmployees');
        
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/index',[AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{admin}/show', [AdminController::class, 'show'])->name('show');
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::patch('/{admin}/update', [AdminController::class, 'update'])->name('update');
        Route::delete('/{admin}/delete', [AdminController::class, 'delete'])->name('delete');
        Route::get('/search', [AdminController::class, 'search'])->name('search');
    });

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentRequestController::class, 'index'])->name('index');
        Route::get('/create', [PaymentRequestController::class, 'create'])->name('create');
        Route::post('/store', [PaymentRequestController::class, 'store'])->name('store');
        Route::get('/{paymentRequest}/edit', [PaymentRequestController::class, 'edit'])->name('edit');
        Route::patch('/{paymentRequest}/update', [PaymentRequestController::class, 'update'])->name('update');
        Route::delete('/{paymentRequest}/delete', [PaymentRequestController::class, 'destroy'])->name('destroy');
        Route::get('/{paymentRequest}/show', [PaymentRequestController::class, 'show'])->name('show');
        Route::patch('/{paymentRequest}/approve', [PaymentRequestController::class, 'approve'])->name('approve');
        Route::patch('/{paymentRequest}/deny', [PaymentRequestController::class, 'deny'])->name('deny');
        Route::patch('/{paymentRequest}/finance/approve', [PaymentRequestController::class, 'approveFinance'])->middleware(['permission:approve payments'])->name('approve.finance');
        Route::patch('/{paymentRequest}/finance/deny', [PaymentRequestController::class, 'denyFinance'])->middleware(['permission:deny payments'])->name('deny.finance');
    });

        Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::post('/admin/create', [AttendanceController::class, 'create'])->name('create');
        Route::post('/admin/edit', [AttendanceController::class, 'edit'])->name('edit');
        Route::get('/checkIn', [AttendanceController::class, 'checkIn'])->name('checkIn');
        Route::get('/checkOut', [AttendanceController::class, 'checkOut'])->name('checkOut');
        Route::get('/setup', [AttendanceController::class, 'setup'])->name('setup');
        Route::patch('/setup/updateLatenessTime', [AttendanceController::class, 'updateLatenessTime'])->name('updateLatenessTime');
        Route::post('/issueLateQuery', [AttendanceController::class, 'issueLateQuery'])->name('issueLateQuery');

        Route::get('/admin', [AttendanceController::class, 'adminIndex'])->name('admin-index');
    });

    Route::prefix('stock')->name('stocks.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::get('/admin/create', [StockController::class, 'create'])->name('create');
        Route::post('/admin/store', [StockController::class, 'store'])->name('store');
        Route::get('/admin/edit', [StockController::class, 'edit'])->name('edit');

    });

    Route::prefix('stockRequisitions')->name('stockRequisitions.')->group(function () {
        Route::get('/', [StockRequestController::class, 'index'])->name('index');
        Route::get('/adminIndex', [StockRequestController::class, 'adminIndex'])->name('adminIndex');
        Route::get('/create', [StockRequestController::class, 'create'])->name('create');
        Route::post('/store', [StockRequestController::class, 'store'])->name('store');
        Route::get('/{stockRequisition}/edit', [StockRequestController::class, 'edit'])->name('edit');
        Route::patch('/{stockRequisition}/update', [StockRequestController::class, 'update'])->name('update');
        Route::delete('/{stockRequisition}/delete', [StockRequestController::class, 'delete'])->name('delete');
        Route::get('/{stockRequisition}/show', [StockRequestController::class, 'show'])->name('show');
        Route::patch('/{stockRequisition}/approve', [StockRequestController::class, 'approve'])->middleware(['permission:approve stock requisitions'])->name('approve');
        Route::patch('/{stockRequisition}/deny', [StockRequestController::class, 'deny'])->middleware(['permission:deny stock requisitions'])->name('deny');
    });

    Route::prefix('stockReturns')->name('stockReturns.')->group(function () {
        Route::get('/', [StockReturnController::class, 'index'])->name('index');
        Route::get('/adminIndex', [StockReturnController::class, 'adminIndex'])->name('adminIndex');
        Route::get('/create', [StockReturnController::class, 'create'])->name('create');
        Route::post('/store', [StockReturnController::class, 'store'])->name('store');
        Route::get('/{stockReturn}/edit', [StockReturnController::class, 'edit'])->name('edit');
        Route::patch('/{stockReturn}/update', [StockReturnController::class, 'update'])->name('update');
        Route::delete('/{stockReturn}/delete', [StockReturnController::class, 'delete'])->name('delete');
        Route::get('/{stockReturn}/show', [StockReturnController::class, 'show'])->name('show');
        Route::patch('/{stockReturn}/approve', [StockReturnController::class, 'approve'])->middleware(['permission:approve stock returns'])->name('approve');
        Route::patch('/{stockReturn}/deny', [StockReturnController::class, 'deny'])->middleware(['permission:deny stock returns'])->name('deny');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/index',[RoleController::class, 'index'])->name('index');
        Route::post('', [RoleController::class, 'store'])->name('store');
        Route::patch('roles/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('permissions.assign');
        Route::get('assign-roles', [RoleAssignmentController::class, 'index'])->name('assign.index');
        Route::patch('/update', [RoleAssignmentController::class, 'update'])->name('assign.update');

        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        });

    });

require __DIR__.'/auth.php';