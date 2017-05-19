<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /***
    *文章列表
    *
    ***/
    public function add(Request $request)
    {
        $user_id    = $request->input('user_id');
		$article_id = $request->input('article_id');
		$token      = $request->input('token');
		if(empty($user_id)||empty($article_id)||empty($token))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		$favorite = ['user_id'=>$user_id,'article_id'=>$article_id,'create_time'=>date('Y-m-d H:i:s',time())];
		Favorite::insert($favorite);
		return response()->json(array('code'=>0,'msg'=>'收藏成功','data'=>array()));
    }
    public function del(Request $request)
    {
        $user_id    = $request->input('user_id');
		$article_id = $request->input('article_id');
		$token      = $request->input('token');
		if(empty($user_id)||empty($article_id)||empty($token))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		$favorite = Favorite::whereRaw('user_id='.$user_id.' and article_id='.$article_id)->value('id');
		if($favorite>0)
		{
			Favorite::where('id',$favorite)->delete();
		}else{
			return response()->json(array('code'=>4,'msg'=>'未收藏此文章','data'=>array()));
		}
		
		return response()->json(array('code'=>0,'msg'=>'取消成功','data'=>array()));
    }
	 public function lists(Request $request)
    {
        $user_id    = $request->input('user_id');
		$token      = $request->input('token');
		$page       = $request->input('page');
		if(empty($page))
		{
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
		$favorite = Favorite::select('article_id')->where('user_id',$user_id)->skip($skip)->take($take)->orderBy('id','desc')->get();
		foreach($favorite as $k=>$v)
		{
			$favorite[$k] = Article::where('id',$v->article_id)->select('id','title','summary','logo','views','created_at')->first();
			$favorite[$k]->logo = ["http://shop.m9n.com/image/show".($favorite[$k]->logo)];
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$favorite));
	}
}
