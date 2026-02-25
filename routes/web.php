<?php

use App\Http\Controllers\AccountUnlockController;
use App\Http\Controllers\Admin\RegisterEmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/account/unlock/{token}', [AccountUnlockController::class, 'unlock'])
    ->name('account.unlock');

Route::post('/logout/inactivity', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('inactivity', true);
})->middleware('auth')->name('logout.inactivity');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Rutas del administrador
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/registro-empleado', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('admin.register-employee');
    })->name('admin.register-employee');

    Route::post('/registro-empleado', [RegisterEmployeeController::class, 'store'])
        ->name('admin.register-employee.store');
});


require __DIR__.'/settings.php';