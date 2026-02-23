<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class ResetFailedLoginAttempts
{
    public function handle(Login $event): void
    {
        if ($event->user->failed_login_attempts > 0) {
            $event->user->update([
                'failed_login_attempts' => 0,
            ]);
        }
    }
}
