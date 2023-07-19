<?php

use App\Http\Controllers\Api\ApartmentController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')
        ->prefix('apartment')
        ->group(function(){
            Route::get('/', [ApartmentController::class, 'index' ]);
        });


        Route::get('/prova-api', function(){

            $user = [
                'name' => 'Ugo',
                'lastname' => 'de Ughi',
            ];
            $success = true;

            return response()->json(compact('success', 'user'));

        });
