<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\otp_controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;

use App\Rules\gsuite_rule;
use App\Rules\pass_rule;

class registration_patient_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }
    
    public function store(Request $request){
  
        $rules = [
            'email' => ['required','unique:accounts',new gsuite_rule],
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
                'email' => $request->email,
                'otp' => $request->otp,
            ]);
    
            if($this->otp_controller->verify_otp($verify_otp_request)){
                $data = [
                    'gsuite_email' => $request->email,
                    'password' => Hash::make($request->pass),
                    'acc_type' => 'patient'
                ];
                DB::table('accounts')->insert($data);
     
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
