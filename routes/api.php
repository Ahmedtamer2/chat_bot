<?php

use App\Http\Controllers\Api\IntegrationController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('chat', [IntegrationController::class, 'chat']);
    Route::get('fav/{id}', [IntegrationController::class, 'fav']);
    Route::get('/chat/{id}', [IntegrationController::class, 'getChatWithUsers']);
    // You can add more authenticated routes here
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

