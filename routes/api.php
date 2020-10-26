<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('visits/diagnosis', [App\Http\Controllers\API\VisitAPIController::class, 'getDistinctDiagnosis'])->name('visits.diagnosis');
Route::get('visit/diagnosis/{id}', [App\Http\Controllers\API\VisitAPIController::class, 'getDiagnosisByVisitId'])->name('visit.diagnosis.by.id');