<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCounter extends Model
{
    protected $fillable = [
        'type',
        'identifier',
        'label',
        'current_turn',
        'active_clients',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'current_turn' => 'integer',
            'active_clients' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function turns(): HasMany
    {
        return $this->hasMany(Turn::class);
    }

    public function activeTurns(): HasMany
    {
        return $this->hasMany(Turn::class)->whereIn('status', ['waiting', 'in_progress']);
    }

    /**
     * Genera el siguiente número de turno (000-100, rotativo).
     */
    public function getNextTurnNumber(): string
    {
        $next = $this->current_turn + 1;

        if ($next > 100) {
            $next = 0;
        }

        $this->update(['current_turn' => $next]);

        return str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Resetea contadores al apagar generación de turnos.
     */
    public function resetCounter(): void
    {
        $this->update([
            'current_turn' => 0,
            'active_clients' => 0,
        ]);
    }

    /**
     * Obtiene el counter con menos carga para un tipo dado,
     * solo considerando counters que tengan un operador asignado.
     */
    public static function leastLoaded(string $type): ?self
    {
        // Solo counters que tengan un operador asignado (area_designada = label)
        $assignedLabels = \App\Models\User::where('role', 'operador')
            ->whereNotNull('area_designada')
            ->pluck('area_designada');

        return static::where('type', $type)
            ->where('is_active', true)
            ->whereIn('label', $assignedLabels)
            ->orderBy('active_clients', 'asc')
            ->first();
    }
}
