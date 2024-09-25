<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CheckPermissionsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['jwt.validate'])->group(function () {
    Route::post('/check-permissions', [CheckPermissionsController::class, 'checkPermissions']);
    Route::post('/get-roles', [CheckPermissionsController::class, 'getRoles']);
    Route::post('/check-email-header', [AuthorizationController::class, 'checkEmailHeader']);
});

Route::get('/health', function () {
    return response()->json(['status' => 'OK'], 200);
});
