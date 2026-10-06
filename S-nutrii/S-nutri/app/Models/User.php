<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que pueden asignarse masivamente.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'active',
    ];

    /**
     * Campos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    /**
     * Relación:
     * Un cliente puede tener muchas citas.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Relación:
     * Un cliente tiene un formulario clínico.
     */
    public function clinicalForm(): HasOne
    {
        return $this->hasOne(ClinicalForm::class);
    }

    /**
     * Determina si el usuario es nutriólogo.
     */
    public function isNutriologo(): bool
    {
        return $this->role === 'nutriologo';
    }

    /**
     * Determina si el usuario es cliente.
     */
    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    /**
     * Determina si el usuario está activo.
     */
    public function isActive(): bool
    {
        return $this->active === true;
    }
}