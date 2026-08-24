<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        // Redirect sesuai role pengguna
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dasbor');
        }

        if ($user->hasRole('petugas')) {
            return redirect()->route('petugas.dasbor');
        }

        return redirect()->route('peminjam.dasbor');
    }
}