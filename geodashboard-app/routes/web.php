<?php

use App\Http\Controllers\Api\v1\MapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MVTController;
use App\Http\Controllers\ReverseProxyController;
use App\Models\Layer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('app.index');
Auth::routes(['register' => false]);

// Social Login
Route::get('auth/login/google', [LoginController::class, 'redirectToProvider'])->name('app.auth.google');
Route::get('auth/login/google/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/layers', function () {
    return response()->json(Layer::all());
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => ["auth", "user"]], function($routes){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('app.dashboard.index');
});
Route::get('/dashboard/{id}', [DashboardController::class, 'view'])->name('app.dashboard.view');

Route::get('/maps', [MapController::class, 'index']);
Route::get('/maps/{id}', [MapController::class, 'view']);
Route::post('/maps/{id}/update', [MapController::class, 'update']);

Route::get('/mvt', [MVTController::class, 'mvt'])->middleware('throttle:1000,1');
Route::any('/tomcat-proxy{any?}', [ReverseProxyController::class, 'tomcatProxy'])->middleware('throttle:1000,1')->where('any', '.*');
