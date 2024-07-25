<?php

use App\Http\Controllers\Api\PuzzleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/check-word/{word}', [PuzzleController::class, 'checkWord']);
Route::post('/puzzile_info', [PuzzleController::class, 'puzzile_details_update']);
