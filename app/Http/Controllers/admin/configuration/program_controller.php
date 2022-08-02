<?php

namespace App\Http\Controllers\admin\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;

class program_controller extends Controller
{
   
    public function index()
    {
        $departments = DB::table('department')->get();
        $grade_levels = DB::table('grade_level')->get();
        // $departments = DB::table('department')
        //     ->join('grade_level', 'department.gl_id', '=', 'grade_level.gl_id')
        //     ->get();

        //echo json_encode($departments);
        return view('admin.configuration.education.program')->with(compact('grade_levels','departments'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
