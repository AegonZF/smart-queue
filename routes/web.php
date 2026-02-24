<?php

use App\Http\Controllers\AccountUnlockController;
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


// vista temporal del administrador
Route::get('/admin/preview', function () {
    return view('admin.dashboard');
});
//vista temporal para alta empleados
Route::get('/admin/registro-empleado', function () {
    return view('admin.register-employee');
});


require __DIR__.'/settings.php';