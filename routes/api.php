<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/weather/{city}', [WeatherController::class, 'getWeather'] )->middleware('auth:sanctum');
Route::post('/register',[AuthController::class, 'register']);