<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/design-reset', function (Request $request) {
    return view('pages.auth.reset-password', ['request' => $request]);
});

require __DIR__.'/settings.php';