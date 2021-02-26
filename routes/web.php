<?php

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

    Route::get('/sanlager/showcode', function (){
        return Inertia::render('Sanlager/showcode');
    })->name('sanlager.showcode');

/*    Route::get('/sanlager', [SanlagerController::class, 'index'])->name('sanlager');*/

    //Protokolle
    Route::get('/protokolle', function (){
        return Inertia::render('Protokolle/Protokolle');
    })->name('protokolle');

    Route::get('/protokolle/einsatzprotokoll', function (){
        return Inertia::render('Protokolle/Einsatzprotokoll');
    })->name('protokolle.einsatzprotokoll');

/*    Route::post('/protokolle/pdf', [ProtokolleController::class, 'store'])->name('protokolle.store');*/
    Route::post('/protokolle/pdf', [ProtokolleController::class, 'store'])->name('protokolle.store');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
