@extends('layouts.patient_main')

@push('title')
    <title>Patient Profile</title>
@endpush


@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-emergency-contact">Emergency Contact</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Password</button>
                            </li>

                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade pt-3 active show" id="profile-edit">
                                
                                    <!-- Profile Edit Form -->
                                <form>
                                    <fieldset class="border p-3 pt-0">
                                        <legend  class="float-none w-auto text-center"><h5>Personal Information</h5></legend>

                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-lg-2 col-form-label">Profile Image</label>
                                            <div class="col-lg-6">
                                                <img class="p-2 border" src="{{ asset('images/logo.png') }}" alt="Profile" style="width: 175px;">
                                                <div class="pt-2">
                                                    <input type="file" name="profile_pic">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="gsuite_email">Gsuite Email:</label>
                                            <div class="col-lg-4">
                                                <input name="gsuite_email" id="gsuite_email" type="text" class="form-control" placeholder="example@g.batstate-u.edu.ph">
                                            </div>

                                            <label class="col-lg-2 col-form-label" for="email">Personal Email:</label>
                                            <div class="col-lg-4">
                                                <input name="email" id="email" type="text" class="form-control" placeholder="example@email.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label">Name:</label>
                                            <div class="col-lg-3">
                                                <input name="first_name" type="text" class="form-control" placeholder="First">
                                            </div>
                                            <div class="col-lg-3 mt-1">
                                                <input name="middle_name" type="text" class="form-control" placeholder="Middle">
                                            </div>
                                            <div class="col-lg-3 mt-1">
                                                <input name="last_name" type="text" class="form-control" placeholder="Last">
                                            </div>
                                        </div>  

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="sr_code">SR-Code:</label>
                                            <div class="col-lg-4">
                                                <input name="sr_code" id="sr_code" type="text" class="form-control" placeholder="Ex: 12-34567">
                                            </div>
                                            
                                            <label class="col-lg-2 col-form-label" for="contact">Contact:</label>
                                            <div class="col-lg-4">
                                                <input name="contact" id="contact" type="text" class="form-control" placeholder="Ex: 09123456789">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="gsuite_email">Home Address:</label>
                                            <div class="col-lg-8">
                                                <div class="form-control pe-0 text-black-75" style="width: 100%;">
                                                    <select class="border-0" name="home_brgy" id="home_brgy" style="width: 32%;">
                                                        <option value="">Choose Province</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="home_brgy" id="home_brgy" style="width: 32%;">
                                                        <option value="">Choose Municipality</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="home_brgy" id="home_brgy" style="width: 33%;">
                                                        <option value="">Choose Barangay</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label">Gender:</label>
                                            <div class="col-lg-3 col-form-label text-center">
                                                <input class="form-check-input"  name="gender" id="female" type="radio" value="female">
                                                <label class="form-check-label" for="female">Female</label>
                                    
                                                <input class="form-check-input ms-4" name="gender" id="male" type="radio" value="male">
                                                <label class="form-check-label" for="male">Male:</label>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <label class="col-lg-2 col-form-label" for="civil_status">Civil Status:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="civil_status" id="civil_status">
                                                    <option value="">Choose</option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="widowed">Widowed</option>
                                                    <option value="divorced">Divorced</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="religion">Religion:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="religion" id="religion">
                                                    <option value="">Choose</option>
                                                    <option value="roman catholic">Roman Catholic</option>
                                                    <option value="iglesia ni cristo">Iglesia ni Cristo</option>
                                                    <option value="baptist">Baptist</option>
                                                    <option value="born again">Born Again</option>
                                                </select>
                                            </div>

                                            <label class="col-lg-2 col-form-label" for="birth_date">Birthdate:</label>
                                            <div class="col-lg-4">
                                                <input name="birth_date" id="birth_date" type="date" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label">Birth Place:</label>
                                            <div class="col-lg-8">
                                                <div class="form-control pe-0 text-black-75" style="width: 100%;">
                                                    <select class="border-0" name="birth_prov" id="birth_prov" style="width: 32%;">
                                                        <option value="">Choose Province</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="birth_mun" id="birth_mun" style="width: 32%;">
                                                        <option value="">Choose Municipality</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="birth_brgy" id="birth_brgy" style="width: 33%;">
                                                        <option value="">Choose Barangay</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="classification">Classification:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="classification" id="classification">
                                                    <option value="">Choose</option>
                                                    <option value="student">Student</option>
                                                    <option value="teacher">Teacher</option>
                                                    <option value="school personnel">School Personnel</option>
                                                </select>
                                            </div>
                                            
                                            <label class="col-lg-2 col-form-label" for="grade_level">Grade level:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="grade_level" id="grade_level">
                                                    <option value="">Choose</option>
                                                    <option value="elementary">Elementary</option>
                                                    <option value="junior high school">Junior High School</option>
                                                    <option value="senior high school">Senior High School</option>
                                                    <option value="college">College</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="department">Department:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="department" id="department">
                                                    <option value="">Choose</option>
                                                    <option value="1">sample</option>
                                                </select>
                                            </div>
                                            
                                            <label class="col-lg-2 col-form-label" for="program">Program:</label>
                                            <div class="col-lg-4">
                                                <select class="form-select" name="program" id="program">
                                                    <option value="">Choose</option>
                                                    <option value="1">sample</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </fieldset>

                                </form>
                                
                                <!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-emergency-contact">
                                <form action="">
                                    <fieldset class="border p-3 pt-0">
                                        <legend  class="float-none w-auto text-center"><h5>Emergency Contact</h5></legend>
                                        
                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label">Name:</label>
                                            <div class="col-lg-3">
                                                <input name="emerg_fn" type="text" class="form-control" placeholder="First">
                                            </div>
                                            <div class="col-lg-3 mt-1">
                                                <input name="emerg_mn" type="text" class="form-control" placeholder="Middle">
                                            </div>
                                            <div class="col-lg-3 mt-1">
                                                <input name="emerg_ln" type="text" class="form-control" placeholder="Last">
                                            </div>
                                        </div> 
                                           
                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="emerg_relation">Relation:</label>
                                            <div class="col-lg-4">
                                                <input name="emerg_relation" id="emerg_relation" type="text" class="form-control" placeholder="Father">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label" for="emerg_landline">Landline:</label>
                                            <div class="col-lg-4">
                                                <input name="emerg_landline" id="emerg_landline" type="text" class="form-control" placeholder="12-345-3575">
                                            </div>

                                            <label class="col-lg-2 col-form-label" for="emerg_contact">Contact:</label>
                                            <div class="col-lg-4">
                                                <input name="emerg_contact" id="emerg_contact" type="text" class="form-control" placeholder="09123456789">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-lg-2 col-form-label pe-0">Business Address:</label>
                                            <div class="col-lg-8">
                                                <div class="form-control pe-0 text-black-75" style="width: 100%;">
                                                    <select class="border-0" name="emerg_biz_prov" id="emerg_biz_prov" style="width: 32%;">
                                                        <option value="">Choose Province</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="emerg_biz_mun" id="emerg_biz_mun" style="width: 32%;">
                                                        <option value="">Choose Municipality</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                    <select class="border-0" name="emerg_biz_brgy" id="emerg_biz_brgy" style="width: 33%;">
                                                        <option value="">Choose Barangay</option>
                                                        <option value="1">sample</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>

                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection


@push('script')

@endpush