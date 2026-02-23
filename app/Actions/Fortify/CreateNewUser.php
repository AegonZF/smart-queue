<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => $this->emailRules(),
            'password' => $this->passwordRules(),
        ], [
            'password.min' => 'La contraseña debe tener al menos 10 caracteres.',
            'password.regex' => 'La contraseña debe contener letras y números (alfanumérica).',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
        ])->validate();

        // Generar nombre a partir del email
        $name = explode('@', $input['email'])[0];

        return User::create([
            'name' => $name,
            'email' => $input['email'],
            'password' => $input['password'],
        ]);
    }
}
