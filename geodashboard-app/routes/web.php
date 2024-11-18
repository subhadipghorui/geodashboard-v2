<?php

use App\Http\Controllers\Api\v1\MapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MVTController;
use App\Http\Controllers\ReverseProxyController;
use App\Models\Layer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['register' => false]);
Route::get('/layers', function () {
    return response()->json(Layer::all());
});

Route::group(["middleware" => ["auth", "user"], "prefix" => "user"], function($routes){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/dashboard/{id}', [DashboardController::class, 'view'])->name('app.dashboard.view');
Route::get('/maps', [MapController::class, 'index']);
Route::get('/maps/{id}', [MapController::class, 'view']);
Route::post('/maps/{id}/update', [MapController::class, 'update']);

Route::get('/mvt', [MVTController::class, 'mvt'])->middleware('throttle:1000,1');
Route::any('/tomcat-proxy{any?}', [ReverseProxyController::class, 'tomcatProxy'])->middleware('throttle:1000,1')->where('any', '.*');

