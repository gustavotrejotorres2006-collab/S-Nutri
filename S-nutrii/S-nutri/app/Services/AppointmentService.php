<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    /**
     * Obtiene todas las citas.
     */
    public function getAll(): Collection
    {
        return Appointment::with('user')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
    }

    /**
     * Obtiene las citas paginadas.
     */
    public function getPaginated(
        int $perPage = 10,
        ?string $status = null,
        ?string $search = null
    ): LengthAwarePaginator {
        $query = Appointment::with('user')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time');

        /*
        |--------------------------------------------------------------------------
        | Filtro por estado
        |--------------------------------------------------------------------------
        */

        if ($status !== null && $status !== '') {
            $query->where('status', $status);
        }

        /*
        |--------------------------------------------------------------------------
        | Búsqueda por cliente
        |--------------------------------------------------------------------------
        */

        if ($search !== null && trim($search) !== '') {
            $search = trim($search);

            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Obtiene una cita por ID.
     */
    public function find(int $id): Appointment
    {
        return Appointment::with([
            'user',
            'user.clinicalForm',
        ])->findOrFail($id);
    }

    /**
     * Obtiene las citas de un cliente.
     */
    public function getByClient(int $userId): Collection
    {
        return Appointment::where('user_id', $userId)
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();
    }

    /**
     * Crea una nueva cita.
     */
    public function create(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            return Appointment::create([
                'user_id' => $data['user_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'reason' => $data['reason'] ?? null,
                'notes' => $data['notes'] ?? null,
                'status' => $data['status'] ?? 'pending',
                'status_notes' => $data['status_notes'] ?? null,
            ]);
        });
    }

    /**
     * Actualiza una cita.
     */
    public function update(
        Appointment $appointment,
        array $data
    ): Appointment {
        return DB::transaction(function () use ($appointment, $data) {

            $appointment->update([
                'user_id' => $data['user_id'] ?? $appointment->user_id,
                'appointment_date' =>
                    $data['appointment_date'] ?? $appointment->appointment_date,
                'appointment_time' =>
                    $data['appointment_time'] ?? $appointment->appointment_time,
                'reason' =>
                    $data['reason'] ?? $appointment->reason,
                'notes' =>
                    $data['notes'] ?? $appointment->notes,
                'status' =>
                    $data['status'] ?? $appointment->status,
                'status_notes' =>
                    $data['status_notes'] ?? $appointment->status_notes,
            ]);

            return $appointment->fresh([
                'user',
            ]);
        });
    }

    /**
     * Confirma una cita.
     */
    public function confirm(Appointment $appointment): Appointment
    {
        $appointment->update([
            'status' => 'confirmed',
            'status_notes' => null,
        ]);

        return $appointment->fresh();
    }

    /**
     * Suspende una cita.
     */
    public function suspend(
        Appointment $appointment,
        ?string $reason = null
    ): Appointment {
        $appointment->update([
            'status' => 'suspended',
            'status_notes' => $reason,
        ]);

        return $appointment->fresh();
    }

    /**
     * Cancela una cita.
     */
    public function cancel(
        Appointment $appointment,
        ?string $reason = null
    ): Appointment {
        $appointment->update([
            'status' => 'cancelled',
            'status_notes' => $reason,
        ]);

        return $appointment->fresh();
    }

    /**
     * Reactiva una cita.
     */
    public function setPending(Appointment $appointment): Appointment
    {
        $appointment->update([
            'status' => 'pending',
            'status_notes' => null,
        ]);

        return $appointment->fresh();
    }

    /**
     * Obtiene las citas de una fecha determinada.
     */
    public function getByDate(string $date): Collection
    {
        return Appointment::with('user')
            ->whereDate('appointment_date', $date)
            ->orderBy('appointment_time')
            ->get();
    }

    /**
     * Obtiene las citas de un rango de fechas.
     */
    public function getBetweenDates(
        string $startDate,
        string $endDate
    ): Collection {
        return Appointment::with('user')
            ->whereBetween('appointment_date', [
                $startDate,
                $endDate,
            ])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
    }

    /**
     * Obtiene las citas del día actual.
     */
    public function getToday(): Collection
    {
        return $this->getByDate(
            now()->format('Y-m-d')
        );
    }

    /**
     * Obtiene las próximas citas.
     */
    public function getUpcoming(int $limit = 5): Collection
    {
        return Appointment::with('user')
            ->where(function ($query) {
                $query->whereDate(
                    'appointment_date',
                    '>',
                    now()->format('Y-m-d')
                )->orWhere(function ($query) {
                    $query->whereDate(
                        'appointment_date',
                        '=',
                        now()->format('Y-m-d')
                    )->where(
                        'appointment_time',
                        '>=',
                        now()->format('H:i:s')
                    );
                });
            })
            ->whereNotIn('status', [
                'cancelled',
                'suspended',
            ])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit($limit)
            ->get();
    }

    /**
     * Cuenta las citas según su estado.
     */
    public function countByStatus(string $status): int
    {
        return Appointment::where('status', $status)->count();
    }

    /**
     * Cuenta las citas del día actual.
     */
    public function countToday(): int
    {
        return Appointment::whereDate(
            'appointment_date',
            now()->format('Y-m-d')
        )->count();
    }

    /**
     * Comprueba si existe conflicto de horario.
     */
    public function hasScheduleConflict(
        string $date,
        string $time,
        ?int $exceptAppointmentId = null
    ): bool {
        $query = Appointment::whereDate(
            'appointment_date',
            $date
        )->where(
            'appointment_time',
            $time
        )->whereNotIn('status', [
            'cancelled',
            'suspended',
        ]);

        if ($exceptAppointmentId !== null) {
            $query->where(
                'id',
                '!=',
                $exceptAppointmentId
            );
        }

        return $query->exists();
    }
}