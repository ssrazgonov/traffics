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

Route::get('/', [\App\Http\Controllers\Controller::class, 'main']);

Route::get('/dashboard', [\App\Http\Controllers\Controller::class, 'dashboard']);

Route::post('/appeal/create', [\App\Http\Controllers\Controller::class, 'createAppeal'])->name('appeal.create');

Route::get('/appeal/backlog', [\App\Http\Controllers\Controller::class, 'getBacklog']);

Route::get('/appeal/worker', [\App\Http\Controllers\Controller::class, 'getWorker']);

Route::get('/appeal/edit/{id}', [\App\Http\Controllers\Controller::class, 'edit']);

Route::get('/appeal/view', [\App\Http\Controllers\Controller::class, 'view']);
