<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'user_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
        'status',
        'status_notes',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
        ];
    }

    /**
     * Relación:
     * Una cita pertenece a un cliente.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve el nombre legible del estado.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Pendiente',
            'confirmed' => 'Confirmada',
            'suspended' => 'Suspendida',
            'cancelled' => 'Cancelada',
            default => 'Desconocida',
        };
    }

    /**
     * Determina si la cita está pendiente.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Determina si la cita está confirmada.
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Determina si la cita está suspendida.
     */
    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    /**
     * Determina si la cita está cancelada.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}