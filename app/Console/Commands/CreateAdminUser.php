<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Crear o actualizar la cuenta de administrador desde las variables de entorno';

    public function handle(): int
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (!$email || !$password) {
            $this->error('Faltan las variables ADMIN_EMAIL y/o ADMIN_PASSWORD en el archivo .env');
            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrador',
                'password' => $password,
                'role' => 'administrador',
                'is_blocked' => false,
                'failed_login_attempts' => 0,
                'unlock_token' => null,
            ]
        );

        $this->info("Cuenta de administrador configurada: {$email}");
        return self::SUCCESS;
    }
}
