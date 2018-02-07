<?php
namespace App\Http\Controllers\System;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
class SystemController extends BaseController{
	/**
	 * 获取所有权限接口
	 * @return [type] [description]
	 */
	public function getAllEdit(){
		$edit = DB::table('bm_edit')->get();
		return json_encode($edit);
	}

	public function getAllManager(){
		$manager = DB::table('bm_manager')->get();
		$arr=array();
		foreach ($manager as $key => $value) {
			$arr[$key]['manageID']=$value->manageID;
			$arr[$key]['manageTitle']=$value->manageTitle;
		}
		return json_encode($arr);
	}
}