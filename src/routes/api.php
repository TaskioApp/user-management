<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user-managements')->group(function () {
    Route::post('index', 'index');
    Route::get('{id}', 'get');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});
