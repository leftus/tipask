<?php

namespace App\Http\Controllers\Admin;

use App\Models\Msg;
use App\Models\User;
use App\Models\Article;
use App\Models\XingeApp;
use App\Models\Message;
use App\Models\Style;
use App\Models\ClickAction;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
//require_once ('XingeApp.php');
class MsgController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'title' => 'required|max:128',
        //'description' => 'sometimes|max:65535',
        'type' => 'required|integer',
        //'remnants' => 'required|integer',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $msgs = Msg::orderBy('id','DESC')->paginate(10);
	   foreach($msgs as $v)
	   {
		   if($v->type==1)
		   {
			   $v->content = Article::where('id',$v->content)->value('title');
			   
		   }
		   if($v->to_user==0)
		   {
			  $v->to_user='全部';
		   }
	   }
	   return view('admin.msg.index')->with('msgs',$msgs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$article = Article::select('id','title')->orderBy('id','desc')->get();
		$users    = User::select('id','name')->orderBy('id','desc')->get();
        return view('admin.msg.create')->with('article',$article)->with('user',$users);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
        $request->flash();
        $this->validate($request,$this->validateRules);
        $msgs = msg::create($request->all());
		$msgs->title = $request->input('title');
        $msgs->type = $request->input('type');
		$type = $request->input('type');
		if($type==1)
		{
			$msgs->content = $request->input('select_article');
		}else{
			$msgs->content = $request->input('content');
		}
        $msgs->to_user = $request->input('to_user');
        $msgs->create_time = date('Y-m-d H:i:s',time());
        $msgs->save();
        return $this->success(route('admin.msg.index'),'新增消息成功');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $msgs = Msg::find($id);
        if(!$msgs){
            return $this->error(route('admin.msg.index'),'消息不存在，请核实');
        }
		$article = Article::select('id','title')->orderBy('id','desc')->get();
        return view('admin.msg.edit')->with('msgs',$msgs)->with('article',$article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msgs = msg::find($id);
        if(!$msgs){
            return $this->error(route('admin.msg.index'),'消息不存在，请核实');
        }

        $this->validate($request,$this->validateRules);
        $msgs->title = $request->input('title');
        $msgs->type = $request->input('type');
		$type = $request->input('type');
		if($type==1)
		{
			$msgs->content = $request->input('select_article');
		}else{
			$msgs->content = $request->input('content');
		}
        $msgs->to_user = $request->input('to_user');
        $msgs->update_time = date('Y-m-d H:i:s',time());
        
        $msgs->save();
        return $this->success(route('admin.msg.index'),'消息修改成功');

    }

    /**
     * 删除商品
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        msg::destroy($request->input('ids'));
        return $this->success(route('admin.msg.index'),'消息删除成功');
    }
	//发布消息
	public function postmsg(Request $request)
	{
		$id = $request->input('id');
		$msg = Msg::where('id',$id)->first();
		$title   = $msg->title;
		$content = $msg->content;
		//IOS
		$push = new XingeApp(2200259225, 'e93553fa967e5a698af8e6505372abee');
		$mess = new Message();
		$mess->setType(Message::TYPE_NOTIFICATION);
		$mess->setTitle($title);
		$mess->setContent($content);
		$mess->setExpireTime(86400);
		$style = new Style(0);
		$action = new ClickAction();
		$action->setActionType(ClickAction::TYPE_URL);
		$action->setUrl("http://xg.qq.com");
		#打开url需要用户确认
		$action->setComfirmOnUrl(1);
		$mess->setStyle($style);
		$mess->setAction($action);
		$ios_callback = $push->PushAllDevices(0, $mess);
		$error = 0;
		if($ios_callback['ret_code']!=0)
		{
			$error++;
			$message = '错误码:'.$ios_callback['ret_code'].',错误信息：'.$ios_callback['err_msg'];
			return $this->error(route('admin.msg.index'),$message);
		}else{
			$push_id = $ios_callback['result']['push_id'];
		}
		//androd
		$push = new XingeApp(2100259224, '46dc9b997f1f3db3bbab8ed057a8959a');
		$mess = new Message();
		$mess->setType(Message::TYPE_NOTIFICATION);
		$mess->setTitle($title);
		$mess->setContent($content);
		$mess->setExpireTime(86400);
		$style = new Style(0);
		$action = new ClickAction();
		$action->setActionType(ClickAction::TYPE_URL);
		$action->setUrl("http://xg.qq.com");
		#打开url需要用户确认
		$action->setComfirmOnUrl(1);
		$mess->setStyle($style);
		$mess->setAction($action);
		$androd_callback = $push->PushAllDevices(0, $mess);
		if($androd_callback['ret_code']==0)
		{
			$push_id = $push_id.'||'.$androd_callback['result']['push_id'];
			Msg::where('id','=',$id)->update(['push_id'=>$push_id,'post_time'=>date('Y-m-d H:i:s',time())]);
			return $this->success(route('admin.msg.index'),'发布成功');
		}else{
			$message = '错误码:'.$androd_callback['ret_code'].',错误信息：'.$androd_callback['err_msg'];
			return $this->error(route('admin.msg.index'),$message);
		}
	}
}
