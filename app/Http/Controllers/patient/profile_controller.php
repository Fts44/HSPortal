<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class profile_controller extends Controller
{
    public function __construct(){

    }

    public function update_personal_info(Request $request, $id){
        $rules = [
            'gsuite_email' => ['email','unique:accounts,gsuite_email,'.$id.',id'],
            'email' => ['required','email','unique:accounts,email,'.$id.',id'],
            'sr_code' => ['required','unique:accounts,sr_code,'.$id.',id'],


            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],

            'gender' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'in:single,married,widowed,divorced'],
            'contact' => ['required','unique:accounts,contact,'.$id.',id'],

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
        }
        else{
            try{
                DB::transaction(function () use($request, $id) {
                    // 'dorm_address_id'
                    $user_details = DB::table('accounts')->where('id', $id)->first();

                    if($user_details->home_address_id!=NULL){
                        DB::table('address')->where('id', $user_details->home_address_id)
                        ->update([
                            'province' => $request->home_prov,
                            'municipality' => $request->home_mun,
                            'barangay' => $request->home_brgy
                        ]);
                    }
                    else{
                        $user_details->home_address_id = DB::table('address')->insertGetId([
                            'province' => $request->home_prov,
                            'municipality' => $request->home_mun,
                            'barangay' => $request->home_brgy
                        ]);
                    }

                    if($user_details->birth_address_id!=NULL){
                        DB::table('address')->where('id', $user_details->birth_address_id)
                        ->update([
                            'province' => $request->birth_prov,
                            'municipality' => $request->birth_mun,
                            'barangay' => $request->birth_brgy
                        ]);
                    }
                    else{
                        $user_details->birth_address_id = DB::table('address')->insertGetId([
                            'province' => $request->birth_prov,
                            'municipality' => $request->birth_mun,
                            'barangay' => $request->birth_brgy
                        ]);
                    }

                    if($user_details->dorm_address_id){
                        if(!$request->dorm_prov){
                            DB::table('address')->where('id', $user_details->dorm_address_id)
                            ->update([
                                'province' => $request->dorm_prov,
                                'municipality' => $request->dorm_mun,
                                'barangay' => $request->dorm_brgy
                            ]);
                        }
                        else{
                            DB::table('address')->where('id', $user_details->dorm_address_id)
                            ->delete();
                            $user_details->dorm_address_id = NULL;
                        }
                    }
                    else{
                        if($request->dorm_prov){
                            $user_details->dorm_address_id = DB::table('address')->insertGetId([
                                'province' => $request->dorm_prov,
                                'municipality' => $request->dorm_mun,
                                'barangay' => $request->dorm_brgy
                            ]);
                        }
                        
                    }

                    DB::table('accounts')->where('id', $id)
                    ->update([
                        'gsuite_email' => $request->gsuite_email,
                        'email' => $request->email,
                        'contact' => $request->contact,
                        'first_name' => $request->first_name,
                        'middle_name' => $request->middle_name,
                        'last_name' => $request->last_name,
                        'suffix_name' => $request->suffix_name,
                        'birthdate' => $request->birthdate,
                        'gender' => $request->gender,
                        'civil_status' => $request->civil_status,
                        'religion' => $request->religion,
                        'home_address_id' => $user_details->home_address_id,
                        'birth_address_id' => $user_details->birth_address_id,
                        'dorm_address_id' => $user_details->dorm_address_id,
                        'classification' => $request->classification,
                        'gl_id' => $request->grade_level,
                        'dept_id' => $request->department,
                        'prog_id' => $request->program,
                    ]);
                });
                return redirect()->back()->withInput($request->all());
            } 
            catch (Exception $e) {
                
            }
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
