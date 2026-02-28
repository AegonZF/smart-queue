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
    ];

    protected function casts(): array
    {
        return [
            'current_turn' => 'integer',
            'active_clients' => 'integer',
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
     * Genera el siguiente número de turno (0-999, rotativo).
     */
    public function getNextTurnNumber(): string
    {
        $next = $this->current_turn + 1;

        if ($next > 999) {
            $next = 1;
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
     * Obtiene el counter con menos carga para un tipo dado.
     */
    public static function leastLoaded(string $type): ?self
    {
        return static::where('type', $type)
            ->orderBy('active_clients', 'asc')
            ->first();
    }
}
