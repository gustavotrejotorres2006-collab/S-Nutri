<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Intenta iniciar sesión como nutriólogo.
     */
    public function login(
        string $email,
        string $password,
        bool $remember = false
    ): bool {
        $credentials = [
            'email' => $email,
            'password' => $password,
            'role' => 'nutriologo',
            'active' => true,
        ];

        return Auth::attempt($credentials, $remember);
    }

    /**
     * Cierra la sesión actual.
     */
    public function logout(): void
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * Determina si existe una sesión activa.
     */
    public function isAuthenticated(): bool
    {
        return Auth::check();
    }

    /**
     * Obtiene el usuario autenticado.
     */
    public function user()
    {
        return Auth::user();
    }
}