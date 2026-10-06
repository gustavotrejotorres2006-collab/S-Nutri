<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService $clientService
    ) {
    }

    /**
     * Listado de clientes.
     */
    public function index(Request $request): View
    {
        $clients = $this->clientService->getPaginated(
            perPage: 10,
            search: $request->input('search')
        );

        return view('admin.clients.index', [
            'clients' => $clients,
            'search' => $request->input('search'),
        ]);
    }

    /**
     * Información completa del cliente.
     */
    public function show(User $client): View
    {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $client = $this->clientService->find(
            $client->id
        );

        return view('admin.clients.show', [
            'client' => $client,
        ]);
    }

    /**
     * Formulario para crear cliente.
     */
    public function create(): View
    {
        return view('admin.clients.create');
    }

    /**
     * Crear cliente.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        $client = $this->clientService->create(
            $data
        );

        return redirect()
            ->route(
                'admin.clients.show',
                $client
            )
            ->with(
                'success',
                'Cliente creado correctamente.'
            );
    }

    /**
     * Formulario para editar cliente.
     */
    public function edit(User $client): View
    {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        return view('admin.clients.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Actualiza un cliente.
     */
    public function update(
        Request $request,
        User $client
    ): RedirectResponse {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($client->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'active' => [
                'required',
                'boolean',
            ],
        ]);

        $this->clientService->update(
            $client,
            $data
        );

        return redirect()
            ->route(
                'admin.clients.show',
                $client
            )
            ->with(
                'success',
                'Cliente actualizado correctamente.'
            );
    }

    /**
     * Desactiva un cliente.
     */
    public function deactivate(
        User $client
    ): RedirectResponse {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $this->clientService->deactivate(
            $client
        );

        return back()->with(
            'success',
            'Cliente desactivado correctamente.'
        );
    }

    /**
     * Reactiva un cliente.
     */
    public function activate(
        User $client
    ): RedirectResponse {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $this->clientService->activate(
            $client
        );

        return back()->with(
            'success',
            'Cliente activado correctamente.'
        );
    }
}