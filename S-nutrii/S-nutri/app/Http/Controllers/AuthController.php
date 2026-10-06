<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin(): View|RedirectResponse
    {
        if ($this->authService->isAuthenticated()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Procesa el inicio de sesión.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
            ],

            'remember' => [
                'nullable',
                'boolean',
            ],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $remember = $request->boolean('remember');

        if (!$this->authService->login(
            $credentials['email'],
            $credentials['password'],
            $remember
        )) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Las credenciales no son válidas.');
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('admin.dashboard'))
            ->with('success', 'Bienvenido al panel de S-Nutri.');
    }

    /**
     * Cierra la sesión.
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}