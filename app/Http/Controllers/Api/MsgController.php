<?php

namespace App\Http\Controllers\Api;

use App\Models\Msg;
use App\Models\Article;
use App\Models\User;
use App\Models\XingeApp;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MsgController extends Controller
{
    /***
    *给所有设备下发通知 推送类型 1：文章 2：内容
    *
    ***/
    public function post_all(Request $request)
    {	
		
    }
	
	/***
    *我的消息
    *
    ***/
    public function lists(Request $request)
    {	
		$user_id = $request->input('user_id');
		$page    = $request->input('page');
		$token      = $request->input('token');
		if(empty($page)){
            $page = 1;
        }
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
		$take = 10;
		$skip = ($page-1)*$take;
		$msg  = Msg::whereRaw('to_user in ('.$user_id.',0) and type=1')->select('id','content')->get();
		foreach($msg as $k=>$v)
		{
			$msg[$k] = Article::where('id',$v->content)->select('id','title','summary','logo','views','created_at')->first();
			$new_logo = "http://shop.m9n.com/image/show".$v->logo;
			$msg[$k]->logo = array($new_logo);
		}
		
		return response()->json(array('code'=>0,'msg'=>'成功','data'=> $msg));
    }
	
}
