<?php

use App\Domain\Journals\Controllers\JournalsController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->group(function() {
    Route::get('/journals',[JournalsController::class, 'index']);
    Route::post('/journals',[JournalsController::class, 'create']);
    Route::get('/journal/{id}',[JournalsController::class, 'show']);
//});
