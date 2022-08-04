@extends('layouts.patient_main')

@push('title')
    <title>Patient Profile</title>
@endpush


@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Personal Info</h1>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            @php
                                if(session()->has('active_page')){
                                    $active_page = session()->get('active_page');
                                }
                                else{
                                    $active_page = 'profile';
                                }
                            @endphp

                            <li class="nav-item">
                                <button class="nav-link {{ ($active_page=='profile')?'active':'' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link {{ ($active_page=='emergency_contact')?'active':'' }}" data-bs-toggle="tab" data-bs-target="#profile-emergency-contact">Emergency Contact</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link {{ ($active_page=='password')?'active':'' }}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Password</button>
                            </li>

                        </ul>
                        
                        <!-- Profile Edit Form -->
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade p-3  {{($active_page=='profile')?'active show':''}}" id="profile-edit">

                                <form method="POST" enctype="multipart/form-data" action="{{ url('patient/updatemyprofile/'.session()->get('user_id')) }}">
                                   
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label d-flex justify-content-center" for="profile_pic">Profile Picture</label>
                                        <div class="col-lg-12 mt-1 d-flex justify-content-center">
                                            <img class="form-control p-2" src="{{ ($personal_info->profile_pic) ? asset('storage/profile_pictures/'.$personal_info->profile_pic) : asset('storage/profile_pictures/default.png') }}" alt="Upload image" style="height: 200px; width: 200px;">
                                        </div>
                                        <div class="col-lg-12 mt-3 d-flex justify-content-center">
                                            <input class="w-50 form-control" type="file" name="profile_pic" id="profile_pic" accept=".jpg,.png">
                                        </div>
                                    </div>

                                    <div class="row mb-3">  
                                        <div class="col-lg-6">
                                            <label class="col-lg-12 col-form-label" for="gsuite_email">Gsuite Email</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="gsuite_email" id="gsuite_email" type="text" class="form-control" placeholder="abc@g.batstate-u.edu.ph" value="{{ $personal_info->gsuite_email }}" {{ ($personal_info->gsuite_email != null) ? 'readonly' : '' }}>
                                            </div>
                                            <span class="text-danger">
                                                @error('gsuite_email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="col-lg-6 {{ ($personal_info->gsuite_email != null) ? 'd-none' : '' }}">
                                            <div class="row">
                                                <label for="otp" class="col-lg-12 col-form-label ">One Time Pin</label>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 mt-1">
                                                            <input type="text" class="form-control" placeholder="OTP" name="otp" id="otp">
                                                            <span class="text-danger">
                                                                @error('otp')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <a class="btn btn-secondary" style="width: 100%;" id="btn_otp">
                                                                <span class="spinner-border spinner-border-sm d-none" id="lbl_loading" role="status" aria-hidden="true"></span>
                                                                <span id="lbl_otp"> Get otp</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-8">
                                            <label class="col-lg-12 col-form-label" for="email">Personal Email</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="email" id="email" type="text" class="form-control"  placeholder="abc@example.com"  value="{{   old('email',$personal_info->email) }}" >
                                            </div>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>   
                                        
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="sr_code">SR-Code:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="sr_code" id="sr_code" type="text" class="form-control" placeholder="12-34567"  value="{{ old('sr_code',$personal_info->sr_code) }}" >
                                            </div>
                                            <span class="text-danger">
                                                @error('sr_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="col-lg-12 col-form-label">Name</label>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="first_name" type="text" class="form-control" placeholder="First"  value="{{ old('first_name',$personal_info->first_name) }}" >
                                                            <span class="text-danger">
                                                                @error('first_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="middle_name" type="text" class="form-control" placeholder="Middle"  value="{{ old('middle_name',$personal_info->middle_name) }}" >
                                                            <span class="text-danger">
                                                                @error('middle_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 mt-1">
                                                            <input name="last_name" type="text" class="form-control" placeholder="Last" value="{{ old('last_name',$personal_info->last_name) }}" >
                                                            <span class="text-danger">
                                                                @error('last_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-2 mt-1">
                                                    <input name="suffix_name" type="text" class="form-control" placeholder="Suffix" value="{{ old('suffix_name',$personal_info->suffix_name) }}" >
                                                </div>
                                            </div>
                                            
                                        </div>           
                                    </div>  

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div class="col-lg-12">
                                                <label for="" class="col-lg-12  col-form-label">Gender</label>
                                                <div class="col-lg-12 mt-1 text-center">
                                                    <select class="form-select" name="gender" id="gender">
                                                        <option value="">Choose</option>
                                                        <option value="male" {{ (old('gender',$personal_info->gender)=='male') ? 'selected' : '' }} >Male</option>
                                                        <option value="female" {{ (old('gender',$personal_info->gender)=='female') ? 'selected' : '' }} >Female</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger">
                                                    @error('gender')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="civil_status">Civil Status:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="civil_status" id="civil_status">
                                                    <option value="">Choose</option>
                                                    <option value="single" {{ (old('civil_status',$personal_info->civil_status)=='single') ? 'selected' : '' }} >Single</option>
                                                    <option value="married" {{ (old('civil_status',$personal_info->civil_status)=='married') ? 'selected' : '' }} >Married</option>
                                                    <option value="widowed" {{ (old('civil_status',$personal_info->civil_status)=='widowed') ? 'selected' : '' }} >Widowed</option>
                                                    <option value="divorced" {{ (old('civil_status',$personal_info->civil_status)=='divorced') ? 'selected' : '' }} >Divorced</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('civil_status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="contact" class="col-lg-12 col-form-label">Contact Number</label>
                                            <input type="tel" class="form-control mt-1" name="contact" id="contact" value="{{ old('contact',$personal_info->contact) }}" >
                                            <span class="text-danger">
                                                @error('contact')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label" for="home_prov">Home Address</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_prov" id="home_prov">
                                                <option value="">Choose Province</option>
                                            </select>  
                                            <span class="text-danger">
                                                @error('home_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span>      
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_mun" id="home_mun">
                                                <option value="">Choose Municipality</option>
                                            </select>  
                                            <span class="text-danger">
                                                @error('home_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span>       
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="home_brgy" id="home_brgy">
                                                <option value="">Choose Barangay</option>
                                            </select> 
                                            <span class="text-danger">
                                                @error('home_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span>        
                                        </div>  
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="religion">Religion:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input type="text" class="form-control" name="religion" id="religion" value="{{ old('religion',$personal_info->religion) }}">
                                            </div>
                                            <span class="text-danger">
                                                @error('religion')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="birthdate">Birthdate:</label>
                                            <div class="col-lg-12 mt-1">
                                                <input name="birthdate" id="birthdate" type="date" class="form-control" value="{{ old('birthdate',$personal_info->birthdate) }}">
                                            </div>
                                            <span class="text-danger">
                                                @error('birthdate')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="classification">Classification:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="classification" id="classification">
                                                    <option value="">Choose</option>
                                                    <option value="student" {{ (old('classification',$personal_info->classification)=='student') ? 'selected' : '' }} >Student</option>
                                                    <option value="teacher" {{ (old('classification',$personal_info->classification)=='teacher') ? 'selected' : '' }} >Teacher</option>
                                                    <option value="school personnel" {{ (old('classification',$personal_info->classification)=='school personnel') ? 'selected' : '' }} >School Personnel</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('classification')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>  
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label">Place of Birth</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_prov" id="birth_prov">
                                                <option value="">Choose Province</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_mun" id="birth_mun">
                                                <option value="">Choose Municipality</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="birth_brgy" id="birth_brgy">
                                                <option value="">Choose Barangay</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('birth_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="grade_level">Grade level:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="grade_level" id="grade_level">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('grade_level')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="department">Department:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="department" id="department">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('department')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-lg-12 col-form-label" for="program">Program:</label>
                                            <div class="col-lg-12 mt-1">
                                                <select class="form-select" name="program" id="program">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('program')
                                                    {{ $message }}
                                                @enderror
                                            </span> 
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label">Dorm Address (If any)</label>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_prov" id="dorm_prov">
                                                <option value="">Choose Province</option>
                                            </select>        
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_mun" id="dorm_mun">
                                                <option value="">Choose Municipality</option>
                                            </select>        
                                        </div>
                                        <div class="col-lg-4 mt-1">
                                            <select class="form-select" name="dorm_brgy" id="dorm_brgy">
                                                <option value="">Choose Barangay</option>
                                            </select>        
                                        </div>  
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form>

                            </div>
                            <!-- End Profile Edit Form -->

                            <!-- emergency contact form -->
                            <div class="tab-pane fade p-3 {{ ($active_page=='emergency_contact')?'active show':'' }}" id="profile-emergency-contact">

                                <form method="POST" action="{{ url('patient/updatemyemergencycontact/'.session()->get('user_id')) }}">
                                    
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-lg-12 col-form-label" for="">Name</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_fn" id="emerg_fn" placeholder="First" value="{{ old('emerg_fn',$emerg_info->first_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_fn')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_mn" id="emerg_mn" placeholder="Middle" value="{{ old('emerg_mn',$emerg_info->middle_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_mn')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 mt-1">
                                                    <input class="form-control" type="text" name="emerg_ln" id="emerg_ln" placeholder="Last" value="{{ old('emerg_ln',$emerg_info->last_name) }}">
                                                    <span class="text-danger">
                                                        @error('emerg_ln')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mt-1">
                                            <input class="form-control" type="text" name="emerg_sn" id="emerg_sn" placeholder="Suffix" value="{{ old('emerg_suffix',$emerg_info->suffix_name) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label for="emerg_landline" class="col-lg-12 col-form-label">Landline</label>
                                            <input class="form-control mt-1" type="text" placeholder="" name="emerg_landline" id="emerg_landline" value="{{ old('emerg_landline',$emerg_info->landline) }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="emerg_contact" class="col-lg-12 col-form-label">Contact Number</label>
                                            <input class="form-control mt-1" type="tel"  placeholder="09123456789" name="emerg_contact" id="emerg_contact" value="{{ old('emerg_contact',$emerg_info->contact) }}">
                                            <span class="text-danger">
                                                @error('emerg_contact')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="emerg_relation" class="col-lg-12 col-form-label">Relation to you</label>
                                            <input type="text" class="form-control mt-1" name="emerg_relation" id="emerg_relation" placeholder="" value="{{ old('emerg_relation',$emerg_info->relation) }}">
                                            <span class="text-danger">
                                                @error('emerg_relation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="" class="col-lg-12 col-form-label">Bussiness Address</label>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_prov" id="emerg_prov">
                                                <option value="">Choose Province</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_prov')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_mun" id="emerg_mun">
                                                <option value="">Choose Municipality</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_mun')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-select mt-1" name="emerg_brgy" id="emerg_brgy">
                                                <option value="">Choose Barangay</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('emerg_brgy')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                      
                                </form>

                            </div>
                            <!-- emergency contact form -->

                            <!-- Change Password Form -->
                            <div class="tab-pane fade p-3  {{($active_page=='password')?'active show':''}}" id="profile-change-password">
                               
                                <form method="POST" action="{{ url('patient/updatemypassword/'.session()->get('user_id')) }}">
                                    
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="new_pass" class="col-lg-12 col-form-label">New Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="new_pass" id="new_pass" value="{{ old('new_pass') }}">
                                            <span class="text-danger">
                                                @error('new_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="confirm_pass" class="col-lg-12 col-form-label">Confirm Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" value="{{ old('confirm_pass') }}">
                                            <span class="text-danger">
                                                @error('confirm_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="old_pass" class="col-lg-12 col-form-label">Old Password</label>
                                        <div class="col-lg-5 mt-1">  
                                            <input class="form-control" type="password" name="old_pass" id="old_pass" value="{{ old('old_pass') }}">
                                            <span class="text-danger">
                                                @error('old_pass')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-lg-5 mt-1">
                                        <input class="showpassword" type="checkbox" name="showpassword" id="showpassword"> 
                                        <label for="showpassword">Show password</label>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form><!-- End Change Password Form -->

                            </div>
                            <!-- Change Password Form -->

                        </div>
                        <!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

  </main>
  <!-- main -->

@endsection


@push('script')
    <script>
        $(document).ready(function(){
            @if(session('status'))  
                @php 
                    $status = json_decode(session('status'));                      
                @endphp
                swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
            @endif

            // ============================= personal information ===================================
            
            get_set_province('#home_prov','{{ old("home_prov",$home_add->province) }}');
            get_set_municipality('#home_mun','{{ old("home_mun",$home_add->municipality) }}','{{ old("home_prov",$home_add->province) }}');
            get_set_barangay('#home_brgy','{{ old("home_brgy",$home_add->barangay) }}','{{ old("home_mun",$home_add->municipality) }}');
        
            get_set_province('#birth_prov','{{ old("birth_prov",$birth_add->province) }}');
            get_set_municipality('#birth_mun','{{ old("birth_mun",$birth_add->municipality) }}','{{ old("birth_prov",$birth_add->province) }}');
            get_set_barangay('#birth_brgy','{{ old("birth_brgy",$birth_add->barangay) }}','{{ old("birth_mun",$birth_add->municipality) }}');
            
            get_set_province('#dorm_prov','{{ old("dorm_prov",$dorm_add->province) }}');
            get_set_municipality('#dorm_mun','{{ old("dorm_mun",$dorm_add->municipality) }}','{{ old("dorm_prov",$dorm_add->province) }}');
            get_set_barangay('#dorm_brgy','{{ old("dorm_brgy",$dorm_add->barangay) }}','{{ old("dorm_mun",$dorm_add->municipality) }}');
            
            get_set_province('#emerg_prov','{{ old("emerg_prov",$emerg_biz_add->province) }}');
            get_set_municipality('#emerg_mun','{{ old("emerg_mun",$emerg_biz_add->municipality) }}','{{ old("emerg_prov",$emerg_biz_add->province) }}');
            get_set_barangay('#emerg_brgy','{{ old("emerg_brgy",$emerg_biz_add->barangay) }}','{{ old("emerg_mun",$emerg_biz_add->municipality) }}');
            
           
            $('#home_prov').change(function(){
                get_set_municipality('#home_mun','', $('#home_prov').val(), '#home_brgy');
            });
            $('#home_mun').change(function(){
                get_set_barangay('#home_brgy','', $('#home_mun').val());
            });

            $('#birth_prov').change(function(){
                get_set_municipality('#birth_mun','', $('#birth_prov').val(), '#birth_brgy');
                get_set_barangay('#birth_brgy','', $('#birth_mun').val());
            });
            $('#birth_mun').change(function(){
                get_set_barangay('#birth_brgy','', $('#birth_mun').val());
            });

            $('#dorm_prov').change(function(){
                get_set_municipality('#dorm_mun','', $('#dorm_prov').val(), '#dorm_brgy');
                get_set_barangay('#dorm_brgy','', $('#dorm_mun').val());
            });
            $('#dorm_mun').change(function(){
                get_set_barangay('#dorm_brgy','', $('#dorm_mun').val());
            });

            get_set_grade_level('#grade_level', "{{ old('grade_level',$personal_info->gl_id) }}");
            get_set_department('#department', "{{ old('department',$personal_info->dept_id) }}", "{{ old('grade_level',$personal_info->gl_id) }}");
            get_set_program('#program', "{{ old('program',$personal_info->prog_id) }}", "{{ old('department',$personal_info->dept_id) }}");

            $('#grade_level').change(function(){
                get_set_department('#department', "", $('#grade_level').val(), '#program');
            });
            $('#department').change(function(){
                get_set_program('#program', "", $('#department').val());
            })

            // ============================= personal information ===================================

            // ============================= emergency contact ===================================

            $('#emerg_prov').change(function(){
                get_set_municipality('#emerg_mun','', $('#emerg_prov').val(), '#emerg_brgy');
                get_set_barangay('#emerg_brgy','', $('#emerg_mun').val());
            });
            $('#emerg_mun').change(function(){
                get_set_barangay('#emerg_brgy','', $('#emerg_mun').val());
            });

             // ============================= emergency contact ===================================

             $('.showpassword').click(function(){            
                let input = $('#old_pass, #new_pass, #confirm_pass');
                if(input.attr('type') === 'password'){
                    input.attr('type','text');
                }
                else{
                    input.attr('type','password');
                }
            });

            // $('#btn_otp').click(function(e){
            //     e.preventDefault();
            //     let email = $('#email').val();

            //     $('.lbl_loading').removeClass('d-none');
            //     $('#btn_otp_lbl').addClass('d-none');

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ url('registration/send_otp') }}",
            //         contentType: 'application/json',
            //         data: JSON.stringify({
            //             "email": email,
            //             "msg_type": "register",
            //             "_token": "{{csrf_token()}}",
            //         }),
            //         success: function(response){
            //             console.log(response);
            //             $('.lbl_loading').addClass('d-none');
            //             $('#btn_otp_lbl').removeClass('d-none');

            //             if(response.status == 400){
            //                 $.each(response.errors, function(key, err_values){
            //                     $('#'+key+'_error').html(err_values);
            //                 });
            //             }
            //             else{
            //                 $('.error-message').html('');
            //                 swal(response.title, response.message, response.icon);
            //             }
            //         },
            //         error: function(response){
            //             console.log(response);
            //         }
            //     });
            // });
        });
    </script>
@endpush