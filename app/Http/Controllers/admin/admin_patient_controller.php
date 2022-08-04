<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class admin_patient_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = DB::select("
        SELECT 
        acc.id, acc.sr_code, acc.gsuite_email, acc.email, acc.contact, 
        acc.first_name, acc.middle_name, acc.last_name, acc.suffix_name,
        acc.birthdate, acc.gender, acc.civil_status, acc.religion, acc.classification, acc.position,
        acc.profile_pic, acc.is_verified, 
        dept.dept_code AS department, gl.gl_name AS grade_level, prog.prog_code AS program,
        home.province as home_prov, home.municipality as home_mun, home.barangay as home_brgy,
        birth.province as birth_prov, birth.municipality as birth_mun, birth.barangay as birth_brgy,
        dorm.province as dorm_prov, dorm.municipality as dorm_mun, dorm.barangay as dorm_brgy,
        emerg.first_name AS emerg_fn, emerg.middle_name AS emerg_mn, emerg.last_name AS emerg_ln, emerg.suffix_name AS emerg_sn,
        emerg.relation AS emerg_relation, emerg.landline AS emerg_landline, emerg.contact AS emerg_contact,
        emerg_biz.province AS emerg_biz_prov, emerg_biz.municipality AS emerg_biz_mun, emerg_biz.barangay AS emerg_biz_brgy
        FROM `accounts` AS `acc`
        LEFT JOIN `grade_level` AS `gl`
        ON acc.gl_id = gl.gl_id
        LEFT JOIN `department` AS `dept`
        ON acc.dept_id = dept.dept_id
        LEFT JOIN `program` AS `prog`
        ON acc.prog_id = prog.prog_id
        LEFT JOIN `address` AS `home`
        ON acc.home_address_id = home.id
        LEFT JOIN `address` AS `birth`
        ON acc.birth_address_id = birth.id
        LEFT JOIN `address` AS `dorm`
        ON acc.dorm_address_id = dorm.id
        LEFT JOIN `emergency_contact` AS `emerg`
        ON acc.emergency_contact_id = emerg.id
        LEFT JOIN `address` AS `emerg_biz`
        ON emerg.id = emerg_biz.id
        WHERE acc.position = 'patient'
        ");
        //echo json_encode($patients);
        return view('admin.profilepatient', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
