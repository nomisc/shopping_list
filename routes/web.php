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

Route::redirect('/', '/list');

Route::redirect('dashboard', '/list');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('shopping-list');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('list','shopping-list')
    ->middleware(['auth'])
    ->name('shopping-list');


Route::view('export','export');

Route::view('import','import');

require __DIR__.'/auth.php';
