<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class ResetFailedLoginAttempts
{
    public function handle(Login $event): void
    {
        if ($event->user->failed_login_attempts > 0 || $event->user->first_failed_at) {
            $event->user->update([
                'failed_login_attempts' => 0,
                'first_failed_at' => null,
            ]);
        }
    }
}
