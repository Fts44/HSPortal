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
        $grade_levels = DB::table('grade_level')->get();
        $programs = DB::table('program')
            ->join('department', 'program.dept_id', '=', 'department.dept_id')
            ->join('grade_level', 'department.gl_id', '=', 'grade_level.gl_id')
            ->get();
        //echo json_encode($programs);  
        return view('admin.configuration.education.program')->with(compact('grade_levels','programs'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'department' => 'required|exists:department,dept_id',
            'code' => 'required|unique:program,prog_code',
            'name' => 'required|unique:program,prog_name',
        ]);

        if($validator->fails()){
            //echo json_encode($validator->messages());
            $url = $request->url();
            $action = 'insert';
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        else{
            try {
                $grade_level = DB::table('program')->insert([
                    'dept_id' => $request->department,
                    'prog_code' => $request->code,
                    'prog_name' => $request->name
                ]);
                $message = 'Program inserted!';
                return redirect()->back()->with('success', $message);
            }catch (Exception $e) {
                $message = 'Program not inserted! Try again later!';
                return redirect()->back()->with('failed', $message);
            }
        }
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
        $validator = Validator::make($request->all(),[
            'department' => 'required|exists:department,dept_id',
            'code' => 'required|unique:program,prog_code,'.$id.',prog_id',
            'name' => 'required|unique:program,prog_name,'.$id.',prog_id'
        ]);

        if($validator->fails()){
            //echo json_encode($request->name);
            $url = $request->url();
            $action = 'update';
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        else{
            try {
                $query = DB::table('program')->where('prog_id', $id)->update([
                    'dept_id' => $request->department,
                    'prog_code' => $request->code,
                    'prog_name' => $request->name
                ]);
                $message = 'Program updated!';
                return redirect()->back()->with('success', $message);
            }catch (Exception $e) {
                $message = 'Program not updated! Try again later!';
                return redirect()->back()->with('failed', $message);
            }
        }
    }

   
    public function destroy($id)
    {
        try {
            $query = DB::table('program')->where('prog_id', $id)->delete();
            $message = 'Program deleted!';
            return redirect()->back()->with('success', $message);
        }catch (Exception $e) {
            $message = 'Program not deleted! Try again later!';
            return redirect()->back()->with('failed', $message);
        }
    }
}
