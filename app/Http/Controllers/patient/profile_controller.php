<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profile_controller extends Controller
{
    public function __construct(){

    }

    public function update(Request $request){

    }

    public function index(){
        $active_page = 'profile';

        return view("patient.profile")->with(compact('active_page'));
    }
}
