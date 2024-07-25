<?php

use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PuzzleController;
use App\Http\Controllers\LoginController;

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




Route::group(['middleware' => 'user_auth'], function () {
    Route::get('/', [PuzzleController::class, 'game_list'])->name('home');
    Route::post('/check-word', [PuzzleController::class, 'checkWord'])->name('check-word');
    Route::post('/puzzile_info', [PuzzleController::class, 'puzzile_details_update'])->name('puzzile_info');;
    Route::get('/puzzile-game', [PuzzleController::class, 'game_list']);
    Route::get('/puzzile-score', [PuzzleController::class, 'puzzileScore'])->name('puzzile-score');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('do_login', [LoginController::class, 'do_login'])->name('do_login');
