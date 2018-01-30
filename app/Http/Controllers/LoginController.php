<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
class LoginController extends BaseController
{  
   /**
    * 登录页面
    * @return [type] [description]
    */
   public function loginView(){
      return view('Admin/login');
   }
   /**
    * 登录接口
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function login(Request $request){
      try{
      	$userName = $request->input('userName');
      	$passWord = $request->input('passWord');
         
         $user = DB::select('select * from bm_user where userName = ?',[$userName]);
         if(!empty($user)){
         	foreach ($user as $key => $users) {
               $passWordTwo = $users->passWord;
            }
            if($passWord != $passWordTwo){
               return json_encode(array("code"=>101,"msg"=>"输入的密码不正确！"));
            }else{
               return json_encode(array("code"=>102,"msg"=>"登录成功！"));
            }
         }else{
            return json_encode(array("code"=>100,"msg"=>"用户不存在！"));
         }
      }catch(Exception $e){
         return json_encode(array("code"=>103,"msg"=>$e));
      }
   }
  
}

