<?php
	$listData = $article;
	if($listData->is_favorite){
		$is_favorite = '/share/images/favorited.png';
	}else{
		$is_favorite = '/share/images/shoucang.png';
	}
	if($listData->isadv)
	{
		$display = "";
		$display2 = "style='display:none;'";
		$advert  = $listData->advert;
	}else{
		$display2 = '';
		$display = "style='display:none;'";
	}
	$advert  = $listData->advert;
	$str = $listData->content;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=" width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo $listData->title;?></title>
	<link rel="stylesheet" href="/share/css/base.css">
	<script type="text/javascript" src="/share/js/common.js"></script>
	<script type="text/javascript" src="/share/js/jquery-1.11.1.min.js"></script>
	<style type="text/css">
		.arttab{width: 100%;padding-top: 0rem;padding-bottom: 0rem;border:none}
		.arttab1{width: 20%;}
		.arttab2{width: 60%;text-align: center;font-size: 0.425rem;color: #252525;height: 0.5rem;overflow: hidden;}
		.artimg1{width: 0.5rem;margin-left: 0.25rem;display: block;}
		.artimg2{width: 0.5rem;}
		.artimg3{width: 0.475rem;margin-left: 0.65rem;margin-top: 0.05rem;}
		.artpt1{width: 94%;padding-left: 2%;padding-right: 2%;padding-top: 0.25rem;}
		.artpt1-p1{font-size: 0.5rem;color:#252525;line-height: 0.7rem;overflow: hidden;font-weight: 600;}
		.artpt1-p2{font-size: 0.35rem;color:#8c8c8c;line-height: 0.45rem;margin-top: 0.25rem;margin-bottom: 0.25rem;}
		 #news{font-size: 0.4rem;margin-top:0.2rem;margin-bottom: 0.2rem;}
		 #news p,#news span{font-size: 0.4rem !important;}
		.artimg4{width: 100%;height: 3.5rem;}
		.artbtm{width: 97%;padding-left: 3%;border-top: 1px solid #e8e8e8;padding-top: 0.2rem;padding-bottom: 0.2rem;position: fixed;bottom:0;left:0;z-index: 1;background-color: #fff;}
		.artimg5{width:0.9rem;margin-right: 0.5rem;}
		.artbtp1{font-size:0.325rem;color:#252525; line-height: 0.45rem;}
		.artbtp2{font-size:0.3rem;color:#8c8c8c; line-height: 0.45rem;}
		.artbtp3{font-size:0.3rem;color:#1792e8; line-height: 0.45rem;border-bottom: 1px solid #1792e8;}
		.artimg6{width: 0.6rem;margin-left: 1.8rem;margin-top: 0.25rem;}

		/*弹窗*/
	.popup1{width: 100%;height: 100%;position: fixed;top:0;left:0;z-index: 99;display: none;}
	.popup2{width: 100%;height: 100%;background: rgba(0,0,0,0.5);position:absolute;top:0;left:0;z-index: 100;}
	.share{width: 80%; height: 1.75rem;;position:absolute;top:30%;left:10%;z-index: 101;}
	.sharept1{width: 25%;}
	.shareimg{width:1.2rem;height: 1.2rem;margin:0 auto;display: block;}
	.sharep{color:#fff;font-size: 0.3rem;line-height: 1rem;text-align: center;}

	/*推广*/
	.ad-rate{width: 95%;margin: 0 auto;border: 1px solid #e9e9e9;padding: 0.15rem;margin-top: 0.35rem;position: relative;}
	.ratesimg1{width: 1.8rem;height: 2rem;margin-right: 0.25rem;}
	.rateprt1{width: 56%;}
	.ratep1{font-size: 0.36rem;color:#252525;height: 1.2rem;}
	.ratep2{font-size: 0.3rem;color:#666;line-height:0.5rem;}
	.ratep3{width:1.125rem;height: 0.55rem;text-align: center;margin-top: 0.1rem;}
	.ratesimg2{width:0.8625rem;height:0.3875rem; position: absolute;right:0.3rem;top:0;}
	/*广告弹窗*/
		.adshow{width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);position: fixed;top:0;left:0;z-index: 99;}
		.admid{width: 8rem;height: 7rem;background-color: #fff;border-radius: 15px;overflow: hidden;position: absolute;top:25%;left: 50%;margin-left: -4rem;}
		.admid-img{width: 100%;height: 3rem;overflow: hidden;text-align: center;}
		.admidtxt{padding:0.5rem 0.8rem;width: 6.4rem;}
		.adminp1{font-size: 0.5rem;line-height: 0.8rem;color:#3e3e3e;}
		.adminp2{font-size: 0.32rem;line-height: 0.5rem;color:#8c8c8c;}
		.adminp2 span{color:#1792e8;}
		.adminp3{font-size: 0.4rem;line-height: 0.5rem;}
		.adbtmimg{width:1.2rem;margin-left: 0.4rem;}
		.adtel{margin-top: 0.75rem;}
		.adtel p{margin-right: 0.5rem;}
		.guanbi{position: absolute;bottom:15%;width: 0.8rem;left:50%;margin-left: -0.4rem;height:0.8rem;}
		.ad-bottom{margin-bottom:0.5rem;}
		.contact{
		    width: 1.125rem;
		    margin-top: 0.5rem;
		    margin-left: 0.6rem;
		}
		body{
			margin-bottom: 2rem;
		}
		.app{
			position: fixed;
	    bottom: 0;
	    padding: 0.2rem;
	    height: 1rem;
	    border-top: 1px #e9e9e9 solid;
			background: #f5f5f5;
			opacity: 1;
			width: 100%;
		}
		.app .logo{
			float:left;
			width: 1rem;
		}
		.app .title{
			float:left;
			padding: 0.1rem;
		}
		.app .title .start{
			font-size: 0.36rem;
			color:#252525;
		}
		.app .title .end{
			font-size: 0.32rem;
			color:#333;
		}
		.app .download{
			float: left;
	    width: 1.4rem;
	    padding-top: 0.2rem;
		}
	</style>
</head>
<body>
	 <div class="clearfix arttab">

	 </div>
	 <div class="artpt1">
	 	<p class="artpt1-p1"><?php echo $listData->title;?></p>
	 	<div class="clearfix artpt1-p2"><p class="fl marr2"><?php echo $listData->created_at;?></p><p class="fl marr2"></p><p class="fl"><?php echo $listData->source;?></p></div>
	 	<!-- 推广 头部-->
		<?php if($advert && $advert->type==1):?>
	 	<div class="clearfix ad-rate">
	 		<span style="display:inline-block;" class="fl ratesimg1"><img style="max-height:99%;" src="<?php echo '/'.$advert->img;?>" alt=""><span style="display:inline-block;height:100%;width:0%;"></span></span>
	 		<div class="fl rateprt1">
	 			<p class="ratep1"><?php echo $advert->title;?></p>
	 			<a href="<?php echo $advert->jump_url?>"><p class="ratep2"><?php echo $advert->descri;?><?php if($advert->jump_url):?><span style="color: #1792e8;">查看详情>></span><?php endif;?></p></a>
	 		</div>
	 		<div class="fl contact">
	 		<p class="fl ratep3"><a href="tel:<?php echo $advert->tel;?>"><img src="/share/images/diandian.png"></a></p>
	 		<p class="fl ratep3">
			<?php if($advert->qrcode):?>
			<a href="<?php echo url('qrcode?qrcode='.urlencode($advert->qrcode));?>"><img src="/share/images/zizi.png" alt=""></a>
			<?php else:?>
				<img src="/share/images/zixun.png" alt="">
			<?php endif;?>
			</p>
	 		</div>
	 		<div class="ratesimg2"><img src="/share/images/tuiguang.png" alt=""></div>
	 	</div>
		<?php endif;?>


	 	<div id="news"><?php echo $listData->content;?></div>
		<!-- 推广尾部-->
		<?php if($advert && $advert->type==3):?>
	 	<div class="clearfix ad-rate ad-bottom">
	 		<span style="display:inline-block;" class="fl ratesimg1"><img style="max-height:99%;" src="<?php echo '/'.$advert->img;?>" alt=""><span style="display:inline-block;height:100%;width:0%;"></span></span>
	 		<div class="fl rateprt1">
	 			<p class="ratep1"><?php echo $advert->title;?></p>
	 			<a href="<?php echo $advert->jump_url?>"><p class="ratep2"><?php echo $advert->descri;?><?php if($advert->jump_url):?><span style="color: #1792e8;">查看详情>></span><?php endif;?></p></a>
	 		</div>
	 		<div class="fl contact">
	 		<p class="fl ratep3 top_tel"><a href="tel:<?php echo $advert->tel;?>"><img src="/share/images/diandian.png"></a></p>
	 		<p class="fl ratep3">
			<?php if($advert->qrcode):?>
			<a href="<?php echo url('qrcode?qrcode='.urlencode($advert->qrcode));?>"><img src="/share/images/zizi.png" alt=""></a>
			<?php else:?>
				<img src="/share/images/zixun.png" alt="">
			<?php endif;?>
			</p>
			</div>
	 		<div class="ratesimg2"><img src="/share/images/tuiguang.png" alt=""></div>
	 	</div>
		<?php endif;?>
	 </div>
	 <div class="artbtm clearfix" style="display:none;">
	 	<a onclick="add_favorite()">
	 	<span class="artimg5 fl"><img src="/share/images/shouji.png" alt=""></span>
	 	<div class="fl">
	 		<p class="artbtp1">点击这里，免费植入你自己的广告</p>
	 		<p class="artbtp2">迅速将您的生意传遍到全国&nbsp<a onclick="add_favorite()">立即体验</a></p>
	 	</div>
	 	<span class="fl artimg6"><img src="/share/images/more.png" alt=""></span>
	 	</a>
	 </div>
	 <!-- 分享弹窗 -->
	 <div class="popup1" id="popwiow1">
	 	<div class="popup2" id="popwiow2">

	 	</div>
	 	<div class="clearfix share">
	 		<div class="fl sharept1">
	 			<span class='shareimg'><img src="/share/images/weixin.png" alt=""></span>
	 			<p class="sharep">微信</p>
	 		</div>
	 		<div class="fl sharept1">
	 			<span class='shareimg'><img src="/share/images/pengyou.png" alt=""></span>
	 			<p class="sharep">朋友圈</p>
	 		</div>
	 		<div class="fl sharept1">
	 			<span class='shareimg'><img src="/share/images/facebook.png" alt=""></span>
	 			<p class="sharep">Facebook</p>
	 		</div>
	 		<div class="fl sharept1">
	 			<span class='shareimg'><img src="/share/images/tuite.png" alt=""></span>
	 			<p class="sharep">Twitter</p>
	 		</div>
	 	</div>
	 </div>

	 <!-- 广告弹窗 -->
	 <?php if($advert && $advert->type==2):?>
	 <div class="adshow">
	 	<div class="admid">
	 		<div class="admid-img"><img src="<?php echo '/'.$advert->img;?>" alt=""></div>
	 		<div class="admidtxt">
	 			<p class="adminp1"><?php echo $advert->title;?></p>
	 			<a href="<?php echo $advert->jump_url?>"><p class="adminp2"><?php echo $advert->descri;?><span><?php if($advert->jump_url):?>查看》<?php endif;?></span></p></a>
	 			<div class="clearfix adtel">
	 				<p class="fl adminp3"><?php echo $advert->tel;?></p>
	 				<div class="fl clearfix ">
	 					<span class="fl adbtmimg"><a href="tel:<?php echo $advert->tel;?>"><img src="/share/images/diandian.png" alt=""></a></span>
	 					<span class="fl adbtmimg">
	 					<?php if($advert->qrcode):?>
	 					<a href="<?php echo url('qrcode?qrcode='.urlencode($advert->qrcode));?>"><img src="/share/images/zizi.png" alt=""></a>
	 					<?php else:?>
	 						<img src="/share/images/zixun.png" alt="">
	 					<?php endif;?>
	 					</span>
	 				</div>
	 			</div>
	 		</div>
	 	</div>
	 	<div class="guanbi"><img src="/share/images/guanbi.png" alt=""></div>
	 </div>
 	 <?php endif;?>
	 <!--下载App-->
	 <div class="app">
		 <div class="logo"><img src="/share/images/kkyx_logo.png"></div>
		 <div class="title">
			 <p class="start">想在这样的文章中添加自己的产品广告吗？</p>
			 <p class="end">下载app只需要一分钟就能将你的产品推广出去！</p>
		 </div>
		 <div class="download"><img src="/share/images/kkyx_down.png"></div>
	 </div>
</body>
</html>
<script type="text/javascript">
$('img').removeAttr('style');
 $("#sharetxt").click(
	 function(){
		 $("#popwiow1").show();
	 });
 $("#popwiow2").click(
	 function(){
		 $("#popwiow1").hide();
	 });
 function add_favorite()
 {
	 alert('请先登录!');
 }
 $('.guanbi').click(function(){
	 $('.adshow').hide();
 })

var u = navigator.userAgent;
var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
$('.download').click(function(){
	// if(isAndroid){
	// 	location.href="http://zhushou.360.cn/detail/index/soft_id/3862371?recrefer=SE_D_";
	// }else{
		location.href="https://itunes.apple.com/cn/app/%E5%8D%A1%E5%8D%A1%E8%90%A5%E9%94%80/id1244664884?mt=8";
	//}
	// if(isiOS){
	// 	location.href="https://itunes.apple.com/cn/app/%E5%8D%A1%E5%8D%A1%E8%90%A5%E9%94%80/id1244664884?mt=8";
	// }
})

</script>
