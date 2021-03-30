<?php

use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\FahrzeugeController;
use App\Http\Controllers\HelferController;
use App\Http\Controllers\LagerController;
use App\Http\Controllers\ProtokolleController;
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

    //Lager

    Route::get('/lager', [LagerController::class, 'index'])->name('lager');

    Route::get('/lager/create', [LagerController::class, 'create'])->name('lager.create');

    Route::post('/lager', [LagerController::class, 'store'])->name('lager.store');

    Route::get('/lager/{lager}/edit', [LagerController::class, 'edit'])->name('lager.edit');

    Route::put('/lager/{lager}', [LagerController::class, 'update'])->name('lager.update');

    Route::delete('/lager/{lager}', [LagerController::class, 'destroy'])->name('lager.destroy');

    Route::get('/sanlager/notfallzugriff', function (){
        return Inertia::render('Lager/Notfallzugriff');
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
    Route::get('/helfer', [HelferController::class, 'index'])->name('helfer');

    Route::get('/helfer/create', [HelferController::class, 'create'])->name('helfer.create');

    Route::post('/helfer', [HelferController::class, 'store'])->name('helfer.store');

    Route::get('/helfer/{user}/edit', [HelferController::class, 'edit'])->name('helfer.edit');

    Route::put('/helfer/{user}', [HelferController::class, 'update'])->name('helfer.update');

    Route::delete('/helfer/{user}', [HelferController::class, 'destroy'])->name('helfer.destroy');

    //Fahrzeuge
    Route::get('/fahrzeuge', [FahrzeugeController::class, 'index'])->name('fahrzeuge');

    Route::get('/fahrzeuge/create', [FahrzeugeController::class, 'create'])->name('fahrzeuge.create');

    Route::post('/fahrzeuge', [FahrzeugeController::class, 'store'])->name('fahrzeuge.store');

    Route::get('/fahrzeuge/{fahrzeuge}/edit', [FahrzeugeController::class, 'edit'])->name('fahrzeuge.edit');

    Route::put('fahrzeuge/{fahrzeuge}', [FahrzeugeController::class, 'update'])->name('fahrzeuge.update');

    Route::delete('fahrzeuge/{fahrzeuge}', [FahrzeugeController::class, 'destroy'])->name('fahrzeuge.destroy');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
