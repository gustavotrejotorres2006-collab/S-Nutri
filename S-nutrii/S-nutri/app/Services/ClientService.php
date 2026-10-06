<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClientService
{
    /**
     * Obtiene todos los clientes.
     */
    public function getAll(): Collection
    {
        return User::where('role', 'cliente')
            ->where('active', true)
            ->with([
                'clinicalForm',
                'appointments',
            ])
            ->orderBy('name')
            ->get();
    }

    /**
     * Obtiene clientes paginados.
     */
    public function getPaginated(
        int $perPage = 10,
        ?string $search = null
    ): LengthAwarePaginator {
        $query = User::where('role', 'cliente')
            ->with([
                'clinicalForm',
            ])
            ->orderBy('name');

        if ($search !== null && trim($search) !== '') {

            $search = trim($search);

            $query->where(function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'phone',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        return $query
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Obtiene un cliente.
     */
    public function find(int $id): User
    {
        return User::where('role', 'cliente')
            ->with([
                'clinicalForm',
                'appointments' => function ($query) {
                    $query
                        ->orderByDesc('appointment_date')
                        ->orderByDesc('appointment_time');
                },
            ])
            ->findOrFail($id);
    }

    /**
     * Busca un cliente existente por correo o teléfono.
     *
     * Solamente se consideran registros con rol cliente para evitar
     * modificar accidentalmente la cuenta del nutriólogo.
     */
    public function findByContact(
        ?string $email,
        ?string $phone
    ): ?User {
        $query = User::where('role', 'cliente');

        if ($email) {
            $client = (clone $query)
                ->where('email', $email)
                ->first();

            if ($client) {
                return $client;
            }
        }

        if ($phone) {
            return $query
                ->where('phone', $phone)
                ->first();
        }

        return null;
    }

    /**
     * Crea un cliente.
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'role' => 'cliente',
                'password' => null,
                'active' => true,
            ]);
        });
    }

    /**
     * Actualiza un cliente.
     */
    public function update(
        User $client,
        array $data
    ): User {
        return DB::transaction(function () use (
            $client,
            $data
        ) {

            $client->update([
                'name' => $data['name'] ?? $client->name,
                'email' => $data['email'] ?? $client->email,
                'phone' => $data['phone'] ?? $client->phone,
                'active' => $data['active'] ?? $client->active,
            ]);

            return $client->fresh([
                'clinicalForm',
            ]);
        });
    }

    /**
     * Desactiva un cliente.
     *
     * No eliminamos físicamente al cliente.
     */
    public function deactivate(User $client): User
    {
        $client->update([
            'active' => false,
        ]);

        return $client->fresh();
    }

    /**
     * Reactiva un cliente.
     */
    public function activate(User $client): User
    {
        $client->update([
            'active' => true,
        ]);

        return $client->fresh();
    }

    /**
     * Cuenta clientes activos.
     */
    public function countActive(): int
    {
        return User::where('role', 'cliente')
            ->where('active', true)
            ->count();
    }

    /**
     * Busca clientes activos.
     */
    public function search(string $term): Collection
    {
        $term = trim($term);

        return User::where('role', 'cliente')
            ->where('active', true)
            ->where(function ($query) use ($term) {

                $query->where(
                    'name',
                    'like',
                    '%' . $term . '%'
                )
                ->orWhere(
                    'phone',
                    'like',
                    '%' . $term . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $term . '%'
                );
            })
            ->orderBy('name')
            ->get();
    }
}