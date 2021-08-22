<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SmsProviderController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SmsController;
use App\Http\Middleware\AuthenticateClient;

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

Route::get('/sms/providers', [SmsProviderController::class, 'list']);

Route::post('/templates', [TemplateController::class, 'post'])->middleware(AuthenticateClient::class);
Route::get('/templates', [TemplateController::class, 'list'])->middleware(AuthenticateClient::class);
Route::get('/templates/{id}', [TemplateController::class, 'get'])->middleware(AuthenticateClient::class);
Route::patch('/templates/{id}', [TemplateController::class, 'patch'])->middleware(AuthenticateClient::class);
Route::delete('/templates/{id}', [TemplateController::class, 'delete'])->middleware(AuthenticateClient::class);

Route::post('/sms', [SmsController::class, 'post'])->middleware(AuthenticateClient::class);
Route::get('/sms', [SmsController::class, 'list'])->middleware(AuthenticateClient::class);
Route::get('/sms/{id}', [SmsController::class, 'get'])->middleware(AuthenticateClient::class);
