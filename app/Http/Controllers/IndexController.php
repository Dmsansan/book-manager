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
class IndexController extends BaseController{
	/**
	 * 跳转后台首页页面
	 * @return [type] [description]
	 */
	public function indexView(){
		return view("Admin/index");
	}
}