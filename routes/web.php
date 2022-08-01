<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\otp_controller;
use App\Http\Controllers\mailer_controller;

use App\Http\Controllers\index\registration_controller as Register;
use App\Http\Controllers\index\login_controller as Login;
use App\Http\Controllers\index\recover_controller as Recover;

use App\Http\Controllers\patient\profile_controller as PatientProfile;

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
        Route::post('register', [Register::class, 'store']);
        Route::post('send_otp', [otp_controller::class, 'compose_mail']);
    });
});

//=======================main=========================
Route::middleware('auth_check')->group(function(){

    Route::prefix('patient')->group(function(){
        //Route::view('/', 'patient.profile');
        // middleware('is_patient')->
        Route::prefix('/')->group(function(){
            Route::get('/', [PatientProfile::class, 'index']);
            Route::post('/updatemyprofile/{id}', [PatientProfile::class, 'update']);
            Route::post('/updatemyemergencycontact/{id}', [Emergency::class, 'update']);
        });

        Route::prefix('/documents')->group(function(){
            Route::view('/','patient.documents');
        });

        Route::prefix('/appointment')->group(function(){
            Route::view('/','patient.appointment');

            Route::prefix('/request')->group(function(){
                Route::view('/','patient.appointmentRequest');
            });
        });

        Route::prefix('/message')->group(function(){
            Route::view('/','patient.message');
        });

        Route::prefix('/dashboard')->group(function(){
            Route::view('/','patient.dashboard');
        });

    });

    Route::prefix('admin')->group(function(){
        // middleware('is_admin')->
        Route::prefix('/')->group(function(){
            Route::view('/','admin.profile');
        });

        Route::prefix('/infirmarypersonnel')->group(function(){
            Route::view('/','admin.profilepersonnel');
        });

        Route::prefix('/patient')->group(function(){
            Route::view('/','admin.profilepatient');

            Route::prefix('/records')->group(function(){
                Route::view('/','admin.records');
            });
        });

        Route::prefix('/inventory/medication')->group(function(){
            Route::view('/','admin.inventoryMedication');
        });

        Route::prefix('/appointment')->group(function(){
            Route::view('/','admin.appointment');
        });

        Route::prefix('/dashboard')->group(function(){
            Route::view('/','admin.dashboard');
        });
    });

    Route::prefix('nurse')->group(function(){

    });

    Route::prefix('doctor')->group(function(){

    });
});

