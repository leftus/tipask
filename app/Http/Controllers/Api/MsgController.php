<?php

namespace App\Http\Controllers\Api;

use App\Models\Msg;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Xinge\XingeApp;
use App\Models\Xinge\MessageIOS;
use App\Models\Xinge\TimeInterval;
use App\Models\Xinge\Message;
use App\Models\Xinge\Style;
use App\Models\Xinge\ClickAction;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MsgController extends Controller
{

	/***
    *我的消息
    *
    ***/
    public function lists(Request $request)
    {
		$user_id = $request->input('user_id');
		$page    = $request->input('page');
		$token      = $request->input('token');
		$count_show = $request->input('count_show');
		if(empty($count_show))
		{
			$count_show = 0;
		}else{
			$count_show = 1;
		}
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
		$msg  = Msg::whereRaw('to_user in ('.$user_id.',0) and type=1')->orderBy('post_time','desc')->skip($skip)->take($take)->select('id','content')->get();
		foreach($msg as $k=>$v)
		{
			$article = Article::where('id',$v->content)->select('id','title','summary','logo','views','created_at','category_id','summary')->first();
			if($article){
				if($article->category_id==9){
					$v->title = trim($article->summary);
				}else{
					$v->title = $article->title;
				}
				$v->id = $article->id;
				$v->summary = $article->summary;
				if(strpos($article->logo,'http')===FALSE){
					$logo = 'https://us.m9n.com/image/show/'.$article->logo;
				}else{
					$logo = $article->logo;
				}
				$v->logo = [$logo];
				$v->views = $article->views;
				$v->created_at = $article->created_at;
				unset($v->content);
			}else{
				$msg->pull($k);
			}
		}
		if($count_show)
		{
			$count = Msg::whereRaw('to_user in ('.$user_id.',0) and type=1')->count('id');
			return response()->json(array('code'=>0,'msg'=>'成功','count'=>$count,'data'=>$msg));
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=> $msg->flatten()));
    }
	//定时发送信息
	public function postmsg_auto(Request $request)
	{
    //var_dump(XingeApp::PushAllIos(2200259225, "e93553fa967e5a698af8e6505372abee", "content", XingeApp::IOSENV_DEV));die();
		$check_validate = $request->input('kbak_validate');
		if($check_validate!='1333888999'){
			return 'error';
		}
    $cate_list = Category::where('type','articles')->where('status','<>',0)->lists('id');
		$article = Article::select('id','title','logo','content')->where('is_send','<>',1)->whereIn('category_id',$cate_list)->orderBy('id','desc')->first();
		if($article){
			$article->desc    = str_limit($this->format_html($article->content), $limit = 40, $end = '');
	    if(strpos($article->logo,'http')===FALSE){
			    $article->logo    = 'https://us.m9n.com/image/show'.$article->logo;
	    }
			$title = $article->title;
			$content = $article->title;
			$custom = array('id'=>$article->id,'title'=>$article->title,'logo'=>$article->logo,'desc'=>trim($article->desc));

			//给所有设备发送
			 //IOS
			$ios_callback = $this->DemoPushAllIos($content,$custom,1);
			$ios_pushid = 'error';
			$error = 0;
			if($ios_callback['ret_code']!=0)
			{
				return response()->json(array('ios_callback'=>$ios_callback));
			}else{
				$ios_pushid = $ios_callback['result']['push_id'];
			}

			//给所有安卓设备发消息
			$and_pushid = 'error';
			$androd_callback = $this->DemoPushAllAndroid($title,$content,$custom);
			if($androd_callback['ret_code']!=0)
			{
	      return response()->json(array('androd_callback'=>$androd_callback));
			}else{
				$and_pushid = $androd_callback['result']['push_id'];
			}
			$post_data = ['title'=>$article->title,'article_id'=>$article->id,'post_time'=>date('Y-m-d H:i:s'),'ios_pushid'=>$ios_pushid,'and_pushid'=>$and_pushid];
			DB::table('postlog')->insert($post_data);
	    $msg_data = ['title'=>$article->title,'content'=>$article->id,'type'=>1,'post_time'=>date('Y-m-d H:i:s')];
	    DB::table('msg')->insert($msg_data);
			Article::where('id','=',$article->id)->update(['is_send'=>1]);
	    return response()->json(array('ios_callback'=>$ios_callback,'androd_callback'=>$androd_callback));
		}else{
			return response()->json('暂无数据');
		}

	}

  public function DemoPushAllAndroid($title, $content,$custom)
  {
      $push = new XingeApp(2100259224, '46dc9b997f1f3db3bbab8ed057a8959a');
      $mess = new Message();
      $mess->setTitle($title);
      $mess->setContent($content);
      $mess->setType(Message::TYPE_NOTIFICATION);
      $mess->setStyle(new Style(0,1,1));
      $action = new ClickAction();
      $action->setActionType(ClickAction::TYPE_ACTIVITY);
      $action->setActivity('123');
      $mess->setAction($action);
      $mess->setCustom($custom);
      $ret = $push->PushAllDevices(0, $mess);
      return $ret;
  }

  public function DemoPushAllIos($content,$custom,$environment)
  {
      $push = new XingeApp(2200259225, 'e93553fa967e5a698af8e6505372abee');
      $mess = new MessageIOS();
      $mess->setAlert($content);
      $mess->setCustom($custom);
      $mess->setSound("beep.wav");
      $ret = $push->PushAllDevices(0, $mess, $environment);
      return $ret;
  }

	function format_html($str){
		$str = strip_tags($str);
		$str = str_replace(array("\r\n", "\r", "\n","\t"), "", $str);
		$str = str_replace('&ldquo;', '“',$str);
		$str = str_replace('&rdquo;', '”',$str);
		$str = str_replace('&middot;', '·',$str);
		$str = str_replace('&lsquo;', '‘',$str);
		$str = str_replace('&rsquo;', '’',$str);
		$str = str_replace('&hellip;', '…', $str);
		$str = str_replace('&mdash;', '—', $str);
		return $str;
	}
}
