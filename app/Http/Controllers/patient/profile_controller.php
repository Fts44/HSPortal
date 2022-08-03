<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;

class profile_controller extends Controller
{
    public function __construct(){

    }

    public function update(Request $request){
        $rules = [
            'email' => ['required','unique:accounts,email'],
            'sr_code' => ['required','unique:accounts,sr_code'],


            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],

            'gender' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'in:single,married,widowed,divorced'],
            'contact' => ['required'],

            'home_prov' => ['required'],
            'home_mun' => ['required'],
            'home_brgy' => ['required'],

            'birth_prov' => ['required'],
            'birth_mun' => ['required'],
            'birth_brgy' => ['required'],

            'religion' => ['required'],
            'birthdate' => ['required','date'],
            'classification' => ['required','in:student,teacher,school personnel'],
            'grade_level' => ['required','exists:grade_level,gl_id'],
        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            echo json_encode($validator->messages());
            // return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
    }

    public function index(){
        $active_page = 'profile';
        $personal_info = DB::table('accounts')->where('id', session('user_id'))->first();

        $home_add = DB::table('address')->where('id', $personal_info->home_address_id)->first();
        $birth_add = DB::table('address')->where('id', $personal_info->birth_address_id)->first();
        $dorm_add = DB::table('address')->where('id', $personal_info->dorm_address_id)->first();

        // echo json_encode($personal_info);
        return view("patient.profile")->with(compact('active_page', 'personal_info', 'home_add', 'birth_add', 'dorm_add'));
    }
}
