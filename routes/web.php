<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('index');
});


Route::get('/countries', [CountryController::class, 'index']); // Fetch all countries
Route::get('/countries/{id}', [CountryController::class, 'show']); // Fetch a specific country by ID
Route::post('/countries', [CountryController::class, 'store']); // Create a new country
Route::put('/countries/{id}', [CountryController::class, 'update']); // Update a specific country by ID
Route::delete('/countries/{id}', [CountryController::class, 'destroy']); // Delete a specific country by ID
