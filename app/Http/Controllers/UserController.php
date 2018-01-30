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
class UserController extends BaseController{
	/**
	 * 跳转用户列表页面
	 * @return [type] [description]
	 */
	public function userList(){
		return view("Admin/user_list");
	}

	public function findUserList(Request $req){
		$user = DB::select("select * from bm_user");
		// foreach ($user as $key => $users) {
		// 	$data = $users;
		// }
		return json_encode($user);
	}
}