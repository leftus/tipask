<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Advert;
use App\Models\Link;
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
    public function detail(Request $request)
	{
		$article_id = $request->input('article_id');
		if(empty($article_id))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}
		$data = Article::where('id',$article_id)->select('id','title','source','created_at','comments')->first();
		$data->created_at = date('Y-m-d',strtotime($data->created_at));
		$advert = Advert::where('article_id',$article_id)->select('title','descri','img','tel','link_id')->first();
		if($advert)
		{
			$link   = Link::where('id',$advert->link_id)->value('jump_url');
			$advert->jump_url = $link;
			unset($advert->link_id);
			$data->isadv = 1;
		}else{
			$advert = new \stdClass();
			$data->isadv = 0;
			$advert->title = $advert->descri = $advert->img = $advert->tel = $advert->jump_url ='';
		}
		$data->advert = $advert;
		if(empty($data->source))
		{
			$data->source = '';
		}
		$data->content = url('article_detail_h5',[$data->id]);
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$data));
	}
}
