<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\ApplicationController;

Route::get('/', [ApplicationController::class, 'index']);

// FOLDERS
Route::get('/subfolder/{id}', [ApplicationController::class, 'subFolder']);
Route::post('/folders', [FoldersController::class, 'create']);
Route::get('/folders/{id}', [FoldersController::class, 'getFolder']);
Route::put('/folders/{id}', [FoldersController::class, 'update']);
Route::delete('/folders/{id}', [FoldersController::class, 'delete']);

// FILES
Route::post('/files', [FilesController::class, 'addFile']);
Route::get('/files/{id}/download', [FilesController::class, 'downloadFile']);
Route::put('/files/{id}', [FilesController::class, 'update']);
Route::delete('/files/{id}', [FilesController::class, 'delete']);

