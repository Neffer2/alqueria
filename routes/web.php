<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard__', function () {
    return view('backoffice.dashboard');
})->name('dashboard__');

Route::get('/facturas', function () {
    return view('backoffice.facturas');
})->name('facturas');

Route::get('/premios', function () {
    return view('backoffice.premios');
})->name('premios');
