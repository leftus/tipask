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
		if(empty($openid)||empty($login_type))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		if($login_type=='wechat')
		{
			$where = 'wx_openid='.$openid;
		}elseif($login_type=='facebook'){
			$where = 'fc_openid='.$openid;
		}else{
			return response()->json(array('code'=>2,'msg'=>'参数错误','data'=>array()));
		}
         $user = User::whereRaw($where)->select('id','name','province','city','title')->first();
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
		 }
		 //修改密钥
		 User::where('id','=',$user->id)->update(['sort'=>$sort]);
		 $token = md5($openid.$sort);
		 $user->headimg = User::getAvatarPath($user->id);
		 $user->token   = $token;
		 return response()->json(array('code'=>0,'msg'=>'成功','data'=>$user));
    }

}