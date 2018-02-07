<?php
namespace App\Http\Controllers\Authority;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
class AuthController extends BaseController{
	/**
	 * 跳转至权限管理界面
	 * @return [html] [界面]
	 */
	public function authList(){
		return view('Auth/auth_list');
	}

	/**
	 * 获取权限列表
	 * @param  Request $req [page,rows]
	 * @return [json]       [{"rows":[{"authID":1,"authName":"\u8d85\u7ea7\u7ba1\u7406\u5458","rangeValue":"1,2,3,4","rangeTitle":"\u680f\u76ee\u4e00\uff0c\u680f\u76ee\u4e8c","editVlue":"1,2,3,4","editTitle":"\u6dfb\u52a0\uff0c\u4fee\u6539\uff0c\u5220\u9664\uff0c\u7f16\u8f91","addStamp":"2018-02-07 10:23:50","delStatus":0}],"total":1}]
	 */
	public function getAuthList(Request $req){
		$page = !empty($req->input('page')) ? $req->input('page'):1;
		$rows = !empty($req->input('rows')) ? $req->input('rows'):10;
		$sort = $req->input('sort');
		$order = $req->input('order');

		$start =$rows*($page-1);
		$end = $start+$rows;

		if(!empty($sort)&&!empty($order)){
			$auth = DB::table('bm_authority')
						->orderBy($sort,$order)
						->offset($start)
						->limit($end)
						->where('delStatus',0)
						->get();
		}else{
			$auth= DB::table('bm_authority')
						->offset($start)
						->limit($end)
						->where('delStatus',0)
						->get();
		}
		$authTotal = DB::select("SELECT COUNT(*) total FROM bm_authority where delStatus=0");
		$total = $authTotal[0]->total;
		return json_encode(array('rows'=>$auth,'total'=>$total));
	}

	/**
	 *	跳转新增编辑模板
	 * @return [html] [界面]
	 */
	public function authAddView(){
		return view('Auth/auth_add');
	}

	public function changeAuthInfo(Request $req){
		$type = null !== $req->input('type') ? trim($req->input('type').'') : '';

		$authName = null !== $req->input('authName') ? trim($req->input('authName').'') : '';
		$managerValue = null !== $req->input('managerValue') ? trim($req->input('managerValue').'') : '';
		$managerTitle = null !== $req->input('managerTitle') ? trim($req->input('managerTitle').'') : '';
		$editValue = null !== $req->input('editValue') ? trim($req->input('editValue').'') : '';
		$editTitle = null !== $req->input('editTitle') ? trim($req->input('editTitle').'') : '';

		if(empty($authName) || empty($managerValue) || empty($editValue)){
			return json_encode(array('code'=>100,'msg'=>'缺少必要参数！'));
			die();
		}
		if($type == 'insert'){//新增
			$auth = DB::table('bm_authority')
						->where('authName',$authName)
						->first();
			if($auth){
				return json_encode(array('code'=>101,'msg'=>'权限已存在！'));
				die();
			}
			$res = DB::table('bm_authority')
						->insert(['authName'=>$authName,'rangeValue'=>$managerValue,'rangeTitle'=>$managerTitle,'editValue'=>$editValue,'editTitle'=>$editTitle,'addStamp'=>date('Y-m-d H:i:s',time())]);
			if($res){
				return json_encode(array('code'=>102,'msg'=>'权限添加成功！'));
			}else{
				return json_encode(array('code'=>103,'msg'=>'服务器异常！'));
			}
		}else{//编辑

		}
		//return json_encode($req->input());
	}

	public function getAuthInfo(request $req){
		$authID = null !== $req->input('authID') ? trim($req->input('authID')) : '';
		if(empty($authID)){
			return json_encode(array('code'=>100,'msg'=>'缺少必要参数！'));
			die();
		}
		$auth = DB::table('bm_authority')
					->where('authID',$authID)
					->first();
		if($auth){
			return json_encode(array('code'=>101,'data'=>$auth));
		}else{
			return json_encode(array('code'=>102,'msg'=>'记录为空！'));
		}
	}
}