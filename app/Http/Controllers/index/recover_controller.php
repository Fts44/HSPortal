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

class recover_controller extends Controller
{
    public function __construct(){
        $this->otp_controller = new otp_controller;
    }

    public function update(Request $request){
        $rules = [
            'email' => ['required','max:255'],
            'otp' => ['required','numeric','min:4'],
            'pass' => ['required', 'max:20', new pass_rule],
            'cpass' => ['required','same:pass']
        ];

        $messages = [
            'cpass.same' => 'Password not match.'
        ];
        
        if(str_contains($request->email, '@g.batstate-u.edu.ph')){         
            array_push($rules['email'], 'exists:accounts,gsuite_email');
            $message = [
                'email.exists' => 'Gsuite email is not registered.'
            ];
            $email_type = "gsuite_email";
        }
        else{
            array_push($rules['email'], 'exists:accounts,email');
            $message = [
                'email.exists' => 'Email is not registered.'
            ];
            $email_type = "email";
        }

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
                DB::table('accounts')->where($email_type, $request->email)->update([
                    'password' => Hash::make($request->pass)
                ]);  
     
                $response = [
                    'title' => 'Success',
                    'message' => 'Password updated',
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
