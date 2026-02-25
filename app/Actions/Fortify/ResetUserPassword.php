<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ], [
            'password.min' => 'La contraseña debe tener entre 8 y 10 caracteres.',
            'password.max' => 'La contraseña debe tener entre 8 y 10 caracteres.',
            'password.regex' => 'La contraseña debe contener letras y números (alfanumérica).',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ])->validate();

        $user->forceFill([
            'password' => $input['password'],
            'failed_login_attempts' => 0,
            'is_blocked' => false,
            'unlock_token' => null,
        ])->save();
    }
}
