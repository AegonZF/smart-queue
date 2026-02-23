<?php

use App\Http\Controllers\AccountUnlockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/account/unlock/{token}', [AccountUnlockController::class, 'unlock'])
    ->name('account.unlock');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';