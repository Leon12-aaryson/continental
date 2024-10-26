<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return response()->json($request->user());
// });


Route::get('cities', [CityController::class, 'index']);
Route::get('cities/{id}', [CityController::class, 'show']);
Route::post('cities', [CityController::class, 'store']);
Route::put('cities/{id}', [CityController::class, 'update']);
Route::delete('cities/{id}', [CityController::class, 'destroy']);

Route::get('states', [StateController::class, 'index']);
Route::get('states/{id}', [StateController::class, 'show']);
Route::post('states', [StateController::class, 'store']);
Route::put('states/{id}', [StateController::class, 'update']);
Route::delete('states/{id}', [StateController::class, 'destroy']);

Route::get('/countries', [CountryController::class, 'index']); // Fetch all countries
Route::get('/countries/{id}', [CountryController::class, 'show']); // Fetch a specific country by ID
Route::post('/countries', [CountryController::class, 'store']); // Create a new country
Route::put('/countries/{id}', [CountryController::class, 'update']); // Update a specific country by ID
Route::delete('/countries/{id}', [CountryController::class, 'destroy']); // Delete a specific country by ID
