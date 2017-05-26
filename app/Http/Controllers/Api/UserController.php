<?php
namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
		$openid     = $request->input('openid');
		$login_type = $request->input('login_type');
		
		//新用户
		$sex    = $request->input('sex');
		$nickname = $request->input('nickname');
		$city     = $request->input('city');
		$province = $request->input('province');
		$country  = $request->input('country');
		$headimgurl = $request->input('headimgurl');
		
		
		
		if(in_array($sex,["f","女","w",2])){
		  $sex = 2;//女
		}elseif(in_array($sex,["m","男",1])){
		  $sex = 1;//男
		}else{
		  $sex = 1;//未知
		}
		
		if(empty($openid)||empty($login_type))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		$wx_openid = $fc_openid = $wx2_openid ='';
		if($login_type=='wechat')
		{
			$where = "wx_openid='$openid'";
			$wx_openid = $openid;
		}elseif($login_type=='facebook'){
			$where =  "fc_openid='$openid'";
			$fc_openid = $openid;
		}elseif($login_type=='wx2'){
			$where =  "wx2_openid='$openid'";
			$wx2_openid = $openid;
			
		}else{
			return response()->json(array('code'=>2,'msg'=>'参数错误','data'=>array()));
		}
         $user = User::whereRaw($where)->select('id','name','province','city','title','password')->first();
		 $sort = rand(1000,9999);
		 if($user)
		 {
			$user->province = Area::where('id',$user->province)->value('name');
			$user->city = Area::where('id',$user->city)->value('name');
			if(empty($user->province))
			{
				$user->province = '未知';
			}
			if(empty($user->city))
			{
				$user->city = '未知';
			}
			$password = $user->password;
			unset($user->password);
			 //修改密钥
			User::where('id','=',$user->id)->update(['sort'=>$sort]);
			$token = md5($password.$sort);
			$user->headimg = './image/avatar/'.($user->id).'_middle.jpg';
			$user->token   = $token;
		 }else{
			$user = new \stdClass();
			//新用户插入
			$password = md5('HTTP://shop.m9n.com');
			$email = time().'@none.com';
			
			$new_user = ['name'=>$nickname,'wx_openid'=>$wx_openid,'fc_openid'=>$fc_openid,'wx2_openid'=>$wx2_openid,'email'=>$email,'password'=>$password,'city'=>$city,'province'=>$province,'headimg'=>$headimgurl,'gender'=>$sex,'created_at'=>date('Y-m-d H:i:s',time()),'sort'=>$sort];
			User::insert($new_user); 
			$user->User::insertGetId();
			$user->name = $nickname;
			$user->province = $province;
			$user->city = $city;
			$user->title = '';
			$user->token = md5($password.$sort);
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$user));
    }
	public function info(Request $request)
	{
		$user_id = $request->input('user_id');
		$token      = $request->input('token');
        if(empty($user_id)||empty($token))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		$user = User::where('id',$user_id)->select('id','name','province','city','title')->first();
		$user->province = Area::where('id',$user->province)->value('name');
		$user->city = Area::where('id',$user->city)->value('name');
		if(empty($user->province))
		{
			$user->province = '未知';
		}
		if(empty($user->city))
		{
			$user->city = '未知';
		}
		$user->headimg = './image/avatar/'.($user->id).'_middle.jpg';
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$user));
		
		
	}

}