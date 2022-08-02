<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class populate_select_controller extends Controller
{
    public function grade_level(){
        $grade_levels = DB::table('grade_level')->orderBy('gl_name', 'ASC')->get();
        return json_encode($grade_levels);
    }

    public function department($grade_level){

        if($grade_level == 'all'){
            $departments = DB::table('department')->orderBy('dept_code', 'ASC')->get();
        }
        else{
            $departments = DB::table('department')->where('gl_id','=',$grade_level)->orderBy('dept_code', 'ASC')->get();
        }

        return json_encode($departments);
    }

    public function program($department){

        if($department == 'all'){
            $programs = DB::table('program')->orderBy('prog_code', 'ASC')->get();
        }
        else{
            $programs = DB::table('program')->where('dept_id','=',$department)->orderBy('prog_code', 'ASC')->get();
        }

        return json_encode($programs);
    }
}
