<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly ClientService $clientService
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | PANEL ADMINISTRATIVO
    |--------------------------------------------------------------------------
    */

    /**
     * Listado de citas.
     */
    public function index(Request $request): View
    {
        $appointments = $this->appointmentService->getPaginated(
            perPage: 10,
            status: $request->input('status'),
            search: $request->input('search')
        );

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ]);
    }

    /**
     * Muestra una cita.
     */
    public function show(Appointment $appointment): View
    {
        $appointment = $this->appointmentService->find(
            $appointment->id
        );

        return view('admin.appointments.show', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Formulario para editar una cita.
     */
    public function edit(Appointment $appointment): View
    {
        $appointment = $this->appointmentService->find(
            $appointment->id
        );

        $clients = $this->clientService->getAll();

        return view('admin.appointments.edit', [
            'appointment' => $appointment,
            'clients' => $clients,
        ]);
    }

    /**
     * Actualiza una cita.
     */
    public function update(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {
        $data = $request->validate([
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where(
                        fn ($query) => $query
                            ->where('role', 'cliente')
                            ->where('active', true)
                    ),
            ],

            'appointment_date' => [
                'required',
                'date',
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

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'suspended',
                    'cancelled',
                ]),
            ],

            'status_notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Evitar conflicto de horario
        |--------------------------------------------------------------------------
        */

        if ($this->appointmentService->hasScheduleConflict(
            $data['appointment_date'],
            $data['appointment_time'],
            $appointment->id
        )) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ya existe otra cita en la fecha y hora seleccionadas.'
                );
        }

        $this->appointmentService->update(
            $appointment,
            $data
        );

        return redirect()
            ->route(
                'admin.appointments.index'
            )
            ->with(
                'success',
                'La cita fue actualizada correctamente.'
            );
    }

    /**
     * Confirma una cita.
     */
    public function confirm(
        Appointment $appointment
    ): RedirectResponse {
        $this->appointmentService->confirm(
            $appointment
        );

        return back()->with(
            'success',
            'La cita fue confirmada correctamente.'
        );
    }

    /**
     * Suspende una cita.
     */
    public function suspend(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {
        $data = $request->validate([
            'status_notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $this->appointmentService->suspend(
            $appointment,
            $data['status_notes'] ?? null
        );

        return back()->with(
            'success',
            'La cita fue suspendida correctamente.'
        );
    }

    /**
     * Cancela una cita.
     */
    public function cancel(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {
        $data = $request->validate([
            'status_notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $this->appointmentService->cancel(
            $appointment,
            $data['status_notes'] ?? null
        );

        return back()->with(
            'success',
            'La cita fue cancelada correctamente.'
        );
    }

    /**
     * Devuelve una cita a estado pendiente.
     */
    public function pending(
        Appointment $appointment
    ): RedirectResponse {
        $this->appointmentService->setPending(
            $appointment
        );

        return back()->with(
            'success',
            'La cita volvió a estado pendiente.'
        );
    }

    /**
     * Calendario administrativo.
     */
    public function calendar(): View
    {
        return view('admin.appointments.calendar');
    }

    /**
     * Datos del calendario.
     */
    public function calendarData(
        Request $request
    ): JsonResponse {
        $start = $request->input(
            'start',
            now()->startOfMonth()->format('Y-m-d')
        );

        $end = $request->input(
            'end',
            now()->endOfMonth()->format('Y-m-d')
        );

        $appointments = $this->appointmentService
            ->getBetweenDates($start, $end);

        $events = $appointments->map(
            function (Appointment $appointment) {

                return [
                    'id' => $appointment->id,

                    'title' => $appointment->user->name,

                    'start' => $appointment
                        ->appointment_date
                        ->format('Y-m-d')
                        . 'T'
                        . $appointment->appointment_time,

                    'status' => $appointment->status,

                    'status_label' =>
                        $appointment->status_label,

                    'client_id' =>
                        $appointment->user_id,

                    'client_name' =>
                        $appointment->user->name,

                    'phone' =>
                        $appointment->user->phone,

                    'reason' =>
                        $appointment->reason,

                    'url' => route(
                        'admin.appointments.show',
                        $appointment
                    ),
                ];
            }
        );

        return response()->json(
            $events->values()
        );
    }
}