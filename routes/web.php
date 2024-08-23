<?php

use App\Http\Controllers\OperadorController;
use App\Http\Controllers\CronometroController;



Route::get('/', [OperadorController::class, 'index'])->name('index');

Route::post('/', [OperadorController::class, 'checkUser'])->name('check');

Route::get('/operador/create', [OperadorController::class, 'create'])->name('operador.create');
Route::post('/operador', [OperadorController::class, 'store'])->name('operador.store');

Route::get('/cronometro', [CronometroController::class, 'index'])->name('cronometro.index');
Route::post('/cronometro/start', [CronometroController::class, 'start'])->name('cronometro.start');
Route::post('/cronometro/stop', [CronometroController::class, 'stop'])->name('cronometro.stop');
