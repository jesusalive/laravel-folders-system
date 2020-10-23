<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoldersController;

Route::get('/', [FoldersController::class, 'index']);
