<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layers', function () {
    return response()->json(\App\Models\Layer::all());
});

Route::get('/maps', function () {
    return response()->json(\App\Models\Map::all());
});