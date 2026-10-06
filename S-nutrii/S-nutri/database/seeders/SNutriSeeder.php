<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ClinicalForm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SNutriSeeder extends Seeder
{
    /**
     * Ejecuta los datos iniciales de S-Nutri.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | NUTRIÓLOGO
        |--------------------------------------------------------------------------
        */

        $nutriologo = User::create([
            'name' => 'Dr. Carlos Ramírez',
            'email' => 'nutriologo@s-nutri.test',
            'phone' => '5951234567',
            'role' => 'nutriologo',
            'password' => Hash::make('SNutri2026'),
            'active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | CLIENTES
        |--------------------------------------------------------------------------
        */

        $clientes = [
            [
                'name' => 'Ana López Martínez',
                'email' => 'ana.lopez@s-nutri.test',
                'phone' => '5951000001',
                'birth_date' => '1998-04-15',
                'gender' => 'Femenino',
                'occupation' => 'Diseñadora gráfica',
                'weight' => 64.50,
                'height' => 1.62,
                'body_fat_percentage' => 28.40,
                'medical_history' => 'Sin antecedentes médicos relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Antecedentes familiares de hipertensión.',
                'eating_habits' => 'Realiza tres comidas al día. Consume alimentos procesados ocasionalmente.',
                'physical_activity' => 'Gimnasio 3 veces por semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '1.5 litros diarios',
                'nutritional_goal' => 'Reducir porcentaje de grasa corporal.',
                'additional_information' => 'Desea mejorar sus hábitos alimenticios.',
            ],

            [
                'name' => 'Luis Hernández García',
                'email' => 'luis.hernandez@s-nutri.test',
                'phone' => '5951000002',
                'birth_date' => '1995-08-21',
                'gender' => 'Masculino',
                'occupation' => 'Ingeniero de software',
                'weight' => 82.30,
                'height' => 1.76,
                'body_fat_percentage' => 25.10,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Mariscos.',
                'medications' => 'Ninguno.',
                'supplements' => 'Proteína y creatina.',
                'family_history' => 'Padre con hipertensión.',
                'eating_habits' => 'Consume alimentos fuera de casa con frecuencia.',
                'physical_activity' => 'Entrenamiento de fuerza 4 veces por semana.',
                'sleep_hours' => '6 horas',
                'water_consumption' => '2 litros diarios',
                'nutritional_goal' => 'Aumentar masa muscular y reducir grasa.',
                'additional_information' => 'Busca una alimentación compatible con entrenamiento.',
            ],

            [
                'name' => 'Mariana Torres Sánchez',
                'email' => 'mariana.torres@s-nutri.test',
                'phone' => '5951000003',
                'birth_date' => '2000-02-11',
                'gender' => 'Femenino',
                'occupation' => 'Estudiante',
                'weight' => 58.20,
                'height' => 1.60,
                'body_fat_percentage' => 26.80,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Multivitamínico.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Horarios de alimentación irregulares.',
                'physical_activity' => 'Caminata y ejercicio ligero.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '1.8 litros diarios',
                'nutritional_goal' => 'Mejorar alimentación y composición corporal.',
                'additional_information' => 'Tiene poco tiempo para preparar alimentos.',
            ],

            [
                'name' => 'Jorge Martínez Pérez',
                'email' => 'jorge.martinez@s-nutri.test',
                'phone' => '5951000004',
                'birth_date' => '1992-11-03',
                'gender' => 'Masculino',
                'occupation' => 'Contador',
                'weight' => 91.70,
                'height' => 1.78,
                'body_fat_percentage' => 30.20,
                'medical_history' => 'Sobrepeso previo.',
                'current_conditions' => 'Ninguna diagnosticada.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Diabetes mellitus tipo 2.',
                'eating_habits' => 'Alto consumo de bebidas azucaradas.',
                'physical_activity' => 'Actividad física baja.',
                'sleep_hours' => '6 horas',
                'water_consumption' => '1 litro diario',
                'nutritional_goal' => 'Pérdida de peso.',
                'additional_information' => 'Desea mejorar progresivamente sus hábitos.',
            ],

            [
                'name' => 'Sofía Ramírez Cruz',
                'email' => 'sofia.ramirez@s-nutri.test',
                'phone' => '5951000005',
                'birth_date' => '1999-06-18',
                'gender' => 'Femenino',
                'occupation' => 'Mercadóloga',
                'weight' => 67.80,
                'height' => 1.65,
                'body_fat_percentage' => 29.50,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Lactosa.',
                'medications' => 'Ninguno.',
                'supplements' => 'Omega 3.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Consume poca fruta.',
                'physical_activity' => 'Pilates 3 veces por semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '2 litros diarios',
                'nutritional_goal' => 'Mejorar composición corporal.',
                'additional_information' => 'Prefiere opciones de alimentación sencillas.',
            ],

            [
                'name' => 'Diego Flores Ramírez',
                'email' => 'diego.flores@s-nutri.test',
                'phone' => '5951000006',
                'birth_date' => '1997-01-27',
                'gender' => 'Masculino',
                'occupation' => 'Administrador',
                'weight' => 76.40,
                'height' => 1.72,
                'body_fat_percentage' => 24.70,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Proteína.',
                'family_history' => 'Hipertensión en familiares directos.',
                'eating_habits' => 'Realiza cuatro comidas al día.',
                'physical_activity' => 'Gimnasio 5 días por semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '2.5 litros diarios',
                'nutritional_goal' => 'Incrementar masa muscular.',
                'additional_information' => 'Busca mejorar rendimiento deportivo.',
            ],

            [
                'name' => 'Valeria Gómez Ruiz',
                'email' => 'valeria.gomez@s-nutri.test',
                'phone' => '5951000007',
                'birth_date' => '2001-09-12',
                'gender' => 'Femenino',
                'occupation' => 'Estudiante',
                'weight' => 55.60,
                'height' => 1.58,
                'body_fat_percentage' => 27.30,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Salta ocasionalmente el desayuno.',
                'physical_activity' => 'Actividad física moderada.',
                'sleep_hours' => '6.5 horas',
                'water_consumption' => '1.5 litros diarios',
                'nutritional_goal' => 'Mejorar hábitos alimenticios.',
                'additional_information' => 'Desea establecer horarios de comida.',
            ],

            [
                'name' => 'Carlos Mendoza Ortiz',
                'email' => 'carlos.mendoza@s-nutri.test',
                'phone' => '5951000008',
                'birth_date' => '1989-03-30',
                'gender' => 'Masculino',
                'occupation' => 'Comerciante',
                'weight' => 98.40,
                'height' => 1.80,
                'body_fat_percentage' => 32.10,
                'medical_history' => 'Antecedentes de sobrepeso.',
                'current_conditions' => 'Ninguna diagnosticada.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Diabetes e hipertensión.',
                'eating_habits' => 'Alto consumo de alimentos fritos.',
                'physical_activity' => 'Actividad física baja.',
                'sleep_hours' => '6 horas',
                'water_consumption' => '1.2 litros diarios',
                'nutritional_goal' => 'Reducir peso corporal.',
                'additional_information' => 'Necesita un plan práctico.',
            ],

            [
                'name' => 'Fernanda Castillo López',
                'email' => 'fernanda.castillo@s-nutri.test',
                'phone' => '5951000009',
                'birth_date' => '1996-07-24',
                'gender' => 'Femenino',
                'occupation' => 'Abogada',
                'weight' => 69.30,
                'height' => 1.67,
                'body_fat_percentage' => 30.10,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Come principalmente fuera de casa.',
                'physical_activity' => 'Caminata 4 veces por semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '1.8 litros diarios',
                'nutritional_goal' => 'Pérdida moderada de grasa.',
                'additional_information' => 'Horarios laborales variables.',
            ],

            [
                'name' => 'Ricardo Sánchez Morales',
                'email' => 'ricardo.sanchez@s-nutri.test',
                'phone' => '5951000010',
                'birth_date' => '1993-12-05',
                'gender' => 'Masculino',
                'occupation' => 'Arquitecto',
                'weight' => 84.90,
                'height' => 1.75,
                'body_fat_percentage' => 27.60,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Creatina.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Consumo elevado de café.',
                'physical_activity' => 'Entrenamiento de fuerza 3 veces por semana.',
                'sleep_hours' => '6 horas',
                'water_consumption' => '2 litros diarios',
                'nutritional_goal' => 'Aumentar masa muscular.',
                'additional_information' => 'Busca mejorar su rendimiento.',
            ],

            [
                'name' => 'Daniela Vargas Moreno',
                'email' => 'daniela.vargas@s-nutri.test',
                'phone' => '5951000011',
                'birth_date' => '1994-05-19',
                'gender' => 'Femenino',
                'occupation' => 'Maestra',
                'weight' => 61.70,
                'height' => 1.61,
                'body_fat_percentage' => 28.90,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Hipertensión.',
                'eating_habits' => 'Consumo frecuente de pan dulce.',
                'physical_activity' => 'Caminata.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '1.7 litros diarios',
                'nutritional_goal' => 'Mejorar alimentación.',
                'additional_information' => 'Desea reducir consumo de azúcar.',
            ],

            [
                'name' => 'Miguel Ángel Reyes',
                'email' => 'miguel.reyes@s-nutri.test',
                'phone' => '5951000012',
                'birth_date' => '1990-10-09',
                'gender' => 'Masculino',
                'occupation' => 'Técnico',
                'weight' => 88.20,
                'height' => 1.77,
                'body_fat_percentage' => 28.30,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Proteína.',
                'family_history' => 'Diabetes mellitus tipo 2.',
                'eating_habits' => 'Tres comidas principales.',
                'physical_activity' => 'Fútbol los fines de semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '2 litros diarios',
                'nutritional_goal' => 'Reducir grasa corporal.',
                'additional_information' => 'Desea combinar nutrición con deporte.',
            ],

            [
                'name' => 'Paola Jiménez Torres',
                'email' => 'paola.jimenez@s-nutri.test',
                'phone' => '5951000013',
                'birth_date' => '1998-12-14',
                'gender' => 'Femenino',
                'occupation' => 'Diseñadora',
                'weight' => 63.40,
                'height' => 1.64,
                'body_fat_percentage' => 29.10,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Horarios variables.',
                'physical_activity' => 'Yoga 3 veces por semana.',
                'sleep_hours' => '7 horas',
                'water_consumption' => '1.6 litros diarios',
                'nutritional_goal' => 'Mantener peso y mejorar hábitos.',
                'additional_information' => 'Prefiere alimentación casera.',
            ],

            [
                'name' => 'Andrés Navarro Díaz',
                'email' => 'andres.navarro@s-nutri.test',
                'phone' => '5951000014',
                'birth_date' => '1988-06-22',
                'gender' => 'Masculino',
                'occupation' => 'Empresario',
                'weight' => 93.60,
                'height' => 1.82,
                'body_fat_percentage' => 29.80,
                'medical_history' => 'Sobrepeso.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Multivitamínico.',
                'family_history' => 'Hipertensión y diabetes.',
                'eating_habits' => 'Comidas abundantes durante la noche.',
                'physical_activity' => 'Actividad física baja.',
                'sleep_hours' => '5.5 horas',
                'water_consumption' => '1.2 litros diarios',
                'nutritional_goal' => 'Reducir peso y mejorar hábitos.',
                'additional_information' => 'Horarios laborales extensos.',
            ],

            [
                'name' => 'Laura Méndez Silva',
                'email' => 'laura.mendez@s-nutri.test',
                'phone' => '5951000015',
                'birth_date' => '2002-03-08',
                'gender' => 'Femenino',
                'occupation' => 'Estudiante',
                'weight' => 57.90,
                'height' => 1.59,
                'body_fat_percentage' => 25.90,
                'medical_history' => 'Sin antecedentes relevantes.',
                'current_conditions' => 'Ninguna.',
                'allergies' => 'Ninguna conocida.',
                'medications' => 'Ninguno.',
                'supplements' => 'Ninguno.',
                'family_history' => 'Sin antecedentes relevantes.',
                'eating_habits' => 'Alimentación variada.',
                'physical_activity' => 'Gimnasio 3 veces por semana.',
                'sleep_hours' => '8 horas',
                'water_consumption' => '2 litros diarios',
                'nutritional_goal' => 'Mejorar rendimiento físico.',
                'additional_information' => 'Sin información adicional.',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | CREAR CLIENTES
        |--------------------------------------------------------------------------
        */

        foreach ($clientes as $index => $data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' => 'cliente',
                'password' => null,
                'active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | FORMULARIO CLÍNICO
            |--------------------------------------------------------------------------
            */

            ClinicalForm::create([
                'user_id' => $user->id,
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
                'occupation' => $data['occupation'],
                'weight' => $data['weight'],
                'height' => $data['height'],
                'body_fat_percentage' => $data['body_fat_percentage'],
                'medical_history' => $data['medical_history'],
                'current_conditions' => $data['current_conditions'],
                'allergies' => $data['allergies'],
                'medications' => $data['medications'],
                'supplements' => $data['supplements'],
                'family_history' => $data['family_history'],
                'eating_habits' => $data['eating_habits'],
                'physical_activity' => $data['physical_activity'],
                'sleep_hours' => $data['sleep_hours'],
                'water_consumption' => $data['water_consumption'],
                'nutritional_goal' => $data['nutritional_goal'],
                'additional_information' => $data['additional_information'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | CITA
            |--------------------------------------------------------------------------
            |
            | Las fechas se distribuyen durante los próximos días.
            |
            */

            $statuses = [
                'pending',
                'confirmed',
                'confirmed',
                'pending',
                'suspended',
            ];

            $status = $statuses[$index % count($statuses)];

            Appointment::create([
                'user_id' => $user->id,
                'appointment_date' => now()
                    ->addDays(($index % 10) + 1)
                    ->format('Y-m-d'),

                'appointment_time' => sprintf(
                    '%02d:00:00',
                    9 + ($index % 8)
                ),

                'reason' => match ($index % 4) {
                    0 => 'Primera consulta nutricional',
                    1 => 'Seguimiento nutricional',
                    2 => 'Evaluación de composición corporal',
                    3 => 'Control de progreso',
                },

                'notes' => 'Cita generada mediante datos iniciales de S-Nutri.',

                'status' => $status,

                'status_notes' => $status === 'suspended'
                    ? 'La cita fue suspendida temporalmente.'
                    : null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | MENSAJE FINAL
        |--------------------------------------------------------------------------
        */

        $this->command?->info('S-Nutri seeder ejecutado correctamente.');
        $this->command?->info('Nutriólogo creado: nutriologo@s-nutri.test');
        $this->command?->info('Contraseña: SNutri2026');
        $this->command?->info('15 clientes creados.');
        $this->command?->info('15 formularios clínicos creados.');
        $this->command?->info('15 citas creadas.');
    }
}