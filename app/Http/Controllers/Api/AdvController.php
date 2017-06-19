<?php

namespace App\Http\Controllers\Api;

use App\Models\Advert;
use App\Models\User;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdvController extends Controller
{
    /***
    *添加/修改广告
    *
    ***/
    private static $type = [1=>'头部广告',2=>'弹窗广告',3=>'底部广告'];

    public function add(Request $request)
    {
        $user_id    = $request->input('user_id');
		//$article_id = $request->input('article_id');
		$title      = $request->input('title');
		$descri     = $request->input('descri');
		$tel        = $request->input('tel');
		$link_id    = $request->input('link_id');
		$token      = $request->input('token');
		$adv_type =  $request->input('type');
		//return response()->json(array('code'=>0,'msg'=>'测试','data'=>$type));
		if(empty($user_id)||empty($title)||empty($descri)||empty($tel)||empty($link_id)||empty($token)||empty($adv_type))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		$date = date('Y-m-d');
		$path = '';
		//如果有图片则上传
		if(isset($_FILES['file'])&&$_FILES['file']['size']>0){
			$upload_dir = ('./upload/'.$user_id.'/'.$date.'/');
			if(!file_exists($upload_dir)){
				mkdir($upload_dir,0777,true);
			}
			$name = $_FILES['file']['name'];
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$error = $_FILES['file']['error'];
			if($error>0){
				return response()->json(array('code'=>3,'msg'=>'上传错误','data'=>$error));
			}
			$pathinfo = pathinfo($name);
			$extension = $pathinfo['extension'];
			$md5_file = md5_file($tmp_name);
			if(file_exists($upload_dir.$md5_file.'.'.$extension)){
				chmod($upload_dir.$md5_file.'.'.$extension,0777);
				unlink($upload_dir.$md5_file.'.'.$extension);
			}
			if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_dir.$md5_file.'.'.$extension)){
				$path = $upload_dir.$md5_file.'.'.$extension;
			}else{
				return response()->json(array('code'=>4,'msg'=>'上传失败','data'=>$upload_dir.$md5_file.'.'.$extension));
			}
		}
		$count = Advert::where('status','=',1)->where('user_id','=',$user_id)->count();
		if($count==0){
			$status = 1;
		}else{
			$status = 0;
		}
		$advert = ['user_id'=>$user_id,'title'=>$title,'descri'=>$descri,'tel'=>$tel,'link_id'=>$link_id,'type'=>$adv_type,'status'=>$status];
		if($path)
		{
			$advert['img']= $path;
		}
		$advert['create_time'] = date('Y-m-d H:i:s');
		Advert::insert($advert);
		$msg = '添加成功';
		return response()->json(array('code'=>0,'msg'=>$msg,'data'=>array()));
    }
    public function lists(Request $request)
	{
		$user_id    = $request->input('user_id');
		$token      = $request->input('token');
		$tmp = new \stdClass();
		$advert = array();
		if(empty($user_id)||empty($token))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>$tmp));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			//return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>$tmp));
		}
		$advert = Advert::select('id','title','descri','tel','link_id','img','create_time','type','status')->where('user_id',$user_id)->get();
		foreach ($advert as $key => $value) {
			$value->img = ltrim($value->img,'.');
			$value->type = self::$type[$value->type];
			$value->jump_url   = Link::where('id',$value->link_id)->value('jump_url');
		}
		//unset($advert->link_id);
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$advert));
	}
	 /***
    *修改广告（暂时弃用）
    *
    ***/
    public function update(Request $request)
    {
    	$id = $request->input('id');
        $user_id    = $request->input('user_id');
		$title      = $request->input('title');
		$descri     = $request->input('descri');
		$tel        = $request->input('tel');
		$link_id    = $request->input('link_id');
		$token      = $request->input('token');
		if(empty($user_id)||empty($title)||empty($descri)||empty($tel)||empty($link_id)||empty($token)||empty($id))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		$date = date('Y-m-d');
		$path = '';
		//如果有图片则上传
		if(isset($_FILES['file'])){
			$upload_dir = ('./upload/'.$user_id.'/'.$date.'/');
			if(!file_exists($upload_dir)){
				mkdir($upload_dir,0777,true);
			}
			$name = $_FILES['file']['name'];
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$error = $_FILES['file']['error'];
			if($error>0){
				return response()->json(array('code'=>3,'msg'=>'上传错误','data'=>$error));
			}
			$pathinfo = pathinfo($name);
			$extension = $pathinfo['extension'];
			$md5_file = md5_file($tmp_name);
			if(file_exists($upload_dir.$md5_file.'.'.$extension)){
				chmod($upload_dir.$md5_file.'.'.$extension,0777);
				unlink($upload_dir.$md5_file.'.'.$extension);
			}
			if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_dir.$md5_file.'.'.$extension)){
				$path = $upload_dir.$md5_file.'.'.$extension;
			}else{
				return response()->json(array('code'=>4,'msg'=>'上传失败','data'=>$upload_dir.$md5_file.'.'.$extension));
			}
		} 
		if($path)
		{
			$advert['img']= $path;
		}
		$advert = ['user_id'=>$user_id,'title'=>$title,'descri'=>$descri,'tel'=>$tel,'link_id'=>$link_id,'create_time'=>date('Y-m-d H:i:s',time())];
		Advert::where('id','=',$id)->update($advert);
		return response()->json(array('code'=>0,'msg'=>'修改成功','data'=>array()));
    }

    public function select(Request $request){
    	$id = $request->input('id');
        $user_id    = $request->input('user_id');
    	$token      = $request->input('token');
		if(empty($user_id)||empty($token)|| $id=='')
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		Advert::where('id','<>',$id)->where('user_id','=',$user_id)->update(['status'=>0]);
		$res = Advert::where('id','=',$id)->update(['status'=>1]);
		return response()->json(array('code'=>0,'msg'=>'修改成功','data'=>array()));
    }

    public function delete(Request $request){
    	$id = $request->input('id');
        $user_id    = $request->input('user_id');
    	$token      = $request->input('token');
		if(empty($user_id)||empty($token)||empty($id))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
		Advert::where('id','=',$id)->delete();
		return response()->json(array('code'=>0,'msg'=>'删除成功','data'=>array()));
    }
}
