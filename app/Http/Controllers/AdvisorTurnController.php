<?php

namespace App\Http\Controllers;

use App\Models\ServiceCounter;
use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvisorTurnController extends Controller
{
    /**
     * Completa el turno actual (Siguiente Turno).
     */
    public function next(Request $request)
    {
        $turn = $this->getCurrentTurn();

        if (! $turn) {
            return back()->with('error', 'No hay turnos activos para avanzar.');
        }

        DB::transaction(function () use ($turn) {
            $turn->update(['status' => 'completed']);

            $counter = ServiceCounter::lockForUpdate()->find($turn->service_counter_id);
            if ($counter && $counter->active_clients > 0) {
                $counter->decrement('active_clients');
            }
        });

        return back()->with('success', 'Turno ' . $turn->turn_number . ' completado.');
    }

    /**
     * Marca el turno actual como expirado.
     */
    public function expire(Request $request)
    {
        $turn = $this->getCurrentTurn();

        if (! $turn) {
            return back()->with('error', 'No hay turnos activos para marcar como expirado.');
        }

        DB::transaction(function () use ($turn) {
            $turn->update(['status' => 'expired']);

            $counter = ServiceCounter::lockForUpdate()->find($turn->service_counter_id);
            if ($counter && $counter->active_clients > 0) {
                $counter->decrement('active_clients');
            }
        });

        return back()->with('success', 'Turno ' . $turn->turn_number . ' marcado como expirado.');
    }

    /**
     * Obtiene el primer turno en espera (FIFO).
     */
    private function getCurrentTurn(): ?Turn
    {
        return Turn::where('status', 'waiting')
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
