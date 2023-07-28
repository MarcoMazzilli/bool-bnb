<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SearchController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
        ->prefix('apartment')
        ->group(function(){
            Route::get('/', [ApartmentController::class, 'index' ]);
            Route::get('/markers', [ApartmentController::class, 'getCoordinates' ]);
          });


Route::namespace('Api')
        ->prefix('find')
        ->group(function(){
            Route::post('/location',[SearchController::class, 'searchByRange']);
            Route::post('/services',[SearchController::class, 'searchByServices']); //questo dovera' ricevere un parametro
            Route::post('/perimeter',[SearchController::class, 'searchByPerimeter']); //questo dovera' ricevere un parametro
          });

Route::namespace('Api')
          ->prefix('contacts')
          ->group(function(){
            Route::post('/',[MessageController::class, 'store']);
          });



