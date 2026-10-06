<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClinicalFormController;


/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| SITIO PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/agendar-cita', [
    PublicController::class,
    'appointment'
])->name('public.appointment');


Route::post('/agendar-cita', [
    PublicController::class,
    'storeAppointment'
])->name('public.appointment.store');


Route::get('/formulario-clinico', [
    PublicController::class,
    'clinicalForm'
])->name('public.clinical-form');


Route::post('/formulario-clinico', [
    PublicController::class,
    'storeClinicalForm'
])->name('public.clinical-form.store');


/*
|--------------------------------------------------------------------------
| PANEL DEL NUTRIÓLOGO
|--------------------------------------------------------------------------
|
| Todas estas rutas requieren:
|
| auth
| nutriologo
|
*/

Route::middleware([
    'auth',
    'nutriologo'
])->prefix('admin')->name('admin.')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | CITAS
    |--------------------------------------------------------------------------
    */

    Route::get('/citas', [
        AppointmentController::class,
        'index'
    ])->name('appointments.index');


    Route::get('/citas/calendario', [
        AppointmentController::class,
        'calendar'
    ])->name('appointments.calendar');


    Route::get('/citas/calendario/data', [
        AppointmentController::class,
        'calendarData'
    ])->name('appointments.calendar.data');


    Route::get('/citas/{appointment}', [
        AppointmentController::class,
        'show'
    ])->name('appointments.show');


    Route::get('/citas/{appointment}/editar', [
        AppointmentController::class,
        'edit'
    ])->name('appointments.edit');


    Route::put('/citas/{appointment}', [
        AppointmentController::class,
        'update'
    ])->name('appointments.update');


    Route::patch('/citas/{appointment}/confirmar', [
        AppointmentController::class,
        'confirm'
    ])->name('appointments.confirm');


    Route::patch('/citas/{appointment}/suspender', [
        AppointmentController::class,
        'suspend'
    ])->name('appointments.suspend');


    Route::patch('/citas/{appointment}/cancelar', [
        AppointmentController::class,
        'cancel'
    ])->name('appointments.cancel');


    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes', [
        ClientController::class,
        'index'
    ])->name('clients.index');


    Route::get('/clientes/crear', [
        ClientController::class,
        'create'
    ])->name('clients.create');


    Route::post('/clientes', [
        ClientController::class,
        'store'
    ])->name('clients.store');


    Route::get('/clientes/{client}', [
        ClientController::class,
        'show'
    ])->name('clients.show');


    Route::get('/clientes/{client}/editar', [
        ClientController::class,
        'edit'
    ])->name('clients.edit');


    Route::put('/clientes/{client}', [
        ClientController::class,
        'update'
    ])->name('clients.update');


    Route::patch('/clientes/{client}/activar', [
        ClientController::class,
        'activate'
    ])->name('clients.activate');


    Route::patch('/clientes/{client}/desactivar', [
        ClientController::class,
        'deactivate'
    ])->name('clients.deactivate');


    /*
    |--------------------------------------------------------------------------
    | FORMULARIOS CLÍNICOS
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes/{client}/formulario-clinico', [
        ClinicalFormController::class,
        'show'
    ])->name('clinical-forms.show');


    Route::get('/clientes/{client}/formulario-clinico/editar', [
        ClinicalFormController::class,
        'edit'
    ])->name('clinical-forms.edit');


    Route::put('/clientes/{client}/formulario-clinico', [
        ClinicalFormController::class,
        'update'
    ])->name('clinical-forms.update');

});