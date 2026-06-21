<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/sync', [ApiController::class, 'sync'])->middleware('throttle:1000,60');