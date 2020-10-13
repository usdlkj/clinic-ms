<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('patients', App\Http\Controllers\PatientController::class)->middleware('auth');
    Route::post('patients/storePatientVisit', [App\Http\Controllers\PatientController::class, 'storePatientVisit'])
        ->name('patients.storePatientVisit')
        ->middleware('auth');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::patch('users/{id}/verify', [App\Http\Controllers\UserController::class, 'verify'])->name('users.verify');

    // Route::resource('visits/{id}', App\Http\Controllers\VisitController::class);
    Route::get('visits/{id}', [App\Http\Controllers\VisitController::class, 'index'])->name('visits.index');
    Route::get('visits/{id}/create', [App\Http\Controllers\VisitController::class, 'create'])->name('visits.create');
    Route::post('visits/{id}/store', [App\Http\Controllers\VisitController::class, 'store'])->name('visits.store');
    Route::delete('visits/{id}/destroy', [App\Http\Controllers\VisitController::class, 'destroy'])->name('visits.destroy');
    Route::get('visits/{id}/show', [App\Http\Controllers\VisitController::class, 'show'])->name('visits.show');
    Route::get('visits/{id}/edit', [App\Http\Controllers\VisitController::class, 'edit'])->name('visits.edit');
    Route::patch('visits/{id}/update', [App\Http\Controllers\VisitController::class, 'update'])->name('visits.update');
});