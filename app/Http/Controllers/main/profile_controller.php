<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

class profile_controller extends Controller
{
    public function __construct(){

    }

    public function update(Request $request){

    }

    public function index(){
        $active_page = 'profile';

        return view(Session()->get('user_type').".profile")->with(compact('active_page'));
    }
}
