<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicalForm extends Model
{
    use HasFactory;

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'occupation',
        'weight',
        'height',
        'body_fat_percentage',
        'medical_history',
        'current_conditions',
        'allergies',
        'medications',
        'supplements',
        'family_history',
        'eating_habits',
        'physical_activity',
        'sleep_hours',
        'water_consumption',
        'nutritional_goal',
        'additional_information',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'weight' => 'decimal:2',
            'height' => 'decimal:2',
            'body_fat_percentage' => 'decimal:2',
        ];
    }

    /**
     * Relación:
     * El formulario clínico pertenece a un cliente.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}