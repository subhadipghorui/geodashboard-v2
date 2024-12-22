<?php

use App\Http\Controllers\MVTController;
use App\Http\Controllers\ReverseProxyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mvt', [MVTController::class, 'mvt'])->middleware('throttle:1000,1');
Route::any('/tomcat-proxy{any?}', [ReverseProxyController::class, 'tomcatProxy'])->middleware('throttle:1000,1')->where('any', '.*');
