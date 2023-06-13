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

Route::get('/', [\App\Http\Controllers\SiteController::class, 'main']);

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard']);

Route::post('/dashboard/appeals/create', [\App\Http\Controllers\AppealController::class, 'createAppeal'])->name('appeal.create');

Route::get('/dashboard/appeals/backlog', [\App\Http\Controllers\AppealController::class, 'getInBacklog'])->name('appeals.log');
Route::get('/dashboard/appeals/works', [\App\Http\Controllers\AppealController::class, 'getInWorks'])->name('appeals.works');
Route::get('/dashboard/appeals/edit/{id}', [\App\Http\Controllers\AppealController::class, 'edit'])->name('appeals.edit');
Route::get('/dashboard/appeals/view/{id}', [\App\Http\Controllers\AppealController::class, 'view'])->name('appeals.view');
Route::post('/dashboard/appeals/operator/save', [\App\Http\Controllers\OperatorController::class, 'saveAppeal'])->name('appeals.operator_save');

Route::get('/dashboard/operators/list', [\App\Http\Controllers\OperatorController::class, 'index'])->name('operators.list');
Route::get('/dashboard/operators/view/{id}', [\App\Http\Controllers\OperatorController::class, 'view']);
Route::get('/dashboard/operators/edit/{id}', [\App\Http\Controllers\OperatorController::class, 'edit']);

Route::get('/dashboard/engineers/list', [\App\Http\Controllers\EngineerController::class, 'index']);
Route::get('/dashboard/engineers/view/{id}', [\App\Http\Controllers\EngineerController::class, 'view']);
Route::get('/dashboard/engineers/edit/{id}', [\App\Http\Controllers\EngineerController::class, 'edit']);

Route::get('/dashboard/traffic-lights/list', [\App\Http\Controllers\TrafficLightController::class, 'index']);
Route::get('/dashboard/traffic-lights/view/{id}', [\App\Http\Controllers\TrafficLightController::class, 'view']);
Route::get('/dashboard/traffic-lights/edit/{id}', [\App\Http\Controllers\TrafficLightController::class, 'edit']);
