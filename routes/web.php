<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\otp_controller;
use App\Http\Controllers\mailer_controller;

use App\Http\Controllers\index\registration_patient_controller as RegisterPatient;
use App\Http\Controllers\index\login_controller as Login;
use App\Http\Controllers\index\recover_controller as Recover;

Route::get('/logout', [Login::class, 'logout']);

Route::get('noaccess', function(){
    return view('noaccess');
});

//=======================index=========================
Route::middleware('already_login')->group(function(){
    Route::view('/','index.login');
    Route::post('auth_user', [Login::class, 'login']); //authenticate user after success login

    Route::prefix('recover')->group(function(){
        Route::view('/','index.recover');
        Route::post('recover', [Recover::class, 'update']);
        Route::post('send_otp', [otp_controller::class, 'compose_mail']);
    });

    Route::prefix('registration')->group(function () {
        Route::view('/','index.registration');
        Route::post('register', [RegisterPatient::class, 'store']);
        Route::post('send_otp', [otp_controller::class, 'compose_mail']);
    });
});
//=======================main=========================
Route::middleware('auth_check')->group(function(){

    Route::prefix('patient')->group(function(){
        Route::view('/', 'patient.profile');
        //Route::get('/', [Profile::class, 'index']);
        Route::post('/updatemyprofile/{id}', [Profile::class, 'update']);
        Route::post('/updatemyemergencycontact/{id}', [Emergency::class, 'update']);
    });

    // Route::prefix('admin')->group(function(){
    //     Route::get('/',[AdminPatient::class, 'index']);
    // });
});

