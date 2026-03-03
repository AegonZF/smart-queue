<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\AccountBlockedNotification;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Str;

class HandleFailedLogin
{
    public function handle(Failed $event): void
    {
        $user = User::where('email', $event->credentials['email'] ?? '')->first();

        if (! $user || $user->is_blocked || $user->isAdmin()) {
            return;
        }

        // Si ha pasado más de 1 hora desde el primer intento fallido, reiniciar contador
        if ($user->first_failed_at && $user->first_failed_at->diffInMinutes(now()) >= 60) {
            $user->update([
                'failed_login_attempts' => 0,
                'first_failed_at' => null,
            ]);
        }

        // Si es el primer intento fallido, registrar la hora
        if ($user->failed_login_attempts === 0) {
            $user->update(['first_failed_at' => now()]);
        }

        $user->increment('failed_login_attempts');

        if ($user->failed_login_attempts >= 3) {
            $token = Str::random(64);

            $user->update([
                'is_blocked' => true,
                'unlock_token' => $token,
                'first_failed_at' => null,
            ]);

            $unlockUrl = url("/account/unlock/{$token}");
            $user->notify(new AccountBlockedNotification($unlockUrl));
        }
    }
}
