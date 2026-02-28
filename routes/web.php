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

// =========================================================
// RUTAS TEMPORALES, Hay que eliminarlas despues
// =========================================================

// --- FLUJO DE NOVABANK (CLIENTES) ---
Route::prefix('nova')->group(function () {
    
    // 1. Pantalla principal: Selección de trámite
    Route::view('/', 'client.index')->name('nova.index');

    // Sub-flujo: Ventanilla
    Route::prefix('ventanilla')->group(function () {
        Route::view('/tramite', 'client.ventanilla.tramite-ventanilla')->name('nova.ventanilla.tramite');
        Route::view('/generar', 'client.ventanilla.generar-turno')->name('nova.ventanilla.generar');
        Route::view('/asignado', 'client.ventanilla.turno-asignado')->name('nova.ventanilla.asignado');
    });

    // Sub-flujo: Asesor (Cliente esperando)
    Route::prefix('asesor-cliente')->group(function () {
        Route::view('/generar', 'client.asesor.generar-turno')->name('nova.asesor.generar');
        Route::view('/asignado', 'client.asesor.turno-asignado')->name('nova.asesor.asignado');
    });
});

// --- FLUJO DEL TRABAJADOR (ASESOR) ---
Route::middleware(['auth'])->group(function () {
    Route::view('/gestion-turnos', 'advisor.index')->name('advisor.dashboard');
});
Route::get('/advisor', function () {
    return view('advisor.index');
});

// --- RUTAS DE PERFIL TEMPORALES ---
Route::middleware('auth')->group(function () {
    
    // Vistas
    Route::get('/perfil', function () {
        return view('client.profile.index');
    })->name('profile.edit');

    Route::get('/perfil/password', function () {
        return view('client.profile.password');
    })->name('profile.password');

    Route::get('/perfil/eliminar', function () {
        return view('client.profile.delete');
    })->name('profile.delete');

    // Procesamiento de formularios (Evita el error 500 Route Not Defined)
    Route::patch('/perfil', function () {
        return back();
    })->name('profile.update');

    Route::put('/perfil/password', function () {
        return back();
    })->name('password.update');

    Route::delete('/perfil/eliminar', function () {
        return back();
    })->name('profile.destroy');
});

require __DIR__.'/settings.php';