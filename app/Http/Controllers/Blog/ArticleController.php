<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use App\Models\Advert;
use App\Models\Link;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use App\Models\UserArticle;
use App\Models\UserArticleViews;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        //'title' => 'required|min:5|max:255',
        //'content' => 'required|min:50|max:65535',
        'summary' => 'sometimes|max:255',
        'tags' => 'sometimes|max:128',
        'category_id' => 'sometimes|numeric'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("theme::article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loginUser = $request->user();
        if($request->user()->status === 0){
            return $this->error(route('website.index'),'操作失败！您的邮箱还未验证，验证后才能进行该操作！');
        }

        /*防灌水检查*/
        if( Setting()->get('article_limit_num') > 0 ){
            $questionCount = $this->counter('article_num_'. $loginUser->id);
            if( $questionCount > Setting()->get('article_limit_num')){
                return $this->showErrorMsg(route('website.index'),'你已超过每小时文章发表限制数'.Setting()->get('article_limit_num').'，请稍后再进行该操作，如有疑问请联系管理员!');
            }
        }

        $request->flash();

        /*如果开启验证码则需要输入验证码*/
        if( Setting()->get('code_create_article') ){
            $this->validateRules['captcha'] = 'required|captcha';
        }

        $this->validate($request,$this->validateRules);

        $data = [
            'user_id'      => $loginUser->id,
            'category_id'      => intval($request->input('category_id',0)),
            'title'        => trim($request->input('title')),
            //'content'  => clean($request->input('content')),
            'content'  => $request->input('content'),
            'summary'  => $request->input('summary'),
            'status'       => 1,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];

        if($request->hasFile('logo')){
            $validateRules = [
                'logo' => 'required|image|max:'.config('tipask.upload.image.max_size'),
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'articles/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $data['logo'] = str_replace("/","-",$filePath);
        }


        $article = Article::create($data);

        /*判断问题是否添加成功*/
        if($article){

            /*添加标签*/
            $tagString = trim($request->input('tags'));
            Tag::multiSave($tagString,$article);

            //记录动态
            $this->doing($article->user_id,'create_article',get_class($article),$article->id,$article->title,$article->summery);

            /*用户提问数+1*/
            $loginUser->userData()->increment('articles');

            UserTag::multiIncrement($loginUser->id,$article->tags()->get(),'articles');


            $this->credit($request->user()->id,'create_article',Setting()->get('coins_write_article'),Setting()->get('credits_write_article'),$article->id,$article->title);

            if($article->status === 1 ){
                $message = '文章发布成功! '.get_credit_message(Setting()->get('credits_write_article'),Setting()->get('coins_write_article'));
            }else{
                $message = '文章发布成功！为了确保文章的质量，我们会对您发布的文章进行审核。请耐心等待......';
            }

            $this->counter( 'article_num_'. $article->user_id , 1 , 3600 );


            return $this->success(route('blog.article.detail',['id'=>$article->id]),$message);


        }

        return  $this->error("文章发布失败，请稍后再试",route('website.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $article = Article::find($id);

        /*问题查看数+1*/
        $article->increment('views');

        $topUsers = Cache::remember('top_article_users',10,function() {
            return  UserData::top('articles',8);
        });

        /*相关问题*/
        $relatedQuestions = Question::correlations($article->tags()->lists('tag_id'));

        /*相关文章*/
        $relatedArticles = Article::correlations($article->tags()->lists('tag_id'));

        /*设置通知为已读*/
        if($request->user()){
            $this->readNotifications($article->id,'article');
        }

        return view("theme::article.show")->with('article',$article)
                                          ->with('topUsers',$topUsers)
                                          ->with('relatedQuestions',$relatedQuestions)
                                          ->with('relatedArticles',$relatedArticles);
        ;
    }
  public function qrcode(Request $request){
    $qrcode = $request->input('qrcode');
    return view("theme::article.qrcode")->with('qrcode',urldecode($qrcode));
  }

  public function qr_code(){
    return view("theme::article.about");
  }

  public function download_qrcode(){
    return response()->download(public_path('/share/images/hardy_yin.jpg'));
  }
	public function share($article_id,$user_id,Request $request)
  {
		if(empty($article_id))
		{
			print('缺少参数');
			exit();
		}
		$data = Article::where('id',$article_id)->select('id','title','source','created_at','views','content','category_id','summary')->first();
    $relations=Article::where('category_id',$data->category_id)->select('id','title','created_at','views','summary','category_id','share_count','logo')->orderBy('created_at','desc')->take(10)->get();
    foreach ($relations as $k => $v) {
      if(strpos($v->logo,'http')===FALSE){
        $v->logo = 'https://us.m9n.com/image/show/'.$v->logo;
      }
      if($v->category_id==9){
          $v->title = trim($v->summary);
      }
      if($v->views>0){
        $v->rate = '转发率:'.(number_format($v->share_count/$v->views,2)*100).'%';
      }else{
        $v->rate = '转发率:100%';
      }
    }
    $data->content = str_replace('https://www.stpaulsfriends.club', '', $data->content);
    if($data->category_id==9){
        $data->title = trim($data->summary);
    }
    unset($data->category_id);
    unset($data->summary);
		$data->created_at = date('Y-m-d',strtotime($data->created_at));
		if($user_id>0)
		{
			$advert = Advert::where('user_id',$user_id)->where('status','=',1)->select('title','descri','img','tel','link_id','type','qrcode')->first();
      $userarticle = UserArticle::where('uid',$user_id)->where('aid',$article_id)->first();
      if($userarticle){
        $userarticle->views+=1;
        $userarticle->save();
        $userarticleviews = new UserArticleViews;
        $userarticleviews->user_article_id = $userarticle->id;
        $userarticleviews->save();
      }
		}else{
      $user_id='';
    }
		$data->comments = $data->views;
		unset($data->views);
		if(!empty($advert))
		{
			$link   = Link::where('id',$advert->link_id)->value('jump_url');
			$advert->jump_url = $link;
      $advert->title = str_limit($advert->title,50);
      $advert->descri = str_limit($advert->descri,50);
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
		return view("theme::article.share",['article'=>$data,'relations'=>$relations,'user_id'=>$user_id]);
  }
    /**
     * 显示文字编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $article = Article::find($id);

        if(!$article){
            abort(404);
        }

        if($article->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
        }

        /*编辑问题时效控制*/
        if( !$request->user()->is('admin') && Setting()->get('edit_article_timeout') ){
            if( $article->created_at->diffInMinutes() > Setting()->get('edit_article_timeout') ){
                return $this->showErrorMsg(route('website.index'),'你已超过文章可编辑的最大时长，不能进行编辑了。如有疑问请联系管理员!');
            }
        }
        return view("theme::article.edit")->with(compact('article'));

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
        $article_id = $request->input('id');
        $article = Article::find($article_id);
        if(!$article){
            abort(404);
        }

        if($article->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
        }

        $request->flash();

        /*如果开启验证码则需要输入验证码*/
        if( Setting()->get('code_create_article') ){
            $this->validateRules['captcha'] = 'required|captcha';
        }




        $this->validate($request,$this->validateRules);

        $article->title = trim($request->input('title'));
        //$article->content = clean($request->input('content'));
        $article->content = $request->input('content');
        $article->summary = $request->input('summary');
        $article->share_count = $request->input('share_count');
        $article->views = $request->input('views');
        $article->category_id = $request->input('category_id',0);
        $article->created_at = date('Y-m-d H:i:s');
        $article->updated_at = date('Y-m-d H:i:s');
        if($request->hasFile('logo')){
            $validateRules = [
                'logo' => 'required|image|max:'.config('tipask.upload.image.max_size'),
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'articles/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $article->logo = str_replace("/","-",$filePath);
        }


        $article->save();
        $tagString = trim($request->input('tags'));

        /*更新标签*/
        Tag::multiSave($tagString,$article);

        return $this->success(route('blog.article.detail',['id'=>$article->id]),"文章编辑成功");

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
