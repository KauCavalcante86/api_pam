<?php

use App\Http\Controllers\UsuarioController;
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

Route::post('/CriarUser', [UsuarioController::class, 'storeApi']);
Route::post('/login', [UsuarioController::class, 'login']);
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
