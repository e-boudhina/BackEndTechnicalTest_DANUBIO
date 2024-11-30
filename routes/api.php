<?php

use App\Http\Controllers\RealEstateApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/realestate', [RealEstateApiController::class, 'index'])->name('realestate.index');

// Store a new real estate property
Route::post('/realestate', [RealEstateApiController::class, 'store']); // POST /api/realestate

// Update an existing real estate property
//Still under dev - after I added the point and radius columns, data retrieval effected the response.
Route::put('/realestate/{id}', [RealEstateApiController::class, 'update']); // PUT /api/realestate/{id}

// Delete an existing real estate property
Route::delete('/realestate/{id}', [RealEstateApiController::class, 'destroy']); // DELETE /api/realestate/{id}

Route::get('/realestate/search', [RealEstateApiController::class, 'search']); // Search real estates
Route::get('/realestate/searchByLocationAndRadius', [RealEstateApiController::class, 'searchByLocationAndRadius']); // Search real estates



