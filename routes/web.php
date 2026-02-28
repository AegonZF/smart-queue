<?php

use App\Http\Controllers\AccountUnlockController;
use App\Http\Controllers\Admin\RegisterEmployeeController;
use App\Http\Controllers\Admin\TurnManagementController;
use App\Http\Controllers\AdvisorTurnController;
use App\Http\Controllers\TurnController;
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

// =========================================================
// RUTAS DE ADMINISTRADOR
// =========================================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('admin.dashboard', [
            'ventanillas' => \App\Models\ServiceCounter::where('type', 'ventanilla')->get(),
            'asesores' => \App\Models\ServiceCounter::where('type', 'asesor')->get(),
            'isActive' => \App\Models\SystemSetting::isTurnGenerationActive(),
        ]);
    })->name('admin.dashboard');

    Route::get('/registro-empleado', [RegisterEmployeeController::class, 'index'])
        ->name('admin.register-employee');

    Route::post('/registro-empleado', [RegisterEmployeeController::class, 'store'])
        ->name('admin.register-employee.store');

    Route::delete('/registro-empleado/{id}', [RegisterEmployeeController::class, 'destroy'])
        ->name('admin.register-employee.destroy');

    Route::post('/registro-empleado/{id}/asignar-area', [RegisterEmployeeController::class, 'asignarArea'])
        ->name('admin.register-employee.asignar-area');

    Route::post('/turnos/toggle', [TurnManagementController::class, 'toggle'])
        ->name('admin.turns.toggle');
});

// =========================================================
// FLUJO DE NOVABANK (CLIENTES) - Con autenticación
// =========================================================
Route::middleware(['auth'])->prefix('nova')->group(function () {
    
    // 1. Pantalla principal: Selección de trámite
    Route::view('/', 'client.index')->name('nova.index');

    // Sub-flujo: Ventanilla
    Route::prefix('ventanilla')->group(function () {
        Route::view('/tramite', 'client.ventanilla.tramite-ventanilla')->name('nova.ventanilla.tramite');
        Route::view('/generar', 'client.ventanilla.generar-turno')->name('nova.ventanilla.generar');
        Route::get('/asignado', function () {
            $turn = \App\Models\Turn::getUserActiveTurn(auth()->id());
            if (! $turn) {
                return redirect()->route('nova.index')->with('error', 'No tienes un turno activo.');
            }
            return view('client.ventanilla.turno-asignado', compact('turn'));
        })->name('nova.ventanilla.asignado');
    });

    // Sub-flujo: Asesor (Cliente esperando)
    Route::prefix('asesor-cliente')->group(function () {
        Route::view('/generar', 'client.asesor.generar-turno')->name('nova.asesor.generar');
        Route::get('/asignado', function () {
            $turn = \App\Models\Turn::getUserActiveTurn(auth()->id());
            if (! $turn) {
                return redirect()->route('nova.index')->with('error', 'No tienes un turno activo.');
            }
            return view('client.asesor.turno-asignado', compact('turn'));
        })->name('nova.asesor.asignado');
    });

    // Generación y cancelación de turnos
    Route::post('/turno/generar', [TurnController::class, 'store'])->name('nova.turno.store');
    Route::post('/turno/cancelar', [TurnController::class, 'cancel'])->name('nova.turno.cancel');
    Route::get('/turno/activo', [TurnController::class, 'activeTurn'])->name('nova.turno.active');
});

// =========================================================
// FLUJO DEL TRABAJADOR (ASESOR)
// =========================================================
Route::middleware(['auth'])->prefix('gestion-turnos')->group(function () {
    Route::get('/', function () {
        $counters = \App\Models\ServiceCounter::all();
        $nextTurn = \App\Models\Turn::where('status', 'waiting')
            ->orderBy('created_at', 'asc')
            ->with('serviceCounter')
            ->first();
        $waitingCount = \App\Models\Turn::where('status', 'waiting')->count();
        return view('advisor.index', compact('counters', 'nextTurn', 'waitingCount'));
    })->name('advisor.dashboard');

    Route::post('/siguiente', [AdvisorTurnController::class, 'next'])->name('advisor.turn.next');
    Route::post('/expirado', [AdvisorTurnController::class, 'expire'])->name('advisor.turn.expire');
});

// =========================================================
// RUTAS DE PERFIL
// =========================================================
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

    // Procesamiento de formularios
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