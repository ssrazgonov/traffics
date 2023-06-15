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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard']);

    Route::post('/dashboard/appeals/create', [\App\Http\Controllers\AppealController::class, 'createAppeal'])->name('appeal.create');

    Route::get('/dashboard/appeals/backlog', [\App\Http\Controllers\AppealController::class, 'getInBacklog'])->name('appeals.log');
    Route::get('/dashboard/appeals/works', [\App\Http\Controllers\AppealController::class, 'getInWorks'])->name('appeals.works');
    Route::get('/dashboard/appeals/to-work/{id}', [\App\Http\Controllers\AppealController::class, 'toWork'])->name('appeals.to-work');
    Route::get('/dashboard/appeals/awaiting', [\App\Http\Controllers\AppealController::class, 'getInAwaiting'])->name('appeals.awaiting');
    Route::get('/dashboard/appeals/edit/{id}', [\App\Http\Controllers\AppealController::class, 'edit'])->name('appeals.edit');
    Route::get('/dashboard/appeals/view/{id}', [\App\Http\Controllers\AppealController::class, 'view'])->name('appeals.view');
    Route::get('/dashboard/appeals/returned', [\App\Http\Controllers\AppealController::class, 'getReturned'])->name('appeals.returned');
    Route::post('/dashboard/appeals/operator/save', [\App\Http\Controllers\OperatorController::class, 'saveAppeal'])->name('appeals.operator_save');

    Route::post('/dashboard/appeals/operator/sendToEngineer/{id}', [\App\Http\Controllers\OperatorController::class, 'sendToEngineer'])->name('appeals.sendToEngineer');
    Route::post('/dashboard/appeals/operator/close/{id}', [\App\Http\Controllers\OperatorController::class, 'close'])->name('appeals.close');

    Route::get('/dashboard/appeals/engineer/edit/{id}', [\App\Http\Controllers\AppealController::class, 'edit'])->name('appeals.edit');
    Route::post('/dashboard/appeals/engineer/sendToOperator/{id}', [\App\Http\Controllers\EngineerController::class, 'sendToOperator'])->name('appeals.sendToOperator');

    Route::get('/dashboard/operators/list', [\App\Http\Controllers\OperatorController::class, 'index'])->name('operators.list');
    Route::get('/dashboard/operators/edit/{id}', [\App\Http\Controllers\OperatorController::class, 'edit'])->name('operators.edit');;

    Route::get('/dashboard/engineers/list', [\App\Http\Controllers\EngineerController::class, 'index'])->name('engineers.list');
    Route::get('/dashboard/engineers/edit/{id}', [\App\Http\Controllers\EngineerController::class, 'edit'])->name('engineers.edit');;

    Route::get('/dashboard/traffic-lights/list', [\App\Http\Controllers\TrafficLightController::class, 'index'])->name('traffic_lights.list');
    Route::get('/dashboard/traffic-lights/view/{id}', [\App\Http\Controllers\TrafficLightController::class, 'view']);
    Route::get('/dashboard/traffic-lights/edit/{id}', [\App\Http\Controllers\TrafficLightController::class, 'edit'])->name('traffic_lights.edit');
});




Route::get('/auth/login', [\App\Http\Controllers\AuthController::class, 'loginPage'])->name('login');
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth-login');
Route::get('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
