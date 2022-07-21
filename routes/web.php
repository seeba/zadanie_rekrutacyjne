<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/programmers/{days}', [App\Http\Controllers\ProgrammerController::class, 'index'])->name('programmer.index');
Route::get('/programmers/create', [App\Http\Controllers\ProgrammerController::class, 'create'])->name('programmer.create');
Route::post('/programmers/store', [App\Http\Controllers\ProgrammerController::class, 'store'])->name('programmer.store');
