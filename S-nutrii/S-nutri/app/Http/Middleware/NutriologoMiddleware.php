<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NutriologoMiddleware
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Comprobar autenticación
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Debes iniciar sesión para acceder al panel.');
        }

        /*
        |--------------------------------------------------------------------------
        | Comprobar que sea nutriólogo
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'nutriologo') {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'No tienes permisos para acceder a esta sección.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Comprobar que la cuenta esté activa
        |--------------------------------------------------------------------------
        */

        if (!auth()->user()->active) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Tu cuenta se encuentra desactivada.'
                );
        }

        return $next($request);
    }
}