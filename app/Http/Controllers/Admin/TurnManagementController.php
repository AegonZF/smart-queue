<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCounter;
use App\Models\SystemSetting;
use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnManagementController extends Controller
{
    /**
     * Toggle de encendido/apagado de generación de turnos.
     */
    public function toggle(Request $request)
    {
        $isActive = SystemSetting::isTurnGenerationActive();

        if ($isActive) {
            // APAGAR: Cancelar turnos activos y resetear contadores
            DB::transaction(function () {
                // Cancelar todos los turnos activos
                Turn::whereIn('status', ['waiting', 'in_progress'])
                    ->update(['status' => 'cancelled']);

                // Resetear todos los contadores
                ServiceCounter::query()->update([
                    'current_turn' => 0,
                    'active_clients' => 0,
                ]);

                SystemSetting::setValue('turn_generation_active', 'false');
            });

            return back()->with('success', 'Generación de turnos desactivada. Contadores reseteados.');
        }

        // ENCENDER: Verificar que existan los counters, si no, crearlos
        $this->ensureCountersExist();

        SystemSetting::setValue('turn_generation_active', 'true');

        return back()->with('success', 'Generación de turnos activada.');
    }

    /**
     * Asegura que los service counters existan en la base de datos.
     */
    private function ensureCountersExist(): void
    {
        $ventanillas = ['A', 'B', 'C'];
        foreach ($ventanillas as $id) {
            ServiceCounter::firstOrCreate(
                ['type' => 'ventanilla', 'identifier' => $id],
                [
                    'label' => 'Ventanilla ' . $id,
                    'current_turn' => 0,
                    'active_clients' => 0,
                ]
            );
        }

        for ($i = 1; $i <= 4; $i++) {
            ServiceCounter::firstOrCreate(
                ['type' => 'asesor', 'identifier' => (string) $i],
                [
                    'label' => 'Asesor ' . $i,
                    'current_turn' => 0,
                    'active_clients' => 0,
                ]
            );
        }
    }
}
