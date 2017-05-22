<?php

namespace App\Http\Controllers\Admin;

use App\Models\Msg;
use App\Models\XingeApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

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
	   return view('admin.msg.index')->with('msgs',$msgs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.msg.create');

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
        $msgs->content = $request->input('content');
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
        return view('admin.msg.edit')->with('msgs',$msgs);
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
        $msgs->content = $request->input('content');
        $msgs->to_user = $request->input('to_user');
        $msgs->update_time = date('Y-m-d H:i:s',time());
        
        $msgs->save();
        return $this->success(route('admin.msg.index'),'商品修改成功');

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
		//androd
		$androd_callback = XingeApp::PushAllAndroid(2100259224, "46dc9b997f1f3db3bbab8ed057a8959a", $title, $content);
		
		//ios
		//var_dump(XingeApp::PushAllIos(2200259225, "e93553fa967e5a698af8e6505372abee",$content, XingeApp::IOSENV_DEV));
		if($androd_callback['ret_code']==0)
		{
			$push_id = $androd_callback['result']['push_id'];
			Msg::where('id','=',$id)->update(['push_id'=>$push_id,'post_time'=>date('Y-m-d H:i:s',time())]);
			return $this->success(route('admin.msg.index'),'发布成功');
		}else{
			$message = '错误码:'.$androd_callback['ret_code'].',错误信息：'.$androd_callback['err_msg'];
			return $this->error(route('admin.msg.index'),$message);
		}
	}
}
