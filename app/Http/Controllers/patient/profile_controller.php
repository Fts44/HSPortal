<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;

class profile_controller extends Controller
{
    public function update_emergency_contact(Request $request, $id){
        Session()->put('active_page', 'emergency_contact');
        $rules = [
            'emerg_fn' => ['required'],
            'emerg_mn' => ['required'],
            'emerg_ln' => ['required'],
            'emerg_contact' => ['required'],
            'emerg_relation' => ['required'],
            'emerg_prov' => ['required'],
            'emerg_mun' => ['required'],
            'emerg_brgy' => ['required']
        ];

        $message = [
            'emerg_fn.required' => 'Firstname is required.',
            'emerg_mn.required' => 'Middlename is required',
            'emerg_ln.required' => 'Lastname is required',
            'emerg_contact.required' => 'Contact is required',
            'emerg_relation.required' => 'Relation is required',
            'emerg_prov.required' => 'Province is required',
            'emerg_mun.required' => 'Municipality is required',
            'emerg_brgy.required' => 'Barangay is required'
        ];

        $validator = Validator::make( $request->all(), $rules, $message);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, Emergency contact not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
        }
        else{
            try{
                DB::transaction(function() use($request, $id) {
                    $emerg_id = DB::table('accounts')->where('id', $id)->first()->emergency_contact_id;
                    $emerg_details = DB::table('emergency_contact')->where('id', $emerg_id)->first();
    
                    if(!$emerg_details){
                        $emerg_address_id = DB::table('address')->insertGetId([
                            'province' => $request->emerg_prov,
                            'municipality' => $request->emerg_mun,
                            'barangay' => $request->emerg_brgy
                        ]);
    
                        $emerg_details_id = DB::table('emergency_contact')->insertGetId([
                            'first_name' => $request->emerg_fn,
                            'middle_name' => $request->emerg_mn,
                            'last_name' => $request->emerg_ln,
                            'suffix_name' => $request->emerg_sn,
                            'relation' => $request->emerg_relation,
                            'landline' => $request->emerg_landline,
                            'contact' => $request->emerg_contact,
                            'biz_address_id' => $emerg_address_id
                        ]);
    
                        DB::table('accounts')->where('id', $id)->update([
                            'emergency_contact_id' => $emerg_details_id
                        ]);
                    }
                    else{
                        DB::table('address')->where('id', $emerg_details->biz_address_id)->update([
                            'province' => $request->emerg_prov, 
                            'municipality' => $request->emerg_mun,
                            'barangay' => $request->emerg_brgy
                        ]);

                        DB::table('emergency_contact')->where('id', $emerg_id)->update([
                            'first_name' => $request->emerg_fn,
                            'middle_name' => $request->emerg_mn,
                            'last_name' => $request->emerg_ln,
                            'suffix_name' => $request->emerg_sn,
                            'relation' => $request->emerg_relation,
                            'landline' => $request->emerg_landline,
                            'contact' => $request->emerg_contact
                        ]);
                    }
                    
                });
                $response = [
                    'title' => 'Success!',
                    'message' => 'Emergency contact updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)->withInput($request->all());
            }
            catch(Exception $e){

            }
        }
       // return redirect()->back();
 
    }

    public function update_personal_info(Request $request, $id){
        Session()->put('active_page', 'profile');
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
            'department' => ['required'],
            'program' => ['required']
        ];

        $validator = Validator::make( $request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, Information not updated.',
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response, true);
            return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
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

                $response = [
                    'title' => 'Success!',
                    'message' => 'Personal information updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)->withInput($request->all());
            } 
            catch (Exception $e) {
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Personal information not updated.',
                    'icon' => 'error',
                    'status' => 400
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)->withInput($request->all());
            }
        }
    }

    public function index(){
        $personal_info = DB::table('accounts')->where('id', session('user_id'))->first();

        $home_add = DB::table('address')->where('id', $personal_info->home_address_id)->first();
        $birth_add = DB::table('address')->where('id', $personal_info->birth_address_id)->first();
        $dorm_add = DB::table('address')->where('id', $personal_info->dorm_address_id)->first();

        $emerg_info = DB::table('emergency_contact')->where('id', $personal_info->emergency_contact_id)->first();

        if($emerg_info){
            $emerg_biz_add = DB::table('address')->where('id', $emerg_info->biz_address_id)->first();
        }
        else{
            $emerg_biz_add = [
                'province' => '',
                'municipality' => '',
                'barangay' => ''
            ];
            $emerg_info = [
                'first_name' => '',
                'middle_name' => '',
                'last_name' => '',
                'suffix_name' => '',
                'relation' => '',
                'landline' => '',
                'contact' => ''
            ];
        }
        $emerg_biz_add = (object)$emerg_biz_add;
        $emerg_info = (object)$emerg_info;
        return view("patient.profile")->with(compact('personal_info', 'home_add', 'birth_add', 'dorm_add','emerg_info','emerg_biz_add'));
    }
}
