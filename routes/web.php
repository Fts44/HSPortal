<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\otp_controller;
use App\Http\Controllers\mailer_controller;
use App\Http\Controllers\index\registration_patient_controller as RegisterPatient;


Route::get('/', function () {
    return view('index.login');
});

Route::prefix('registration')->group(function () {
    Route::get('/', function () {
        return view('index.registration');
    });
    Route::post('/register', [RegisterPatient::class, 'register']);
    Route::post('/send_otp', [otp_controller::class, 'compose_mail']);
});


Route::get('/get_new_otp', [otp_controller::class, 'generate_new_otp']);

// ===================================================
Route::get('/send', [mailer_controller::class, 'send']);
