<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turn extends Model
{
    protected $fillable = [
        'user_id',
        'service_counter_id',
        'turn_number',
        'service_type',
        'tramite',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceCounter(): BelongsTo
    {
        return $this->belongsTo(ServiceCounter::class);
    }

    /**
     * Verifica si el usuario ya tiene un turno activo.
     */
    public static function userHasActiveTurn(int $userId): bool
    {
        return static::where('user_id', $userId)
            ->whereIn('status', ['waiting', 'in_progress'])
            ->exists();
    }

    /**
     * Obtiene el turno activo del usuario.
     */
    public static function getUserActiveTurn(int $userId): ?self
    {
        return static::where('user_id', $userId)
            ->whereIn('status', ['waiting', 'in_progress'])
            ->with('serviceCounter')
            ->first();
    }
}
