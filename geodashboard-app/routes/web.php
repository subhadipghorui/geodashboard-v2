<?php

use App\Http\Controllers\Api\v1\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layers', function () {
    return response()->json(\App\Models\Layer::all());
});

Route::get('/maps', [MapController::class, 'index']);
Route::get('/maps/{id}', [MapController::class, 'view']);
Route::post('/maps/{id}/update', [MapController::class, 'update']);