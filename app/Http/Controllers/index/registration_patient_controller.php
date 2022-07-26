<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\otp_controller;
use Illuminate\Http\Request;

class registration_patient_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }
    public function register(Request $request){
        $request->validate(
            [
                'gsuite_email' => 'required|max:255|unique:accounts',
                'otp' => 'required|numeric|digits:4',
                'password' => 'required|min:6|max:60',
                'cpassword' => 'required|same:password'
            ],
            [
                'cpassword.same' => 'Password not match.'
            ]
        );

        $verify_request = new Request([
            'email' => $request->gsuite_email,
            'otp' => $request->otp,
        ]);

        if($this->otp_controller->verify_otp($verify_request)){
            
        }
        else{
            
        }
    }
}
