<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\ApplicationController;

Route::get('/', [ApplicationController::class, 'index']);
Route::get('/folders/{id}', [FoldersController::class, 'getFolder']);
Route::post('/folders', [FoldersController::class, 'create']);
