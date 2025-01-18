<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');

//ADMIN
Route::group(["prefix" => "admin", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'has_any_admin_role'], "as" => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


//USER
Route::group(["prefix" => "user", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'role:user'], "as" => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
