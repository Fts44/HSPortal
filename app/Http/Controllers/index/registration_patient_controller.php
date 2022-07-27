<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\otp_controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\index\register_patient_model;

use App\Rules\gsuite_rule;
use App\Rules\pass_rule;

class registration_patient_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }
    
    public function store(Request $request){
  
        $rules = [
            'gsuite_email' => ['required','max:255','unique:accounts',new gsuite_rule],
            'otp' => ['required','numeric','min:4'],
            'pass' => ['required', 'max:20', new pass_rule],
            'cpass' => ['required','same:pass']
        ];

        $messages = [
            'cpass.same' => 'Password not match.'
        ];
        
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
            //echo $validator->messages();
        }
        else{

            $verify_otp_request = new Request([
                'email' => $request->gsuite_email,
                'otp' => $request->otp,
            ]);
    
            if($this->otp_controller->verify_otp($verify_otp_request)){
                $register_patient_model = new register_patient_model;
                $register_patient_model->gsuite_email = $request->gsuite_email;
                $register_patient_model->password = Hash::make($request->pass);
                $register_patient_model->acc_type = 'patient';
                $register_patient_model->save();
     
                $response = [
                    'title' => 'Success',
                    'message' => 'Account created',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response);
            }
            else{
    
                $response = [
                    'title' => 'Error',
                    'message' => 'Invalid otp, Please double check the email!',
                    'icon' => 'error',
                    'status' => 400
                ];
                $response = json_encode($response, true);
                return redirect()->back()->withInput($request->all())->with('status',$response);
            }
        }
    }
}
