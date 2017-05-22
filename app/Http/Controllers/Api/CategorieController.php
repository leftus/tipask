<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
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

class CategorieController extends Controller
{
    /***
    *文章列表
    *
    ***/
    public function lists(Request $request)
    {
        $page = $request->input('page');
        if(empty($page)){
            $page = 1;
        }
        $data = new \stdClass();
        //$list = Category::orderBy('id','desc')->get(['id','title','summary','logo','views','created_at'])->chunk(10);
		$list = Category::orderBy('sort')->where('type','articles')->select('id','name')->get();
        return response()->json(array('code'=>0,'msg'=>'成功','data'=>$list));
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