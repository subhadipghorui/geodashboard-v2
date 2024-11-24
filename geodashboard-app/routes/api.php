<?php

use App\Http\Controllers\MVTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mvt', [MVTController::class, 'mvt'])->middleware('throttle:1000,1');