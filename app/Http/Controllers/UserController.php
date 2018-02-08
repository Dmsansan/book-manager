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
	 * @return [html] [<html></html>]
	 */
	public function userList(){
		return view("Admin/user_list");
	}

	/**
	 * 用户列表接口
	 * @param  Request $req [page,rows,sort,order]
	 * @return [type]       [description]
	 */
	public function findUserList(Request $req){
		$page = !empty($req->input('page')) ? $req->input('page'):1;
		$rows = !empty($req->input('rows')) ? $req->input('rows'):10;
		$sort = $req->input('sort');
		$order = $req->input('order');

		$start =$rows*($page-1);
		$end = $start+$rows;

		if(!empty($sort)&&!empty($order)){
			$user = DB::table('bm_user')
						->where('delStatus',0)
						->orderBy($sort,$order)
						->offset($start)
						->limit($end)
						->get();
		}else{
			$user = DB::table('bm_user')
						->where('delStatus',0)
						->offset($start)
						->limit($end)
						->get();
		}
		$userTotal = DB::select("SELECT COUNT(*) total FROM bm_user WHERE delStatus=0");
		$total = $userTotal[0]->total;
		return json_encode(array('rows'=>$user,'total'=>$total));
	}

	/**
	 * 用户add和update界面
	 * @return [html] [<html></html>]
	 */
	public function userAddView(){
		return view("Admin/user_add");
	}

	/**
	 * 根据userID获取用户信息
	 * @param  Request $request [userID]
	 * @return [json]           [{"userID":1,"userName":"sansan","passWord":"123456","name":"\u53f8\u4e09\u4e09","qq":"562404326","phone":"15601590617","email":"562404326@qq.com","age":18,"sex":1,"address":"\u6c5f\u82cf\u5357\u4eac","addStamp":"2018-01-30"}]
	 */
	public function getUserInfo(Request $request){
		$userID = $request->input('userID');
		$user = DB::table('bm_user')->where('userID',$userID)->first();
		return json_encode($user);
	}

	/**
	 * 添加或删除用户接口
	 * @param  Request $request [user.data]
	 * @return [json]           ['code':,'msg':]
	 */
	public function changeUserInfo(Request $request){
		$userID = $request->input('userID');
		$userName = $request->input('userName');
		$name = $request->input('name');
		$sex = $request->input('sex');
		$qq = $request->input('qq');
		$phone = $request->input('phone');
		$email = $request->input('email');
		$address = $request->input('address');

		$type = $request->input('type');
		if(empty($type)||empty($userName)||empty($name)||empty($sex)||empty($qq)||empty($phone)||empty($email)||empty($address)){
			return json_encode(array('code'=>101,'msg'=>'缺少必要参数！'));
			die();
		}
		if($type=="update"){//update
			$user = json_decode($this->getUserInfo($request),true);
			if($userName == $user['userName']&&$name == $user['name']&&$sex == $user['sex']&&$qq == $user['qq']&&$phone == $user['phone']&&$email == $user['email']&&$address == $user['address']){
				return json_encode(array('code'=>100,'msg'=>'没有记录被修改！'));
				die();
			}else{
				
					$res = DB::table('bm_user')
								->where('userID',$userID)
								->update(['userName'=>$userName,'name'=>$name,'sex'=>$sex,'qq'=>$qq,'phone'=>$phone,'email'=>$email,'address'=>$address]);
					if($res){
						return json_encode(array('code'=>102,'msg'=>'用户信息修改成功！'));
						die();
					}else{
						return json_encode(array('code'=>103,'msg'=>'服务器异常！'));
					}
			}
		}else{//insert
				$user = DB::table('bm_user')
						->where('userName',$userName)
						->first();
				if($user){
					return json_encode(array('code'=>105,'msg'=>'用户账号已存在！'));
					die();
				}
				$res = DB::table('bm_user')
							->insert(['userName'=>$userName,'name'=>$name,'sex'=>$sex,'qq'=>$qq,'phone'=>$phone,'email'=>$email,'address'=>$address,'addStamp'=>date('Y-m-d H:i:s',time())]);
				if($res){
					return json_encode(array('code'=>104,'msg'=>'用户信息添加成功！'));
					die();
				}else{
					return json_encode(array('code'=>103,'msg'=>'服务器异常！'));
				}
			}	
	}

	public function deleteUser(Request $request){
		$userID = $request->input('userID');

		if(empty($userID)){
			return json_encode(array('code'=>102,'msg'=>'缺少必要参数！'));
			die();
		}
		$res = DB::table('bm_user')->where('userID',$userID)->update(['delStatus'=>1]);
		if($res){
			return json_encode(array('code'=>100,'msg'=>'用户信息删除成功！'));
		}else{
			return json_encode(array('code'=>101,'msg'=>'用户信息删除失败！'));
		}
	}
}