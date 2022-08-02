<?php

namespace App\Http\Controllers\admin\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;

class grade_level_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade_levels = DB::table('grade_level')->get();

        return view('admin.configuration.education.grade_level')->with(compact('grade_levels'));
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:grade_level,gl_name'
        ]);

        if($validator->fails()){
            //echo json_encode($validator->messages());
            $url = $request->url();
            $action = 'insert';
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        else{
            try {
                $grade_level = DB::table('grade_level')->insert([
                    'gl_name' => $request->name
                ]);
                $message = 'Grade level inserted!';
                return redirect()->back()->with('success', $message);
            }catch (Exception $e) {
                $message = 'Grade level not inserted! Try again later!';
                return redirect()->back()->with('failed', $message);
            }
        }
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:grade_level,gl_name,'.$request->name
        ]);

        if($validator->fails()){
            echo json_encode($validator->messages());
            // $url = $request->url();
            // $action = 'update';
            // return redirect()->back()->withErrors($validator)->withInput($request->all())->with(compact('url', 'action'));  
        }
        // else{
        //     try {
        //         $grade_level = DB::table('grade_level')->where('gl_id', $id)->update([
        //             'gl_name' => $request->gl_name
        //         ]);
        //         $message = 'Grade level updated!';
        //         return redirect()->back()->with('success', $message);
        //     }catch (Exception $e) {
        //         $message = 'Grade level not updated! Try again later!';
        //         return redirect()->back()->with('failed', $message);
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $grade_level = DB::table('grade_level')->where('gl_id', $id)->delete();
            $message = 'Grade level deleted!';
            return redirect()->back()->with('success', $message);
        }catch (Exception $e) {
            $message = 'Grade level not deleted! Try again later!';
            return redirect()->back()->with('failed', $message);
        }
    }
}