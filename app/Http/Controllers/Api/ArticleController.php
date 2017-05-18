<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /***
    *文章列表
    *
    ***/
    public function lists(Request $request)
    {
        
		$page = $request->input('page');
		$cate  = $request->input('cate');
        if(empty($page)){
            $page = 1;
        }
		if(empty($cate)){
            return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
        }
       $data = new \stdClass();
       $list = Article::orderBy('id','desc')->where('category_id',$cate)->get(['id','title','summary','logo','views','created_at'])->chunk(10);
		
        $data->code = 0;
        $data->msg = "获取成功";
		if(count($list)>0)
		{
			$chunk = $list[$page-1];
			
			foreach($chunk as $v){
				$v->logo = "http://shop.m9n.com/image/show".$v->logo;
				$image = array();
				$image[] = $v->logo;
				$v->logo = $image;
			}
			$data->data = $chunk;
		}else{
			$data->data = [];
		}
		return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
 
    }

    /**
     * 显示文字编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
