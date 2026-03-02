<?php

namespace App\Http\Controllers;

use App\Models\ServiceCounter;
use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvisorTurnController extends Controller
{
    /**
     * Resuelve el counter asignado al operador autenticado.
     */
    private function getAssignedCounter(): ?ServiceCounter
    {
        $label = optional(auth()->user())->area_designada;
        if (! $label) {
            return null;
        }

        return ServiceCounter::where('label', $label)->first();
    }

    /**
     * Devuelve el estado actual de la cola (para refresco del operador).
     */
    public function status(Request $request)
    {
        $counter = $this->getAssignedCounter();

        $nextTurn = null;
        $waitingCount = 0;

        if ($counter) {
            $nextTurn = Turn::where('status', 'waiting')
                ->where('service_counter_id', $counter->id)
                ->orderBy('created_at', 'asc')
                ->with('serviceCounter')
                ->first();

            $waitingCount = Turn::where('status', 'waiting')
                ->where('service_counter_id', $counter->id)
                ->count();
        }

        $userArea = optional(auth()->user()->fresh())->area_designada;

        if (! $nextTurn) {
            return response()->json([
                'has_next' => false,
                'waiting_count' => $waitingCount,
                'user_area' => $userArea,
            ]);
        }

        return response()->json([
            'has_next' => true,
            'waiting_count' => $waitingCount,
            'turn_number' => $nextTurn->turn_number,
            'counter_label' => optional($nextTurn->serviceCounter)->label,
            'tramite' => $nextTurn->tramite,
            'created_at' => optional($nextTurn->created_at)?->toIso8601String(),
            'user_area' => $userArea,
        ]);
    }

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

        return back()->with('success', 'Turno '.$turn->turn_number.' completado.');
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

        return back()->with('success', 'Turno '.$turn->turn_number.' marcado como expirado.');
    }

    /**
     * Obtiene el primer turno en espera (FIFO).
     */
    private function getCurrentTurn(): ?Turn
    {
        $counter = $this->getAssignedCounter();
        if (! $counter) {
            return null;
        }

        return Turn::where('status', 'waiting')
            ->where('service_counter_id', $counter->id)
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
