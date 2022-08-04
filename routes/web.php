<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\otp_controller;
use App\Http\Controllers\mailer_controller;
use App\Http\Controllers\populate_select_controller as PopulateSelect;

use App\Http\Controllers\index\registration_controller as Register;
use App\Http\Controllers\index\login_controller as Login;
use App\Http\Controllers\index\recover_controller as Recover;

use App\Http\Controllers\patient\profile_controller as PatientProfile;

use App\Http\Controllers\admin\configuration\grade_level_controller as GradeLevel;
use App\Http\Controllers\admin\configuration\department_controller as Department;
use App\Http\Controllers\admin\configuration\program_controller as Program;

use App\Http\Controllers\admin\profilepatient as AdminPatient;

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

    Route::prefix('patient')->middleware('is_patient')->group(function(){

        Route::prefix('/')->group(function(){
            Route::get('/', [PatientProfile::class, 'index']);
            Route::post('/updatemyprofile/{id}', [PatientProfile::class, 'update_personal_info']);
            Route::post('/updatemyemergencycontact/{id}', [PatientProfile::class, 'update_emergency_contact']);
            Route::post('/updatemypassword/{id}', [PatientProfile::class, 'update_password']);
            Route::post('/updatemyprofile/send_otp', [PatientProfile::class, 'get_otp']);
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

    Route::prefix('admin')->middleware('is_admin')->group(function(){
        Route::prefix('/')->group(function(){
            Route::view('/','admin.profile');
        });

        Route::prefix('/infirmarypersonnel')->group(function(){
            Route::view('/','admin.profilepersonnel');
        });

        Route::prefix('/patient')->group(function(){
            Route::get('/',[AdminPatient::class,'index']);

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


        Route::prefix('/configuration')->group(function(){

            Route::prefix('/gradelevel')->group(function(){
                Route::get('/', [GradeLevel::class, 'index']);
                Route::post('/new', [GradeLevel::class, 'store']);
                Route::get('/delete/{id}', [GradeLevel::class, 'destroy']);
                Route::post('/update/{id}', [GradeLevel::class, 'update']);
            });
            
            Route::prefix('/department')->group(function(){
                Route::get('/', [Department::class, 'index']);
                Route::post('/new', [Department::class, 'store']);
                Route::get('/delete/{id}', [Department::class, 'destroy']);
                Route::post('/update/{id}', [Department::class, 'update']);
            });

            Route::prefix('/program')->group(function(){
                Route::get('/', [Program::class, 'index']);
                Route::post('/new', [Program::class, 'store']);
                Route::get('/delete/{id}', [Program::class, 'destroy']);
                Route::post('/update/{id}', [Program::class, 'update']);
            });
        });
    });

    Route::prefix('nurse')->group(function(){

    });

    Route::prefix('doctor')->group(function(){

    });

});

Route::prefix('/populate')->group(function(){
    Route::get('grade_level', [PopulateSelect::class, 'grade_level']);
    Route::get('department/{grade_level}', [PopulateSelect::class, 'department']);
    Route::get('program/{department}', [PopulateSelect::class, 'program']);

    Route::get('province', [PopulateSelect::class, 'province']);
    Route::get('municipality', [PopulateSelect::class, 'municipality']);
    Route::get('barangay', [PopulateSelect::class, 'barangay']);
});

