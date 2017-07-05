<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use App\Models\UserCategory;

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
        $user_id = $request->input('user_id');
        if(empty($page)){
            $page = 1;
        }
        //$list = Category::orderBy('id','desc')->get(['id','title','summary','logo','views','created_at'])->chunk(10);
		    $list = Category::orderBy('sort')->where('type','articles')->where('status','<>',0)->select('id','name')->get();
        return response()->json(array('code'=>0,'msg'=>'成功','data'=>$list));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function my_category(Request $request){
       $user_id = $request->input('user_id');
       $token      = $request->input('token');
      //验证token
      $user = User::where('id',$user_id)->select('password','sort')->first();
      if(md5(($user->password).($user->sort)) != $token)
      {
      	return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
      }
      $all_category = Category::orderBy('sort')->where('type','articles')->lists('id','name');
      var_dump($all_category);
      $all_category_ids = array();
      $left_category_ids = array();
      $user_categor_ids = UserCategory::where('uid','=',$user_id)->lists('category_id');
      var_dump($user_categor_ids);
     }
}
