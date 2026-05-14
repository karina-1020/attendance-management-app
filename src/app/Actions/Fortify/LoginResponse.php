<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        dd('LoginResponse');

        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect('/admin/attendance/list');
        }

        return redirect('/attendance');
    }
}