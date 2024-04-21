<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cities', [CitiesController::class, 'getCities'])->name('public.cities');

// API
Route::group(['prefix' => 'api'], function() {
    Route::get('/cities', [CitiesController::class, 'getCities'])->name('api-get-cities');
});
