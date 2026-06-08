<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/about', [AboutController::class, 'about'])->name('about');