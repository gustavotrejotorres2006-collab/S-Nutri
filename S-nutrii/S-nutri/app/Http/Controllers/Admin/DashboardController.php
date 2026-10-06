<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\ClientService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly ClientService $clientService
    ) {
    }

    /**
     * Dashboard principal del nutriólogo.
     */
    public function index(): View
    {
        $todayAppointments = $this->appointmentService->getToday();

        $upcomingAppointments = $this->appointmentService
            ->getUpcoming(5);

        $statistics = [
            'clients' => $this->clientService->countActive(),

            'appointments_today' => $this->appointmentService
                ->countToday(),

            'pending_appointments' => $this->appointmentService
                ->countByStatus('pending'),

            'confirmed_appointments' => $this->appointmentService
                ->countByStatus('confirmed'),

            'suspended_appointments' => $this->appointmentService
                ->countByStatus('suspended'),
        ];

        return view('admin.dashboard', [
            'statistics' => $statistics,
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
        ]);
    }
}