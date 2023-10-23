<?php

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CompanyController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/companies/{company}', [CompanyController::class, 'index']);
    Route::get('/clients/{client}', [ClientController::class, 'index']);
    Route::get('/client_companies/{client}', [ClientController::class, 'showClientCompanies']);
});