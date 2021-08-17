<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/clients', [ClientController::class, 'post']);
Route::get('/clients', [ClientController::class, 'list']);
Route::get('/clients/{id}', [ClientController::class, 'get']);
Route::patch('/clients/{id}', [ClientController::class, 'patch']);
Route::delete('/clients/{id}', [ClientController::class, 'delete']);
