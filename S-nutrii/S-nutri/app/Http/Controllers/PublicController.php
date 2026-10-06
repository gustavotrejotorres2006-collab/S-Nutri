<?php

namespace App\Http\Controllers;

use App\Services\AppointmentService;
use App\Services\ClientService;
use App\Services\ClinicalFormService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly ClientService $clientService,
        private readonly ClinicalFormService $clinicalFormService,
    ) {
    }

    /**
     * Página principal pública.
     */
    public function home(): View
    {
        return view('public.home');
    }

    /**
     * Formulario público para agendar una cita.
     */
    public function appointment(): View
    {
        return view('public.appointment');
    }

    /**
     * Guarda una solicitud de cita.
     */
    public function storeAppointment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'appointment_time' => [
                'required',
                'date_format:H:i',
            ],
            'reason' => [
                'nullable',
                'string',
                'max:255',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'appointment_date.required' => 'Selecciona una fecha.',
            'appointment_date.after_or_equal' => 'La fecha debe ser igual o posterior a hoy.',
            'appointment_time.required' => 'Selecciona una hora.',
            'appointment_time.date_format' => 'La hora seleccionada no tiene un formato válido.',
        ]);

        if ($this->appointmentService->hasScheduleConflict(
            $data['appointment_date'],
            $data['appointment_time']
        )) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'La fecha y hora seleccionadas ya están ocupadas. Elige otro horario.'
                );
        }

        $client = $this->clientService->findByContact(
            $data['email'],
            $data['phone']
        );

        if ($client) {
            $client = $this->clientService->update($client, [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'active' => true,
            ]);
        } else {
            $client = $this->clientService->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }

        $this->appointmentService->create([
            'user_id' => $client->id,
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'reason' => $data['reason'] ?? null,
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('public.appointment')
            ->with(
                'success',
                'Tu cita fue registrada correctamente. El nutriólogo revisará la solicitud.'
            );
    }

    /**
     * Formulario clínico público.
     */
    public function clinicalForm(): View
    {
        return view('public.clinical-form');
    }

    /**
     * Guarda el formulario clínico público.
     */
    public function storeClinicalForm(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
            'birth_date' => [
                'nullable',
                'date',
                'before:today',
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
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'weight.numeric' => 'El peso debe ser un valor numérico.',
            'height.numeric' => 'La estatura debe ser un valor numérico.',
            'body_fat_percentage.numeric' => 'El porcentaje de grasa debe ser numérico.',
        ]);

        $client = $this->clientService->findByContact(
            $data['email'],
            $data['phone']
        );

        if ($client) {
            $client = $this->clientService->update($client, [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'active' => true,
            ]);
        } else {
            $client = $this->clientService->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }

        $clinicalData = collect($data)
            ->except([
                'name',
                'email',
                'phone',
            ])
            ->all();

        $this->clinicalFormService->createOrUpdate(
            $client,
            $clinicalData
        );

        return redirect()
            ->route('public.clinical-form')
            ->with(
                'success',
                'Tu formulario clínico fue guardado correctamente.'
            );
    }
}
