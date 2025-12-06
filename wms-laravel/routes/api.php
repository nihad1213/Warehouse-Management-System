<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Permission\PermissionController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Permission Routes
    Route::prefix('permission')->group(function () {
        Route::post('/create', [PermissionController::class, 'create'])->middleware('check.permission:create_permission');
        Route::post('/update', [PermissionController::class, 'update'])->middleware('check.permission:update_permission');
        Route::post('/delete', [PermissionController::class, 'delete'])->middleware('check.permission:delete_permission');
        Route::post('/read', [PermissionController::class, 'read'])->middleware('check.permission:read_permission');
    });

});

