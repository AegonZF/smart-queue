<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Obtiene el valor de un setting por su clave.
     */
    public static function getValue(string $key, string $default = ''): string
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Establece el valor de un setting.
     */
    public static function setValue(string $key, string $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Verifica si la generación de turnos está activa.
     */
    public static function isTurnGenerationActive(): bool
    {
        return static::getValue('turn_generation_active', 'false') === 'true';
    }
}
