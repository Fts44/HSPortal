<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\index\login_model;
use App\Rules\gsuite_rule;
use Session;

class login_controller extends Controller
{
    public function login(Request $request){
        $rules = [
            'userid' => 'required',
            'pass' => 'required',
        ];

        $message = [
            'userid.exists' => 'User not found.',
            'pass.required' => 'Password field is required.'
        ];

        //check if userid is sr_code, email, or gsuite_email
        if (filter_var($request->userid, FILTER_VALIDATE_EMAIL))
        {
            if(str_contains($request->userid, '@g.batstate-u.edu.ph')){
                $rules['userid'] .= '|exists:accounts,gsuite_email';
                $this->userid_type = 'gsuite_email';
            }
            else{
                $rules['userid'] .= '|exists:accounts,email';
                $this->userid_type = 'email';
            }          
        }
        else
        {
            $rules['userid'] .= '|exists:accounts,sr_code';
            $this->userid_type = 'sr_code';
        }

        $validator = Validator::make( $request->all(), $rules, $message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        else{
            $user = login_model::where($this->userid_type,'=',$request->userid)->first();

            if(Hash::check($request->pass, $user->password)){
                $request->session()->put('userid_gsuite_email', $user->gsuite_email);
                $request->session()->put('user_type', $user->acc_type);
                return redirect($user->acc_type);
            }
            else{
                return redirect()->back()->withErrors(['pass' => 'Incorrect password!'])->withInput($request->all());
            }
            
        }
    }

    public function logout(){
        Session::flush();

        return redirect('/');
    }
}
