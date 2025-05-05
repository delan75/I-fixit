<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\DamagedPartController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Car routes
    Route::resource('cars', CarController::class);

    // Car Images routes
    Route::get('cars/{car}/images/create', [CarImageController::class, 'create'])->name('car_images.create');
    Route::post('cars/{car}/images', [CarImageController::class, 'store'])->name('car_images.store');
    Route::delete('cars/{car}/images/{carImage}', [CarImageController::class, 'destroy'])->name('car_images.destroy');

    // Damaged Parts routes
    Route::get('cars/{car}/damaged-parts/create', [DamagedPartController::class, 'create'])->name('damaged_parts.create');
    Route::post('cars/{car}/damaged-parts', [DamagedPartController::class, 'store'])->name('damaged_parts.store');
    Route::get('cars/{car}/damaged-parts/{damagedPart}/edit', [DamagedPartController::class, 'edit'])->name('damaged_parts.edit');
    Route::put('cars/{car}/damaged-parts/{damagedPart}', [DamagedPartController::class, 'update'])->name('damaged_parts.update');
    Route::delete('cars/{car}/damaged-parts/{damagedPart}', [DamagedPartController::class, 'destroy'])->name('damaged_parts.destroy');

    // Supplier routes
    Route::resource('suppliers', SupplierController::class);
});

require __DIR__.'/auth.php';
