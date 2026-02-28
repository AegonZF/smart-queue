<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $home = '/admin/dashboard';
        } elseif ($user->isOperador()) {
            $home = '/gestion-turnos';
        } else {
            $home = '/nova';
        }

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->intended($home);
    }
}
