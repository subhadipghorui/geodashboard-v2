<?php

use App\Http\Controllers\Api\v1\MapController;
use App\Http\Controllers\DashboardController;
use App\Models\Layer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/layers', function () {
    return response()->json(Layer::all());
});
Route::get('/dashboard/{id}', [DashboardController::class, 'view'])->name('app.dashboard.view');

Route::get('/maps', [MapController::class, 'index']);
Route::get('/maps/{id}', [MapController::class, 'view']);
Route::post('/maps/{id}/update', [MapController::class, 'update']);