<?php

namespace App\Services;

use App\Models\ClinicalForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClinicalFormService
{
    /**
     * Obtiene un formulario por cliente.
     */
    public function getByClient(User $client): ?ClinicalForm
    {
        return ClinicalForm::where(
            'user_id',
            $client->id
        )->first();
    }

    /**
     * Obtiene un formulario por ID.
     */
    public function find(int $id): ClinicalForm
    {
        return ClinicalForm::with('user')
            ->findOrFail($id);
    }

    /**
     * Crea un formulario clínico.
     */
    public function create(
        User $client,
        array $data
    ): ClinicalForm {
        return DB::transaction(function () use ($client, $data) {

            return ClinicalForm::create(
                array_merge(
                    $data,
                    [
                        'user_id' => $client->id,
                    ]
                )
            );
        });
    }

    /**
     * Actualiza el formulario clínico.
     */
    public function update(
        ClinicalForm $clinicalForm,
        array $data
    ): ClinicalForm {
        return DB::transaction(function () use (
            $clinicalForm,
            $data
        ) {

            $clinicalForm->update($data);

            return $clinicalForm->fresh([
                'user',
            ]);
        });
    }

    /**
     * Crea o actualiza el formulario del cliente.
     */
    public function createOrUpdate(
        User $client,
        array $data
    ): ClinicalForm {
        return DB::transaction(function () use ($client, $data) {

            $clinicalForm = ClinicalForm::updateOrCreate(
                [
                    'user_id' => $client->id,
                ],
                $data
            );

            return $clinicalForm->fresh([
                'user',
            ]);
        });
    }

    /**
     * Obtiene todos los formularios.
     */
    public function getAll(): Collection
    {
        return ClinicalForm::with('user')
            ->orderByDesc('updated_at')
            ->get();
    }

    /**
     * Comprueba si un cliente tiene formulario.
     */
    public function existsForClient(User $client): bool
    {
        return ClinicalForm::where(
            'user_id',
            $client->id
        )->exists();
    }
}