<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountUnlockController extends Controller
{
    public function unlock(string $token)
    {
        $user = User::where('unlock_token', $token)
            ->where('is_blocked', true)
            ->first();

        if (!$user) {
            return redirect()->route('login')->with('invalidUnlockLink', true);
        }

        $user->update([
            'is_blocked' => false,
            'failed_login_attempts' => 0,
            'unlock_token' => null,
        ]);

        return redirect()->route('login')->with('account_unlocked', true);
    }
}
