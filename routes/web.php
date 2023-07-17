<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use GuzzleHttp\Middleware;
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

Route::get('/' , [PageController::class , 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
// Route::get('/visible', [DashboardController::class, 'visible'])->middleware(['auth','verified'])->name('visible');

Route::middleware(['auth','verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::resource('apartments', ApartmentController::class);
        // Route::resource('visible', ApartmentController::class, 'visible');
        Route::put('apartments/{apartment}/visible', [ApartmentController::class, 'visible'])
        ->name('apartments.visible');
    });

require __DIR__.'/auth.php';


Route::get('{any?}',function(){
    return view('guest.home');
})->where('any','.*')->name('home');
