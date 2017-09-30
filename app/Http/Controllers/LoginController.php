<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
class LoginController extends BaseController
{
   public function login(Request $request){
   	$dosubmit = $request->input('dosubmit');

   	$username = $request->input('username');
   	$password = $request->input('password');
    
   	if(empty($dosubmit)){
   		return view('Admin/login');
   	}else{
   		return view('Admin/home');
   	}
   }
   public function login1(Request $request){
 		return 13131;
   }
}
