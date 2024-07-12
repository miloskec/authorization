<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CheckPermissionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/check-permissions', [CheckPermissionsController::class, 'checkPermissions']);
Route::post('/get-roles', [CheckPermissionsController::class, 'getRoles']);

Route::get('/health', function () {
    return response()->json(['status' => 'OK'], 200);
});

Route::middleware(['validateEmailHeader'])->group(function () {
    Route::post('/authorization/test-validate-email-header', [AuthorizationController::class, 'checkEmailHeader']);
});
