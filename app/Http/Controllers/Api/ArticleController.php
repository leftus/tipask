<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Advert;
use App\Models\Link;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use App\Models\Category;

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
		if(empty($cate)){
            return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
        }
        $data = new \stdClass();
	    $take = 10;
		$skip = ($page-1)*$take;
		if($cate ==4){
			$cate_list = Category::where('type','articles')->where('status','<>',0)->lists('id');
			$list = Article::orderBy('created_at','desc')->whereIn('category_id',$cate_list)->skip($skip)->take($take)->select('id','title','summary','source','logo','views','created_at','share_count','category_id')->get();
		}else{
			$list = Article::orderBy('created_at','desc')->where('category_id',$cate)->skip($skip)->take($take)->select('id','title','summary','source','logo','views','created_at','share_count','category_id')->get();
		}
		if($count_show)
		{
			$count = Article::orderBy('id','desc')->where('category_id',$cate)->count('id');
			$data->count = $count;
		}
        $data->code = 0;
        $data->msg = "获取成功";
		foreach($list as $v){
				if(strpos($v->logo,'http')===FALSE){
					$v->logo = 'https://us.m9n.com/image/show/'.$v->logo;
				}
				$image = array();
				$image[] = $v->logo;
				$v->logo = $image;
				if(empty($v->source))
				{
					$v->source = '';
				}
				if($v->views>0){
					$v->rate = '转发率:'.(number_format($v->share_count/$v->views,2)*100).'%';
				}else{
					$v->rate = '转发率:100%';
				}
				unset($v->share_count);
				$v->views = '阅读量:'.$v->views;
				if($v->category_id==9){
					$v->title = trim($v->summary);
				}
				unset($v->category_id);
			}
		$old_date = $request->input('old_date');
		if(!empty($old_date)){
			if($cate ==4){
				$cate_list = Category::where('type','articles')->where('status','<>',0)->lists('id');
				$data->number = Article::where('created_at','>',$old_date)->whereIn('category_id',$cate_list)->count();
			}else{
				$data->number = Article::where('created_at','>',$old_date)->where('category_id',$cate)->count();
			}
		}else{
			$data->number = 0;
		}
		$data->data = $list;
		return response()->json($data);
    }
    public function detail(Request $request)
	{
		$article_id = $request->input('article_id');
		$user_id    = $request->input('user_id');
		if(empty($article_id))
		{
			return response()->json(array('code'=>1,'msg'=>'缺少参数','data'=>array()));
		}

		$data = Article::where('id',$article_id)->select('id','title','source','created_at','views','content','summary','category_id')->first();
    Article::where('id',$article_id)->update(['views'=>$data->views+1]);
		$data->desc    = str_limit($this->format_html($data->content), $limit = 40, $end = '');
		if($data->category_id==9){
			$data->title = trim($data->summary);
			$data->desc='';
		}
		unset($data->summary);
		unset($data->category_id);
		$data->created_at = date('Y-m-d',strtotime($data->created_at));
		if($user_id>0)
		{
			$advert = Advert::where('user_id',$user_id)->where('status','=',1)->select('title','descri','img','tel','link_id','type','qrcode')->first();
		}
		$data->comments = $data->views;
		unset($data->views);
		if(!empty($advert))
		{
			$link   = Link::where('id',$advert->link_id)->value('jump_url');
			$advert->img = ltrim($advert->img,'.');
			if($advert->link_id){
				$advert->jump_url = $link;
			}else{
				$advert->jump_url = '';
			}
	      if(empty($advert->qrcode)){
	        $advert->qrcode = '';
	      }
			unset($advert->link_id);
			$data->isadv = 1;
			$data->type = $advert->type;
		}else{
			$advert = new \stdClass();
			$data->isadv = 0;
			$data->type = 0;
			$advert->title = $advert->descri = $advert->img = $advert->tel = $advert->jump_url ='';
		}
		$data->advert = $advert;
		if(empty($data->source))
		{
			$data->source = '';
		}
		//判断是否收藏
		$data->is_favorite = 0;
		if(!empty($user_id))
		{
			$favorite = Favorite::whereRaw('user_id='.$user_id.' and article_id='.$article_id)->value('id');
			if($favorite>0)
			{
				$data->is_favorite = 1;
			}
		}
		$data->content = url('article_detail_h5',[$data->id]);
		if(empty($data->content))
		{
			$data->content = '';
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$data));
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

	public function refresh_total(Request $request){
		$old_date = $request->input('old_date');
		if(!empty($old_date)){
			$number = Article::where('created_at','>',$old_date)->count();
		}else{
			$number = 0;
		}
		return response()->json(array('code'=>0,'msg'=>'成功','data'=>$number));
	}

	public function update_rate(){
		$articles = Article::select('id')->get();
	}
}
