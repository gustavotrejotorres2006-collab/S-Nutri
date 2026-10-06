<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ClinicalFormService;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClinicalFormController extends Controller
{
    public function __construct(
        private readonly ClinicalFormService $clinicalFormService,
        private readonly ClientService $clientService
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | ADMINISTRACIÓN
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra el formulario clínico de un cliente.
     */
    public function show(User $client): View
    {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $clinicalForm = $this->clinicalFormService
            ->getByClient($client);

        return view(
            'admin.clinical-forms.show',
            [
                'client' => $client,
                'clinicalForm' => $clinicalForm,
            ]
        );
    }

    /**
     * Formulario de edición clínica.
     */
    public function edit(User $client): View
    {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $clinicalForm = $this->clinicalFormService
            ->getByClient($client);

        return view(
            'admin.clinical-forms.edit',
            [
                'client' => $client,
                'clinicalForm' => $clinicalForm,
            ]
        );
    }

    /**
     * Actualiza formulario clínico.
     */
    public function update(
        Request $request,
        User $client
    ): RedirectResponse {
        abort_unless(
            $client->role === 'cliente',
            404
        );

        $data = $this->validateClinicalForm(
            $request,
            false
        );

        $clinicalForm = $this->clinicalFormService
            ->getByClient($client);

        if (!$clinicalForm) {

            $this->clinicalFormService->create(
                $client,
                $data
            );
        } else {

            $this->clinicalFormService->update(
                $clinicalForm,
                $data
            );
        }

        return redirect()
            ->route(
                'admin.clinical-forms.show',
                $client
            )
            ->with(
                'success',
                'El formulario clínico fue actualizado.'
            );
    }

    /**
     * Validación centralizada del formulario clínico.
     */
    private function validateClinicalForm(
        Request $request,
        bool $includeClientData = true
    ): array {
        $rules = [
            'birth_date' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'nullable',
                'string',
                'max:30',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'weight' => [
                'nullable',
                'numeric',
                'min:0',
                'max:500',
            ],

            'height' => [
                'nullable',
                'numeric',
                'min:0',
                'max:3',
            ],

            'body_fat_percentage' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'medical_history' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'current_conditions' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'allergies' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'medications' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'supplements' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'family_history' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'eating_habits' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'physical_activity' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'sleep_hours' => [
                'nullable',
                'string',
                'max:50',
            ],

            'water_consumption' => [
                'nullable',
                'string',
                'max:100',
            ],

            'nutritional_goal' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'additional_information' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Datos del cliente solamente para formulario público
        |--------------------------------------------------------------------------
        */

        if ($includeClientData) {

            $rules['name'] = [
                'required',
                'string',
                'min:3',
                'max:255',
            ];

            $rules['email'] = [
                'required',
                'email',
                'max:255',
            ];

            $rules['phone'] = [
                'required',
                'string',
                'max:20',
            ];
        }

        return $request->validate(
            $rules,
            [
                'name.required' =>
                    'El nombre es obligatorio.',

                'email.required' =>
                    'El correo es obligatorio.',

                'email.email' =>
                    'Ingresa un correo válido.',

                'phone.required' =>
                    'El teléfono es obligatorio.',

                'weight.numeric' =>
                    'El peso debe ser un valor numérico.',

                'height.numeric' =>
                    'La estatura debe ser un valor numérico.',

                'body_fat_percentage.numeric' =>
                    'El porcentaje de grasa debe ser numérico.',
            ]
        );
    }
}