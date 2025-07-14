<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/user-registered/{documento}', [MainController::class, 'user_registered'])->name('user.registered');
Route::post('/register', [MainController::class, 'register'])->name('register');
Route::post('/factura-register', [MainController::class, 'factura_register'])->name('factura-register');

// VALIDATIONS
Route::post('/tel-validation', [MainController::class, 'telValidation'])->name('tel-validation');
Route::post('/doc-validation', [MainController::class, 'docValidation'])->name('doc-validation');
Route::post('/email-validation', [MainController::class, 'emailValidation'])->name('email-validation');
