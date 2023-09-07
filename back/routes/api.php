<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\CryptoValuesController;
use App\Http\Controllers\API\CryptoWalletController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WalletController;
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
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class); //Les routes users.* de l'API
    Route::apiResource('cryptoValues', CryptoValuesController::class);
    Route::apiResource('wallet', WalletController::class);
    Route::apiResource('cryptoWallet', CryptoWalletController::class);

});
