<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\otp_controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\index\register_patient_model;

use App\Rules\gsuite_rule;


class registration_patient_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }
    public function store(Request $request){
  
        $rules = [
            'gsuite_email' => ['required','max:255','unique:accounts',new gsuite_rule],
            'otp' => ['required','numeric','digits:4'],
            'password' => ['required','min:6','max:60'],
            'cpassword' => ['required','same:password']
        ];

        $messages = [
            'cpassword.same' => 'Password not match.'
        ];
        
        $validator = Validator::make( $request->all(), $rules, $messages);

        $verify_otp_request = new Request([
            'email' => $request->gsuite_email,
            'otp' => $request->otp,
        ]);

        if($this->otp_controller->verify_otp($verify_otp_request)){
            $register_patient_model = new register_patient_model;
            $register_patient_model->gsuite_email = $request->gsuite_email;
            $register_patient_model->password = Hash::make($request->password);
            $register_patient_model->save();
            echo "registered";
        }
        else{
            echo $validator->messages();
        }
    }
}
