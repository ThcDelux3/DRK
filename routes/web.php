<?php

use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\ProtokolleController;
use App\Http\Controllers\SanlagerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function (){
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //Sanlager
    Route::get('/sanlager', function (){
        return Inertia::render('Sanlager/Sanlager');
    })->name('sanlager');

    Route::get('/sanlager/notfallzugriff', function (){
        return Inertia::render('Sanlager/Notfallzugriff');
    })->name('sanlager.notfallzugriff');

    Route::post('/sanlager/notfallzugriff', [SanlagerController::class, 'NotfallZugriff'])->name('sanlager.notfallzugriff.check.personalnummer');

    //Protokolle
    Route::get('/protokolle', function (){
        return Inertia::render('Protokolle/Protokolle');
    })->name('protokolle');

    Route::get('/protokolle/einsatzprotokoll', [ProtokolleController::class, 'index'])->name('protokolle.einsatzprotokoll');

    Route::post('/protokolle/pdf', [ProtokolleController::class, 'store'])->name('protokolle.store');

    Route::get('search', [AutoCompleteController::class, 'index'])->name('autocomplete');

    //Helfer
    Route::get('/helfer', function (){
        return Inertia::render('Helfer/Show');
    })->name('helfer');

    //Fahrzeuge
    Route::get('/fahrzeuge', function (){
        return Inertia::render('Fahrzeuge/Show');
    })->name('fahrzeuge');



});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
