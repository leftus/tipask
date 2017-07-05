<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use App\Models\User;
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
        $my_category = UserCategory::select('category_id')->where('uid','=',$user_id)->get();
        if($my_category){
          foreach ($my_category as $key => $value) {
            $value->id=$value->category_id;
            $value->name = Category::where('id','=',$value->category_id)->pluck('name');
            unset($value->category_id);
            $list->push($value);
          }

        }
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

      $all_category = array();
      $all_category_ids = array();
      $lists = Category::select('id','name')->where('type','articles')->orderBy('sort')->get();
      if($lists){
        foreach($lists as $list){
          $all_category[$list->id] = ['category_id'=>$list->id,'category_name'=>$list->name];
          $all_category_ids[] = $list->id;
        }
      }
      //var_dump($all_category);
      //var_dump($all_category_ids);
      $user_categorys = UserCategory::select('category_id')->where('uid','=',$user_id)->get();
      $user_category_ids=array();
      if($user_categorys){
        foreach ($user_categorys as $user_cate) {
          $user_category_ids[]=$user_cate->category_id;
        }
      }
      $left_category_ids = array_diff($all_category_ids,$user_category_ids);
      $left_category = array();
      foreach($left_category_ids as $left_ids){
        $left_category[]=$all_category[$left_ids];
      }
      $user_category = array();
      foreach($user_category_ids as $user_ids){
        $user_category[]=$all_category[$user_ids];
      }
      $data = new \stdClass();
      $data->user_category = $user_category;
      $data->left_category = $left_category;
      return response()->json(array('code'=>0,'msg'=>'操作成功','data'=>$data));
     }

     public function toggle_my_category(Request $request){
       $user_id = $request->input('user_id');
       $token      = $request->input('token');
       $action = $request->input('action');
       $category_id = $request->input('category_id');
      //验证token
      $user = User::where('id',$user_id)->select('password','sort')->first();
      if(md5(($user->password).($user->sort)) != $token)
      {
      	return response()->json(array('code'=>3,'msg'=>'token验证失败','data'=>array()));
      }
      if(!in_array($action,['add','delete'])){
          return response()->json(array('code'=>1,'msg'=>'参数错误','data'=>array()));
      }
      $UserCategory = new UserCategory;
      $UserCategory->uid = $user_id;
      $UserCategory->category_id = $category_id;
      if($action=='add'){
        $UserCategory->save();
        return response()->json(array('code'=>0,'msg'=>'操作成功','data'=>array()));
      }
      if($action=='delete'){
        UserCategory::where('category_id','=',$category_id)->where('uid','=',$user_id)->delete();
        return response()->json(array('code'=>0,'msg'=>'操作成功','data'=>array()));
      }
     }
}
