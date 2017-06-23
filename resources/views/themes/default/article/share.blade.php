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
		img{max-width:97%;}
		.arttab{width: 100%;padding-top: 0rem;padding-bottom: 0rem;border:none}
		.arttab1{width: 20%;}
		.arttab2{width: 60%;text-align: center;font-size: 0.425rem;color: #252525;height: 0.5rem;overflow: hidden;}
		.artimg1{width: 0.5rem;margin-left: 0.25rem;display: block;}
		.artimg2{width: 0.5rem;}
		.artimg3{width: 0.475rem;margin-left: 0.65rem;margin-top: 0.05rem;}
		.artpt1{width: 94%;padding-left: 2%;padding-right: 2%;padding-top: 0.25rem;}
		.artpt1-p1{font-size: 0.5rem;color:#252525;line-height: 0.5rem;overflow: hidden;}
		.artpt1-p2{font-size: 0.35rem;color:#8c8c8c;line-height: 0.45rem;margin-top: 0.25rem;margin-bottom: 0.25rem;}
		 #news{font-size: 0.32rem !important;color:#3e3e3e;line-height: 0.55rem;margin: 0 auto;margin-top: 0.35rem;margin-bottom: 0.35rem;width:95%;font-family:黑体}
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
	.ad-rate{width: 92%;margin: 0 auto;border: 1px solid #ccc;padding: 0.15rem;margin-top: 0.35rem;position: relative;}
	.ratesimg1{width: 1.8rem;height: 2rem;margin-right: 0.25rem;}
	.rateprt1{width: 56%;}
	.ratep1{font-size: 0.36rem;color:#252525;}
	.ratep2{font-size: 0.3rem;color:#666;line-height:0.5rem;}
	.ratep3{width:1.125rem;height: 0.55rem;text-align: center;margin-left: 0.4rem;margin-top: 0.1rem;}
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
		.top_tel{margin-top: 0.3rem}
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
	 		<p class="fl ratep3 top_tel"><a href="tel:<?php echo $advert->tel;?>"><img src="/share/images/diandian.png"></a></p>
	 		<p class="fl ratep3">
			<?php if($advert->qrcode):?>
			<a href="<?php echo url('qrcode?qrcode='.urlencode($advert->qrcode));?>"><img src="/share/images/zizi.png" alt=""></a>
			<?php else:?>
				<img src="/share/images/zixun.png" alt="">
			<?php endif;?>
			</p>
	 		<div class="ratesimg2"><img src="/share/images/tuiguang.png" alt=""></div>
	 	</div>
		<?php endif;?>


	 	<div id="news"><?php echo $listData->content;?></div>
		<!-- 推广尾部-->
		<?php if($advert && $advert->type==3):?>
	 	<div class="clearfix ad-rate">
	 		<span style="display:inline-block;" class="fl ratesimg1"><img style="max-height:99%;" src="<?php echo '/'.$advert->img;?>" alt=""><span style="display:inline-block;height:100%;width:0%;"></span></span>
	 		<div class="fl rateprt1">
	 			<p class="ratep1"><?php echo $advert->title;?></p>
	 			<a href="<?php echo $advert->jump_url?>"><p class="ratep2"><?php echo $advert->descri;?><?php if($advert->jump_url):?><span style="color: #1792e8;">查看详情>></span><?php endif;?></p></a>
	 		</div>
	 		<p class="fl ratep3 top_tel"><a href="tel:<?php echo $advert->tel;?>"><img src="/share/images/diandian.png"></a></p>
	 		<p class="fl ratep3">
			<?php if($advert->qrcode):?>
			<a href="<?php echo url('qrcode?qrcode='.urlencode($advert->qrcode));?>"><img src="/share/images/zizi.png" alt=""></a>
			<?php else:?>
				<img src="/share/images/zixun.png" alt="">
			<?php endif;?>
			</p>
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
</body>
</html>
<script type="text/javascript">
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
</script>
