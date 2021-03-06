<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Area;
use App\Models\UserArticle;
use App\Models\Article;
use App\Models\UserArticleViews;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
		$openid     = $request->input('openid');
		$login_type = $request->input('login_type');
		$device_token  = $request->input('devicetoken');
		$device_type = $request->input('device_type');
		//新用户
		$sex    = $request->input('sex');
		$nickname = $request->input('nickname');
		$city     = $request->input('city');
		$province = $request->input('province');
		$country  = $request->input('country');
		$headimgurl = $request->input('headimgurl');

		$error = new \stdClass();
		if(empty($nickname)){
			$nickname = '新用户';
		}
		if(in_array($sex,["f","女","w",2])){
		  $sex = 2;//女
		}elseif(in_array($sex,["m","男",1])){
		  $sex = 1;//男
		}else{
		  $sex = 1;//未知
		}

		if(empty($openid)||empty($login_type))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>$error));
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
			return response()->json(array('code'=>2,'msg'=>'参数错误','data'=>$error));
		}
    $user = User::whereRaw($where)->select('id','name','province','city','title','password','headimg')->first();
		 $sort = rand(1000,9999);
		 if($user)
		 {
			//$user->province = Area::where('id',$user->province)->value('name');
			//$user->city = Area::where('id',$user->city)->value('name');
			if(empty($user->province))
			{
				$user->province = '未知';
			}
			if(empty($user->city))
			{
				$user->city = '未知';
			}
			if(empty($user->title))
			{
				$user->title = '';
			}
			$password = $user->password;
			unset($user->password);
			 //修改密钥
			User::where('id','=',$user->id)->update(['sort'=>$sort]);
			$token = md5($password.$sort);
			$user->token   = $token;
		 }else{
			$user = new \stdClass();
			//新用户插入
			$password = md5($openid);
			$email = time().'@none.com';
			$new_user=[
        'name'=>$nickname,
        'wx_openid'=>$wx_openid,
        'fc_openid'=>$fc_openid,
        'wx2_openid'=>$wx2_openid,
        'email'=>$email,
        'password'=>$password,
        'city'=>$city,
        'province'=>$province,
        'headimg'=>$headimgurl,
        'gender'=>$sex,
        'created_at'=>date('Y-m-d H:i:s',time()),
        'sort'=>$sort,
        'indate'=>3,
        'start_time'=>date('Y-m-d H:i:s')
      ];
			$user->id   = User::insertGetId($new_user);
			$user->name = $nickname;
			$user->province = $province;
			$user->city = $city;
			$user->title = '';
			$user->headimg = $headimgurl;
			$user->token = md5($password.$sort);
		}
		//修改用户的当前登录设备
    if(!empty($device_token) && in_array($device_type,[1,2])){
      $update_data = ['device_token'=>$device_token,'device_type'=>$device_type];
      User::where('id','=',$user->id)->update($update_data);
    }
		if(empty($user->province))
		{
			$user->province = '某省';
		}
		if(empty($user->city))
		{
			$user->city = '某市';
		}
		if(empty($user->headimg))
		{
			$user->headimg = '';
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
		$user = User::where('id',$user_id)->select('id','name','province','city','title','headimg','start_time','indate')->first();
		$now = date('Y-m-d H:i:s');
		$date1 = date_create($user->start_time);
		$date2 = date_create($now);
		$diff = date_diff($date1,$date2);
		$days = $diff->format('%a');
		if($user->indate > $days){
      $left_days = $user->indate-$days;
      if($left_days<=3){
        $user->warnning = '  您的账号还有'.$left_days.'天到期，为了不影响您的使用，请联系我们！';
      }else{
        $user->warnning = '';
      }
		}else{
			$user->warnning = '  您的账号已到期，请联系我们';
		}
		unset($user->start_time);
		unset($user->indate);
		if(empty($user->province))
		{
			$user->province = '未知';
		}
		if(empty($user->city))
		{
			$user->city = '未知';
		}
		if(empty($user->headimg))
		{
			$user->headimg = '未知';
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$user));
	}
  public function forward(Request $request){
    $user_id = $request->input('user_id');
		$token      = $request->input('token');
    $aid      = $request->input('aid');
    if(empty($user_id)||empty($token) || empty($aid))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
    if(empty($user)){
      return response()->json(array('code'=>2,'msg'=>'用户不存在','data'=>array()));
    }
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
    $userarticle = new UserArticle;
    $userarticle->uid = $user_id;
    $userarticle->aid = $aid;
    $userarticle->save();
    return response()->json(array('code'=>0,'msg'=>'成功','data'=>array()));
  }

  public function forward_list(Request $request){
    $user_id = $request->input('user_id');
		$token      = $request->input('token');
    if(empty($user_id)||empty($token))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		//验证token
		$user = User::where('id',$user_id)->select('password','sort')->first();
    if(empty($user)){
      return response()->json(array('code'=>2,'msg'=>'用户不存在','data'=>array()));
    }
		if(md5(($user->password).($user->sort)) != $token)
		{
			return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
		}
    $userarticle = UserArticle::select('id','aid','views','created_at')->where('uid',$user_id)->get();
    foreach ($userarticle as $k => $v) {
      $article = Article::where('id',$v->aid)->select('title','summary','logo','views','created_at','category_id','summary')->first();
      if($article){
				if($article->category_id==9){
					$v->title = trim($article->summary);
				}else{
					$v->title = $article->title;
				}
				$v->id = $v->aid;
				$v->summary = $article->summary;
				if(strpos($article->logo,'http')===FALSE){
					$logo = 'https://us.m9n.com/image/show/'.$article->logo;
				}else{
					$logo = $article->logo;
				}
				$v->logo = [$logo];
        $today_views = UserArticleViews::where('user_article_id',$v->id)->where('created_at','>',date('Y-m-d H:i:s',strtotime(date('Y-m-d'))))->count();
        $yestoday_views = UserArticleViews::where('user_article_id',$v->id)->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime(date('Y-m-d',strtotime('-1 day')))),date('Y-m-d H:i:s',strtotime(date('Y-m-d')))])->count();
        $v->today_views = ' 今日量 '.$today_views;
        $v->yestoday_views = ' 昨日量 '.$yestoday_views;
				unset($v->aid);
        unset($v->id);
			}else{
				$userarticle->pull($k);
			}
    }
    return response()->json(array('code'=>0,'msg'=>'成功','data'=> $userarticle->flatten()));
  }
}
