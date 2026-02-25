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

        if (!$user || $user->is_blocked || $user->isAdmin()) {
            return;
        }

        $user->increment('failed_login_attempts');

        if ($user->failed_login_attempts >= 3) {
            $token = Str::random(64);

            $user->update([
                'is_blocked' => true,
                'unlock_token' => $token,
            ]);

            $unlockUrl = url("/account/unlock/{$token}");
            $user->notify(new AccountBlockedNotification($unlockUrl));
        }
    }
}
