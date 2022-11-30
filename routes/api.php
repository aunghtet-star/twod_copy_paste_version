<?php

use App\Http\Controllers\BrakeAmountController;
use App\Http\Controllers\NormalTwoController;
use App\Http\Controllers\NormalTwoOverviewController;
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


Route::controller(NormalTwoController::class)->group(function (){
    Route::post('/normal-two','normalTwo');
});

Route::controller(NormalTwoOverviewController::class)->group(function (){
    Route::get('/normal-two-overview','overview');
    Route::get('/normal-two-clean','clean');
});

Route::controller(BrakeAmountController::class)->group(function (){
    Route::get('/brake-amount','index');
    Route::post('/brake-amount/{id}','update');
});


