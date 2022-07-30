<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\otp_controller;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;

use App\Rules\gsuite_rule;
use App\Rules\pass_rule;

class registration_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }
    
    public function store(Request $request){
  
        $rules = [
            'email' => ['required','unique:accounts'],
            'otp' => ['required','numeric','min:4'],
            'pass' => ['required', 'max:20', new pass_rule],
            'cpass' => ['required','same:pass'],
            'classification' => ['required', 'in:student,teacher,school personnel,infirmary personnel'],
            'position' => "required_if:classification,==,infirmary personnel"
        ];

        $messages = [
            'cpass.same' => 'The confirm Password not match.',
            'cpass.required' => 'The confirm Password field is required.',
            'classification.in' => 'Student, teacher, school personnel, infirmary personnel only.',
            'position.required_if' => 'The position field is required'
        ];
        
        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        else{
            $verify_otp_request = new Request([
                'email' => $request->email,
                'otp' => $request->otp,
            ]);
    
            if($this->otp_controller->verify_otp($verify_otp_request)){

                $data = [
                    'password' => Hash::make($request->pass),
                    'classification' => $request->classification
                ];

                if($request->position == null){
                    $data['position'] = 'patient';
                }
                else{
                    $data['position'] = $request->position;
                }

                if(str_contains($request->email, "@g.batstate-u.edu.ph")){
                    $data['gsuite_email'] = $request->email;
                    $data['is_verified'] = true;
                }
                else{
                    $data['email'] = $request->email;
                    $data['is_verified'] = false;
                }

                // echo json_encode($data);
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
                    'title' => 'Invalid otp,',
                    'message' => 'Please double check the email or get new one!',
                    'icon' => 'error',
                    'status' => 400
                ];
                $response = json_encode($response, true);
                return redirect()->back()->withInput($request->all())->with('status',$response);
            }
        }
    }
}