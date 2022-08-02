<?php

namespace App\Http\Controllers\admin\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;

class department_controller extends Controller
{
    public function index()
    {
        $grade_levels = DB::table('grade_level')->get();

        $departments = DB::table('department')
            ->join('grade_level', 'department.gl_id', '=', 'grade_level.gl_id')
            ->get();

        // echo json_encode($departments);
        return view('admin.configuration.education.department')->with(compact('grade_levels', 'departments'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'grade_level' => 'required|exists:grade_level,gl_id',
            'code' => 'required|unique:department,dept_code',
            'name' => 'required|unique:department,dept_name'
        ]);

        if($validator->fails()){
            //echo json_encode($validator->messages());
            $url = $request->url();
            $action = 'insert';
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        else{
            try {
                $grade_level = DB::table('department')->insert([
                    'gl_id' => $request->grade_level,
                    'dept_code' => $request->code,
                    'dept_name' => $request->name,
                ]);
                $message = 'Department inserted!';
                return redirect()->back()->with('success', $message);
            }catch (Exception $e) {
                $message = 'Department not inserted! Try again later!';
                return redirect()->back()->with('failed', $message);
            }
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'grade_level' => 'required|exists:grade_level,gl_id',
            'code' => 'required|unique:department,dept_code,'.$id.',dept_id',
            'name' => 'required|unique:department,dept_name,'.$id.',dept_id'
        ]);

        if($validator->fails()){
            //echo json_encode($request->name);
            $url = $request->url();
            $action = 'update';
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        else{
            try {
                $query = DB::table('department')->where('dept_id', $id)->update([
                    'gl_id' => $request->grade_level,
                    'dept_code' => $request->code,
                    'dept_name' => $request->name,
                ]);
                $message = 'Department updated!';
                return redirect()->back()->with('success', $message);
            }catch (Exception $e) {
                $message = 'Department not updated! Try again later!';
                return redirect()->back()->with('failed', $message);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $grade_level = DB::table('department')->where('dept_id', $id)->delete();
            $message = 'Department deleted!';
            return redirect()->back()->with('success', $message);
        }catch (Exception $e) {
            $message = 'Department not deleted! Try again later!';
            return redirect()->back()->with('failed', $message);
        }
    }

    
}
