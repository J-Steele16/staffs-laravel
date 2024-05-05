<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('chirps', ChirpController::class)
        ->only(['index', 'store']);
    Route::post(
        '/chirps/{chirp}/addToFavourites',
        [ChirpController::class, 'addToFavourites']
    )->name('chirps.favourites.add');
    Route::post(
        '/chirps/{chirp}/removeFromFavourites',
        [ChirpController::class, 'removeFromFavourites']
    )->name('chirps.favourites.remove');
    Route::get(
        '/chirps/favourites',
        [ChirpController::class, 'favourites']
    )->name('chirps.favourites');
    Route::get(
        '/chirps/confirm',
        [ChirpController::class, 'confirm']
    )->name('chirps.confirm');
});   

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
