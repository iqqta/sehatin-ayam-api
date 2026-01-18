<?php

use App\Http\Controllers\Api\ExpertSystemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/sync', [ExpertSystemController::class, 'sync']);
