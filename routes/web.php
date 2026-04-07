<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ContactController;

// Public Frontend Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Frontend Pages
Route::get('/about', [HomeController::class, 'about'])->name('frontend.about');

Route::get('/services', function () {
    return view('frontend.services');
})->name('frontend.services');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('frontend.contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('frontend.contact.submit');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Password Change Routes
Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.show')->middleware('auth');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change')->middleware('auth');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Employee Routes
Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
});

// Role Routes
Route::middleware(['auth', 'role:Admin,HR'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assign-permissions');
});

// Permission Routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('permissions', PermissionController::class);
});

// User Approval Routes (Superadmin and Admin)
Route::middleware(['auth', 'role:Superadmin,Admin'])->group(function () {
    Route::get('/approval', [UserApprovalController::class, 'index'])->name('approval.index');
    Route::post('/approval/{id}/approve', [UserApprovalController::class, 'approve'])->name('approval.approve');
    Route::delete('/approval/{id}/reject', [UserApprovalController::class, 'reject'])->name('approval.reject');
    Route::patch('/approval/{id}/revoke', [UserApprovalController::class, 'revoke'])->name('approval.revoke');
});

// Old employee.blade.php route compatibility
Route::get('/employee', function () {
    return view('employee');
})->middleware('auth');

// File Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/files', [FileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}', [FileController::class, 'show'])->name('files.show');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
});

// Public files route (for frontend)
Route::get('/public-files', [FileController::class, 'publicFiles'])->name('files.public');

// Admin file management routes
Route::middleware(['auth', 'role:Superadmin,Admin'])->group(function () {
    Route::get('/all-files', [FileController::class, 'allFiles'])->name('files.all');
});

// Leave Request Routes
Route::middleware('auth')->group(function () {
    // Employee leave requests
    Route::get('/my-leaves', [LeaveRequestController::class, 'myLeaves'])->name('leave.my');
    Route::get('/leave/create', [LeaveRequestController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveRequestController::class, 'store'])->name('leave.store');
    Route::delete('/leave/{id}/cancel', [LeaveRequestController::class, 'cancel'])->name('leave.cancel');
});

// Email Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/emails', [EmailController::class, 'index'])->name('email.index');
    Route::get('/emails/compose', [EmailController::class, 'compose'])->name('email.compose');
    Route::post('/emails/send', [EmailController::class, 'send'])->name('email.send');
    Route::get('/emails/{email}', [EmailController::class, 'show'])->name('email.show');
    Route::delete('/emails/{email}', [EmailController::class, 'destroy'])->name('email.destroy');
});

// Admin/Superadmin leave management routes
Route::middleware(['auth', 'role:Superadmin,Admin,HR'])->group(function () {
    Route::get('/leaves', [LeaveRequestController::class, 'index'])->name('leave.index');
    Route::post('/leaves/{id}/approve', [LeaveRequestController::class, 'approve'])->name('leave.approve');
    Route::post('/leaves/{id}/reject', [LeaveRequestController::class, 'reject'])->name('leave.reject');
});