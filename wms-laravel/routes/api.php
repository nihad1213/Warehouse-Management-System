<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Role\RoleController;
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
        Route::put('/update', [PermissionController::class, 'update'])->middleware('check.permission:update_permission');
        Route::post('/delete', [PermissionController::class, 'delete'])->middleware('check.permission:delete_permission');
        Route::post('/read', [PermissionController::class, 'read'])->middleware('check.permission:read_permission');
    });

    // Roles Routes
    Route::prefix('role')->group(function () {
        Route::post('/create', [RoleController::class, 'create'])->middleware('check.permission:create_role');
        Route::put('/update', [RoleController::class, 'update'])->middleware('check.permission:update_role');
        Route::post('/delete', [RoleController::class, 'delete'])->middleware('check.permission:delete_role');
        Route::post('/read', [RoleController::class, 'read'])->middleware('check.permission:read_role');
    });

    // Categories Routes
    Route::prefix('category')->group(function () {
        Route::post('/create', [CategoryController::class, 'create'])->middleware('check.permission:create_category');
        Route::put('/update', [CategoryController::class, 'update'])->middleware('check.permission:update_category');
        Route::post('/delete', [CategoryController::class, 'delete'])->middleware('check.permission:delete_category');
        Route::post('/read', [CategoryController::class, 'read'])->middleware('check.permission:read_category');
    });

});

