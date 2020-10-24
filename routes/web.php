<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\ApplicationController;

Route::get('/', [ApplicationController::class, 'index']);

// FOLDERS
Route::get('/subfolder/{id}', [ApplicationController::class, 'subFolder']);
Route::get('/folders/{id}', [FoldersController::class, 'getFolder']);
Route::post('/folders', [FoldersController::class, 'create']);

// FILES
Route::post('/files', [FilesController::class, 'addFile']);

