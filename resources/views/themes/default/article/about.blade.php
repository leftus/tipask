<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link rel="stylesheet" href="/about/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/about/css/base.css" />
    <link rel="stylesheet" href="/about/css/contactUs.css" />
    <script type="text/javascript" src="/share/js/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="main">
		<div class="infoBox row-shadown">
			<img class="abs left" src="/about/img/left.jpg" alt="" class="logo"/>
			<img class="abs right" src="/about/img/bottom.jpg" alt="" class="logo"/>
			<img src="/about/img/logo@3x.png" alt="" class="logo"/>
			<p>卡卡营销是一款基于移动端进行产品推广的工具类软件，可以快速生成带有产品广告图片及链接的文章，通过微信、QQ分享等口碑传播的方式快速把企业产品宣传出去！</p>
		</div>

		<div class="weChatBox row-shadown">
			<img src="/about/img/weChat.png" alt="" />
			<span class="save">保存到手机</span>
		</div>
	</div>

	<div class="tel">
		<span>客服电话 400-1584-2358</span>
		<p>工作时间: 周一至周日 8:00 - 18:00</p>
	</div>

	<div class="foot-box">
		<p>酷巴酷（北京）网络科技有限公司</p>
		<img src="/about/img/foot.jpg" alt="" />
	</div>
</body>
</html>
<script>
$('.save').click(function(){
  $.get('/download_qrcode');
})
</script>
